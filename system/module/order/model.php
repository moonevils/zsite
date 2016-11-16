<?php
/**
 * The model file of order module of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Xiying Guan <guanxiying@xirangit.com>
 * @package     order
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
class orderModel extends model
{
    /**
     * Get order by ID.
     * 
     * @param  int    $id 
     * @access public
     * @return object
     */
    public function getByID($id)
    {
        return $this->dao->select('*')->from(TABLE_ORDER)->where('id')->eq($id)->fetch();
    }

    /**
     * Get order list.
     * 
     * @param  string    $mode 
     * @param  mix       $value 
     * @param  string    $orderBy 
     * @param  object    $pager 
     * @access public
     * @return array
     */
    public function getList($mode, $value, $orderBy = 'id_desc', $pager = null)
    {
        $confirmLimitDays = $this->config->shop->confirmLimit;
        $expireLimitDays  = isset($this->config->shop->expireLimit) ? $this->config->shop->expireLimit : 30;

        if($confirmLimitDays)
        {
            $deliveryDate = date('Y-m-d H:i:s', time() - 24 * 60 * 60 * $confirmLimitDays);

            $this->dao->update(TABLE_ORDER)
                ->set('deliveryStatus')->eq('confirmed')
                ->set('last')->eq(helper::now())
                ->where('deliveryStatus')->eq('send')
                ->andWhere('deliveriedDate')->le($deliveryDate)
                ->exec();
        }

        if($expireLimitDays)
        {
            $createdDate  = date('Y-m-d H:i:s', time() - 24 * 60 * 60 * $expireLimitDays);
         
            $this->dao->update(TABLE_ORDER)
                ->set('status')->eq('expired')
                ->set('last')->eq(helper::now())
                ->where('payStatus')->eq('not_paid')
                ->andWhere('status')->ne('deleted')
                ->andWhere('status')->ne('expired')
                ->andWhere('createdDate')->le($createdDate)
                ->exec();
        }
        
        $normalStatus = array('not_paid', 'not_send', 'send');
        $isTypeMode   = in_array($mode, $this->config->order->orderTypes);

        $orders = $this->dao->select('*')->from(TABLE_ORDER)
            ->where(1)
            ->beginIf($mode == 'account')->andWhere('account')->eq($value)->fi()
            ->beginIf($mode == 'status')->andWhere('status')->eq($value)->fi()
            ->andWhere('status')->ne('deleted')
            ->beginIf($mode == 'payStatus')->andWhere('payStatus')->eq($value)->fi()
            ->beginIf($mode == 'deliveryStatus')->andWhere('deliveryStatus')->eq($value)->fi()
            ->beginIf($isTypeMode)->andWhere('type')->eq($mode)->fi()
            ->beginIf($isTypeMode and $value != 'all' and $value != 'send')->andWhere(zget($this->config->order->statusTypes, $value, ''))->eq($value)->fi()
            ->beginIf($isTypeMode and $value == 'send')->andWhere('deliveryStatus')->ne('not_send')->fi()
            ->beginIf($isTypeMode and in_array($value, $normalStatus))->andWhere('status')->eq('normal')->fi()
            ->beginIf(!commonModel::isAvailable('score'))->andWhere('type')->ne('score')->fi()
            ->beginIf(!commonModel::isAvailable('shop'))->andWhere('type')->ne('shop')->fi()
            ->orderBy($orderBy)
            ->page($pager)
            ->fetchAll('id');

        $products = $this->dao->select('*')->from(TABLE_ORDER_PRODUCT)->where('orderID')->in(array_keys($orders))->fetchGroup('orderID');

        foreach($orders as $order) $order->products = isset($products[$order->id]) ? $products[$order->id] : array();
        
        return $orders;
    }

    /**
     * Create an order.
     * 
     * @access public
     * @return void
     */
    public function create()
    {
        $order = fixer::input('post')
            ->add('account', $this->app->user->account)
            ->add('createdDate', helper::now())
            ->add('last', helper::now())
            ->add('payStatus', 'not_paid')
            ->add('status', 'normal')
            ->add('deliveryStatus', 'not_send')
            ->add('type', 'shop')
            ->get();

        $address = $this->dao->select('*')->from(TABLE_ADDRESS)->where('id')->eq($this->post->deliveryAddress)->andWhere('account')->eq($this->app->user->account)->fetch();
        $order->address = helper::jsonEncode($address);
 
        if($this->post->createAddress)
        {
            $address = $this->createAddress();
            if(!$address) return array('result' => 'fail', 'message' => dao::getError());
            $order->address = helper::jsonEncode($address);
        }

        $this->dao->insert(TABLE_ORDER)
            ->data($order, 'createAddress,deliveryAddress,zipcode,phone,contact,price,count,product')
            ->autocheck()
            ->batchCheck($this->config->order->require->create, 'notempty')
            ->exec();
        if(dao::isError()) return array('result' => 'fail', 'message' => dao::getError());

        $orderID = $this->dao->lastInsertID();

        $goods = new stdclass();
        $goods->orderID = $orderID;
        
        if(!$this->post->product)
        {
            $this->clearOrder($orderID);
            return array('result' => 'fail', 'message' => $this->lang->order->noProducts);
        }

        /* Save products of the order and compute order amount. */
        $amount = 0;
        foreach($this->post->product as $product)
        {
            $product = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->eq($product)->fetch();
            if(empty($product)) continue;

            $goods->productID   = $product->id; 
            $goods->productName = $product->name; 
            $goods->count       = $this->post->count[$product->id];

            if(isset($this->config->product->stock) && $this->config->product->stock)
            {
                if($product->amount < $goods->count)
                {
                    $this->clearOrder($orderID);
                    return array('result' => 'fail', 'message' => sprintf($this->lang->order->lowStocks, $goods->productName));
                }
            }

            $goods->price = $product->promotion > 0 ? $product->promotion : $product->price; 
            if(!$goods->price) continue;

            $amount += $goods->price * $goods->count;

            $this->dao->insert(TABLE_ORDER_PRODUCT)->data($goods)->autoCheck()->exec();
        }

        /* Check valid products count. */
        $productCout = $this->dao->select("count(*) as count")->from(TABLE_ORDER_PRODUCT)->where('orderID')->eq($orderID)->fetch('count');
        if(!$productCout)  return array('result' => 'fail', 'message' => $this->lang->order->noProducts);

        $this->dao->update(TABLE_ORDER)->set('amount')->eq($amount)->where('id')->eq($orderID)->exec();
        $this->dao->delete()->from(TABLE_CART)->where('account')->eq($this->app->user->account)->andWhere('product')->in($this->post->product)->exec();
        if(!dao::isError()) return $orderID;
    }

    /**
     * Create address from order.
     * 
     * @access public
     * @return void
     */
    public function createAddress()
    {
        $address = new stdclass();
        $this->loadModel('address');
        $address->account = $this->app->user->account;
        $address->address = $this->post->address;
        $address->contact = $this->post->contact;
        $address->phone   = $this->post->phone;
        $address->zipcode = $this->post->zipcode;

        $this->dao->insert(TABLE_ADDRESS)->data($address)->check('phone', 'phone')->batchCheck($this->config->address->require->create, 'notempty')->exec();
        if(dao::isError()) return false;
        return $address;
    }

    /**
     * Create pay link of an order.
     * 
     * @param  object $order
     * @access public
     * @return void
     */
    public function createPayLink($order, $type = '')
    {
        if($order->payment == 'alipay' or $order->payment == 'alipaySecured') return $this->createAlipayLink($order, $type);
        return helper::createLink('order', 'check', "orderID=$order->id");
    }

    /**
     * Get the human order id.
     * 
     * @param  int    $rawOrderID 
     * @access public
     * @return int
     */
    public function getHumanOrder($rawOrderID)
    {
        $order = $this->getByID($rawOrderID);
        if(!empty($order->humanID)) return $order->humanID;
        $humanID = date('ym') . str_pad($rawOrderID, 7, '0', STR_PAD_LEFT) . mt_rand(10, 99);
        $this->dao->update(TABLE_ORDER)->set('humanID')->eq($humanID)->where('id')->eq($rawOrderID)->exec();
        return $humanID;
    }

    /**
     * Get the raw order id.
     * 
     * @param  int    $humanOrder 
     * @access public
     * @return int
     */
    public function getRawOrder($humanOrder)
    {
        return (int)substr($humanOrder, 4, 7);
    }

    /**
     * Create a alipay link. 
     * 
     * @param  object $order
     * @access public
     * @return string
     */
    public function createAlipayLink($order, $type = '')
    {
        if($type == 'shop') $type = 'order';

        $this->app->loadClass('alipay', true);
        $alipayConfig = $order->payment == 'alipay' ? $this->config->alipay->direct : $this->config->alipay->secured;

        /* Create right link that module is not order in order-browse page, such as score. */
        $notifyURL = empty($type) ? inlink('processorder', "type=alipay&mode=notify") : helper::createLink($type, 'processorder', "type=alipay&mode=notify");
        $returnURL = empty($type) ? inlink('processorder', "type=alipay&mode=return") : helper::createLink($type, 'processorder', "type=alipay&mode=return");

        $alipayConfig->notifyURL = commonModel::getSysURL() . $notifyURL;
        $alipayConfig->returnURL = commonModel::getSysURL() . $returnURL;
        $alipayConfig->pid   = $this->config->alipay->pid;
        $alipayConfig->key   = $this->config->alipay->key;
        $alipayConfig->email = $this->config->alipay->email;
        
        $alipay = new alipay($alipayConfig);

        $subject = $this->getSubject($order->id);

        return $alipay->createPayLink($this->getHumanOrder($order->id),  $subject, $order->amount);
    }

    /**
     * Get order id from the alipay return.
     * 
     * @param  string $mode  return|notify
     * @access public
     * @return object
     */
    public function getOrderFromAlipay($mode = 'return')
    {
        $this->app->loadClass('alipay', true);
        $alipay = new alipay($this->config->alipay);

        $orderID = 0;
        if($mode == 'return')
        {
            unset($_GET['type']);
            unset($_GET['mode']);
            if($alipay->checkNotify($_GET) and ($this->get->trade_status == 'TRADE_FINISHED' or $this->get->trade_status == 'TRADE_SUCCESS' or $this->get->trade_status == 'WAIT_SELLER_SEND_GOODS'))
            {
                $orderID = $this->get->out_trade_no;
                $sn      = $this->get->trade_no;
            }
        }
        elseif($mode == 'notify')
        {
            if($alipay->checkNotify($_POST) and ($this->post->trade_status == 'TRADE_FINISHED' or $this->post->trade_status == 'TRADE_SUCCESS' or $this->get->trade_status == 'WAIT_SELLER_SEND_GOODS'))
            {
                $orderID = $this->post->out_trade_no;
                $sn      = $this->post->trade_no;
            }
        }

        if($orderID) $orderID = $this->getRawOrder($orderID);
        $order = $this->getByID($orderID);

        if(!$order) return false;

        $order->sn = $sn;
        return $order;
    }

    /**
     * Save the request date from alipay to log file.
     * 
     * @access public
     * @return void
     */
    public function saveAlipayLog()
    {
        $content = date('Y-m-d H:i:s') . "\n";
        foreach($_POST as $key => $val) $content .= "$key = $val\n";
        $content .= "----------------\n";
        $logFile = $this->app->getTmpRoot() . 'log/alipay.log';
        $handle = fopen($logFile, 'a');
        fwrite($handle, $content);
        fclose($handle);
    }

    /**
     * Process an order.
     * 
     * @param  object $order
     * @access public
     * @return bool
     */
    public function processOrder($order)
    {
        if($order->payStatus == 'paid') return true;

        $this->dao->update(TABLE_ORDER)
            ->set('sn')->eq($order->sn)
            ->set('payStatus')->eq('paid')
            ->set('paidDate')->eq(helper::now())
            ->set('last')->eq(helper::now())
            ->where('id')->eq($order->id)->exec();

        if(dao::isError()) return false;

        if(is_callable(array($this, "process{$order->type}Order"))) call_user_func(array($this, "process{$order->type}Order"), $order);
        return true;
    }

    /**
     * Process ccore order.
     * 
     * @param  int    $order 
     * @access public
     * @return void
     */
    public function processScoreOrder($order)
    {
        $result = $this->loadModel('score')->processOrder($order);
    }

    /**
     * Fix stocks of an order.
     * 
     * @param  int    $orderID 
     * @access public
     * @return void
     */
    public function fixStocks($orderID)
    {
        $goodsList = $this->dao->select('*')->from(TABLE_ORDER_PRODUCT)->where('orderID')->eq($orderID)->fetchAll();

        foreach($goodsList as $goods)
        {
            $product = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->eq($goods->productID)->fetch();
            $stock = $product->amount - $goods->count;
            $this->dao->update(TABLE_PRODUCT)->set("amount")->eq($stock)->where('id')->eq($goods->productID)->exec();
        }

        return !dao::isError();
    }

    /**
     * Process status of and order.
     * 
     * @param  int    $order 
     * @access public
     * @return void
     */
    public function processStatus($order)
    {
        if($order->status == 'finished') return $this->lang->order->statusList['finished'];
        if($order->status == 'canceled') return $this->lang->order->statusList['canceled'];
        if($order->status == 'expired')  return $this->lang->order->statusList['expired'];
    
        return $this->lang->order->statusList[$order->deliveryStatus];
    }

    /**
     * Finish an order.
     * 
     * @param  int    $orderID 
     * @access public
     * @return bool
     */
    public function finish($orderID)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('status')->eq('finished')
            ->set('finishedDate')->eq(helper::now())
            ->set('finishedBy')->eq($this->app->user->account)
            ->set('last')->eq(helper::now())
            ->where('id')->eq($orderID)
            ->exec();
        return !dao::isError();
    }

    /**
     * cancel an order.
     * 
     * @param  int    $orderID 
     * @access public
     * @return void
     */
    public function cancel($orderID)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('status')->eq('canceled')
            ->set('last')->eq(helper::now())
            ->where('id')->eq($orderID)
            ->andWhere('account')->eq($this->app->user->account)
            ->exec();
        return !dao::isError();
    }

    /**
     * Pay an order backend.
     * 
     * @param  int    $orderID 
     * @access public
     * @return void
     */
    public function pay($orderID)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('payStatus')->eq('paid')
            ->set('sn')->eq($this->post->sn)
            ->set('paidDate')->eq($this->post->paidDate)
            ->set('last')->eq(helper::now())
            ->where('id')->eq($orderID)
            ->exec();
        return !dao::isError();
    }


    /**
     * Print goods of an order.
     * 
     * @param  string    $order 
     * @access public
     * @return string
     */
    public function printGoods($order)
    {
        if(is_callable(array($this, "print{$order->type}Goods"))) return call_user_func(array($this, "print{$order->type}Goods"), $order);
        $goodsInfo = '';
        foreach($order->products as $product)
        {
            $goodsInfo .= "<div class='text-left'>";
            $goodsInfo .= '<span>' . $product->productName . '</span>';
            $goodsInfo .= "</div>";
        }
        return $goodsInfo;
    }

    /**
     * Print goods info of shop order.
     * 
     * @param  int    $order 
     * @access public
     * @return string
     */
    public function printShopGoods($order)
    {
        if(empty($order->products)) return '';
        foreach($order->products as $product)
        {
            $goodsInfo  = "<div class='text-left'>";
            $goodsInfo .= '<span>' . html::a(helper::createLink('product', 'view', "id={$product->productID}", "target='_blank'"), $product->productName) . '</span>';
            $goodsInfo .= $this->config->product->currencySymbol . $product->price . ' &times; ' . $product->count . '</div>';
        }
        return $goodsInfo;
    }

    /**
     * Print goods info of score order.
     * 
     * @param  int    $order 
     * @access public
     * @return void
     */
    public function printScoreGoods($order)
    {
        if(empty($order->products)) return '';
        $goods = current($order->products);
        $goods->productName = '￥' . $order->amount . ' ' . $goods->productName;
        return $goods->productName;
    }

    /**
     * Print actions of an order.
     * 
     * @param  string    $order 
     * @access public
     * @return string
     */
    public function printActions($order, $btnLink = false)
    {
        $this->commonLink = array();
        $this->commonLink['savePayment'] = true;
        $this->commonLink['cancelLink']  = true;

        if(RUN_MODE == 'admin')
        {
            $class = $btnLink ? 'btn' : '';
            
            /* View order link */ 
            if(!$btnLink) echo html::a(inlink('view', "orderID=$order->id&btnLink=false"), $this->lang->order->view, "data-toggle='modal'");
            
            if($this->commonLink['savePayment'])
            {
                /* Save payment link. */
                $disabled = ($order->status == 'normal' and $order->payStatus != 'paid') ? '' : "disabled='disabled'";
                echo $disabled ? html::a('javascript:;', $this->lang->order->return, "$disabled  class='$class'") : html::a(inlink('savepayment', "orderID=$order->id"), $this->lang->order->return, "data-toggle='modal' class='$class'"); 
            }
            
            /* Delete order link. */
            $disabled = ($order->status == 'expired' or $order->status == 'canceled' or $order->status == 'finished') ? '' : "disabled='disabled'";
            echo $disabled ? html::a('javascript:;', $this->lang->order->delete, "$disabled class='$class'") : html::a(inlink('delete', "orderID=$order->id"), $this->lang->order->delete, "data-toggle='modal' class='$class deleter'"); 
        }

        if(RUN_MODE == 'front')
        {
            $isMobile = ($this->app->clientDevice == 'mobile');
            
            /* View order link. */
            $disabled = ($order->status == 'normal' or $order->status == 'finished') ? '' : "disabled='disabled'";
            $class    = $isMobile ? "  btn btn-link " : "";
            echo $disabled ? html::a('javascript:;', $this->lang->order->view, "$disabled class='$class'") : html::a(inlink('view', "orderID=$order->id"), $this->lang->order->view, "data-toggle='modal' class='$class'"); 
            
            if($this->commonLink['cancelLink'])
            {
                /* Cancel link. */
                $disabled = ($order->deliveryStatus == 'not_send' and $order->payStatus != 'paid' and $order->status == 'normal') ? '' : "disabled='disabled'";
                $class    = $isMobile ? "  btn btn-link " : "";
                echo $disabled ? html::a('javascript:;', $this->lang->order->cancel, "$disabled class='{$class}'") : html::a(helper::createLink('order', 'cancel', "orderID=$order->id"), $this->lang->order->cancel, "class='cancelLink {$class}' data-toggle='modal'" );
            }

            /* Delete order link. */
            $disabled = $order->status == 'expired' ? '' : "disabled='disabled'";
            $class = $isMobile ? "  btn btn-link " : "";
            echo $disabled ? html::a('javascript:;', $this->lang->order->delete, "$disabled class='$class'") : html::a(inlink('delete', "orderID=$order->id"), $this->lang->order->delete, "class='deleter $class'"); 
        }

        if(is_callable(array($this, "print{$order->type}Actions"))) call_user_func(array($this, "print{$order->type}Actions"), $order, $btnLink);
    }

    /**
     * Print actions buttons of shop order.
     * 
     * @param  object    $order 
     * @param  bool      $btnLink 
     * @access public
     * @return string
     */
    public function printShopActions($order, $btnLink = false)
    {
        if(RUN_MODE == 'admin' )
        {
            $class = $btnLink ? 'btn' : '';

            /* Edit link. */
            $disabled = $order->status == 'normal' ? '' : "disabled = 'disabled'";
            echo $disabled ? html::a('javascript:;', $this->lang->order->edit, "$disabled  class='$class'") : html::a(inlink('edit', "orderID=$order->id"), $this->lang->order->edit, "data-toggle='modal' class='$class'");
            
            /* Send link. */
            $disabled = ($order->status == 'normal' and $order->deliveryStatus == 'not_send' and ($order->payment == 'COD' or ($order->payment != 'COD' and $order->payStatus == 'paid'))) ? '' : "disabled='disabled'"; 
            echo $disabled ?  html::a('javascript:;', $this->lang->order->delivery, "$disabled class='$class'") : html::a(helper::createLink('order', 'delivery', "orderID=$order->id"), $this->lang->order->delivery, "data-toggle='modal' class='$class'");

            /* Finish link. */
            $disabled = ($order->status == 'normal' and $order->payStatus == 'paid' and $order->deliveryStatus == 'confirmed' and $order->status != 'finished' and $order->status != 'canceled') ? '' : "disabled='disabled'";
            echo $disabled ? html::a('javascript:;', $this->lang->order->finish, "$disabled class='$class'"): html::a('javascript:;', $this->lang->order->finish, "data-rel='" . helper::createLink('order', 'finish', "orderID=$order->id") . "' class='finisher $class'");
        }

        if(RUN_MODE == 'front' and $order->status == 'normal')
        {
            $isMobile = ($this->app->clientDevice == 'mobile');
            $class = $isMobile ? "  btn btn-link " : "";
            
            /* Edit link. */
            $disabled = ($order->deliveryStatus == 'not_send') ? '' : "disabled='disabled'";
            echo $disabled ? html::a('javascript:;', $this->lang->order->edit, "class='$class' $disabled") : html::a(inlink('edit', "orderID={$order->id}"), $this->lang->order->edit, "data-toggle='modal' class='$class'");
            
            /* Pay link. */
            $disabled = ($order->payment != 'COD' and $order->payStatus != 'paid' and $order->status != 'canceled') ? '' : "disabled='disabled'";
            echo $disabled ? html::a('javascript:;', $this->lang->order->pay, "class='$class' $disabled") : html::a($this->createPayLink($order, $order->type), $this->lang->order->pay, "target='_blank' class='btn-goToPay $class'");

            /* Track link. */
            $disabled = ($order->deliveryStatus != 'not_send') ? '' : "disabled='disabled'";
            echo $disabled ? html::a('javascript:;', $this->lang->order->track, "class='$class' $disabled") : html::a(inlink('track', "orderID={$order->id}"), $this->lang->order->track, "data-rel='" . helper::createLink('order', 'confirmDelivery', "orderID=$order->id") . "' data-toggle='modal' class='$class'");

            /* Confirm link. */
            $disabled = ($order->deliveryStatus == 'send') ? '' : "disabled='disabled'";
            echo $disabled ? html::a('javascript:;', $this->lang->order->confirmReceived, "$disabled class='$class'") : html::a('javascript:;', $this->lang->order->confirmReceived, "data-rel='" . helper::createLink('order', 'confirmDelivery', "orderID=$order->id") . "' class='confirmDelivery $class'");
        }
    }

    /**
     * Print action buttons of score order.
     * 
     * @param  object    $order 
     * @param  bool      $btnLink 
     * @access public
     * @return string
     */
    public function printScoreActions($order, $btnLink)
    {
        if(RUN_MODE == 'front' and $order->status == 'normal') 
        {
            $isMobile = ($this->app->clientDevice == 'mobile');
            $class    = $isMobile ? "  btn btn-link " : "";
            
            /* Pay link. */
            $disabled = ($order->payment != 'COD' and $order->payStatus != 'paid') ? '' : "disabled='disabled'";
            echo $disabled ? html::a('javascript:;', $this->lang->order->pay, "$disabled class='$class'") : html::a($this->createPayLink($order, $order->type), $this->lang->order->pay, "target='_blank' class='btn-go2pay $class'");
        }
    }

    /**
     * Confirm delivery.
     * 
     * @param  int    $orderID 
     * @access public
     * @return void
     */
    public function confirmDelivery($orderID)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('deliveryStatus')->eq('confirmed')
            ->set('confirmedDate')->eq(helper::now())
            ->set('last')->eq(helper::now())
            ->where('id')->eq($orderID)
            ->andWhere('account')->eq($this->app->user->account)
            ->exec();
        return !dao::isError();
    }

    /**
     * Get order by id 
     * 
     * @param  int    $rawOrder 
     * @access public
     * @return object
     */
    public function getOrderByRawID($rawOrder)
    {
        $order = $this->dao->select('*')->from(TABLE_ORDER)->where('id')->eq((int)$rawOrder)->fetch();
        if(!$order) return false;
        $order->humanOrder = $this->getHumanOrder($order->id);
        return $order;
    }

    /**
     * Get order by id 
     * 
     * @param  int    $humanOrder 
     * @access public
     * @return object
     */
    public function getOrderByHumanID($humanOrder)
    {
        $rawOrder = $this->getRawOrder($humanOrder);
        return $this->getOrderByRawID($rawOrder);
    }

    /**
     * Delivery products of an order.
     * 
     * @param  int    $orderID 
     * @access public
     * @return void
     */
    public function delivery($orderID)
    {
        $order = $this->getByID($orderID);

        $delivery = fixer::input('post')
            ->add('deliveriedBy', $this->app->user->account)
            ->add('deliveryStatus', 'send')
            ->add('last', helper::now())
            ->get();

        $this->dao->update(TABLE_ORDER)->data($delivery)->where('id')->eq($orderID)->exec();

        if(dao::isError()) return array('result' => 'fail', 'message' => dao::getError());

        if(isset($this->config->product->stock) and $this->config->product->stock)
        {
            $goodsList = $this->dao->select('*')->from(TABLE_ORDER_PRODUCT)->where('orderID')->eq($orderID)->fetchAll();
            foreach($goodsList as $goods)
            {
                $product = $this->dao->select('*')->from(TABLE_PRODUCT)->where('id')->eq($goods->productID)->fetch();
                if($product->amount < $goods->count)
                {
                    return array('result' => 'fail', 'message' => strip_tags(sprintf($this->lang->order->lowStocks, $goods->productName)));
                }
            }
        }

        if($order->payment == 'COD' and isset($this->config->product->stock) and $this->config->product->stock) $this->fixStocks($orderID);

        return array('result' => 'success', 'message' => $this->lang->saveSuccess, 'locate' => inlink('admin'));
    }

    /**
     * postDeliveryToAlipay 
     * 
     * @param  int    $order 
     * @access public
     * @return void
     */
    public function postDeliveryToAlipay($order)
    {
        $this->app->loadClass('alipay', true);

        $alipayConfig = $this->config->alipay->secured;
        $alipayConfig->pid   = $this->config->alipay->pid;
        $alipayConfig->key   = $this->config->alipay->key;
        $alipayConfig->email = $this->config->alipay->email;
        
        $alipay = new alipay($alipayConfig);
        $expressList = $this->loadModel('tree')->getPairs(0, 'express');
        $express     = zget($expressList, $this->post->express);
        return $alipay->postDelivery($order->sn, $express, $this->post->waybill);
    }

    /**
     * Get product infomation posted to buy.
     * 
     * @param  string $product 
     * @param  int    $count 
     * @access public
     * @return void
     */
    public function getPostedProducts($product, $count = 0)
    {
        $productIdList  = (array) $product;

        /* Get products(use groupBy to distinct products).  */
        $products = $this->dao->select('t1.*, t2.category')->from(TABLE_PRODUCT)->alias('t1')
            ->leftJoin(TABLE_RELATION)->alias('t2')->on('t1.id = t2.id')
            ->where('t1.id')->in($productIdList)
            ->andWhere('t2.type')->eq('product')
            ->beginIF(RUN_MODE == 'front')->andWhere('t1.status')->eq('normal')->fi()
            ->fetchAll('id');

        if(empty($products)) return array();

        /* Get categories for these products. */
        $categories = $this->dao->select('t2.id, t2.name, t2.alias, t1.id AS product')
            ->from(TABLE_RELATION)->alias('t1')
            ->leftJoin(TABLE_CATEGORY)->alias('t2')->on('t1.category = t2.id')
            ->where('t2.type')->eq('product')
            ->andWhere('t1.id')->in(array_keys($products))
            ->fetchGroup('product', 'id');

        /* Assign categories to it's product. */
        foreach($products as $product) $product->categories = !empty($categories[$product->id]) ? $categories[$product->id] : array();

        /* Get images for these products. */
        $images = $this->loadModel('file')->getByObject('product', array_keys($products), $isImage = true);
        
        /* Assign images to it's product. */
        foreach($products as $product)
        {
            if($_POST) $product->count = $this->post->count[$product->id];
            if(!$_POST) $product->count = $count;
            if(empty($images[$product->id])) continue;
            $product->image = new stdclass();
            if(isset($images[$product->id]))  $product->image->list = $images[$product->id];
            if(!empty($product->image->list)) $product->image->primary = $product->image->list[0];
        }
        
        return $products;
    }

    /**
     * Save settings. 
     * 
     * @access public
     * @return void
     */
    public function saveSetting()
    {
        $errors = '';
        if(!$this->post->payment) $errors['payment'] = array($this->lang->order->paymentRequired);
        if(!$this->post->confirmLimit) $errors['confirmLimit'] = array($this->lang->order->confirmLimitRequired);
        if(in_array('alipay', $this->post->payment) and strlen($this->post->pid) != 16) $errors['pid'] = array($this->lang->order->placeholder->pid);
        if(in_array('alipay', $this->post->payment) and strlen($this->post->key) != 32) $errors['key'] = array($this->lang->order->placeholder->key);
        if(in_array('alipay', $this->post->payment) and !validater::checkEmail($this->post->email)) $errors['email'] = array(sprintf($this->lang->error->email, $this->lang->order->alipayEmail)); 
        if(!empty($errors)) return array('result' => 'fail', 'message' => $errors);

        $shopSetting = array();
        $shopSetting['payment']      = join(',', $this->post->payment);
        $shopSetting['confirmLimit'] = $this->post->confirmLimit;
        $shopSetting['expireLimit']  = $this->post->expireLimit;
        $this->loadModel('setting')->setItems('system.common.shop', $shopSetting);

        $alipaySetting = array();
        $alipaySetting['pid']   = $this->post->pid;
        $alipaySetting['key']   = $this->post->key;
        $alipaySetting['email'] = $this->post->email;
        $result = $this->loadModel('setting')->setItems('system.common.alipay', $alipaySetting);

        return array('result' => 'success', 'message' => $this->lang->saveSuccess);
    }

    /**                                                                                                         
     * Display express info.                                                                                    
     *                                                                                                          
     * @param $order                                                                                            
     * @access public                                                                                           
     * @return string                                                                                           
     */                                                                                                         
     public function expressInfo($order='')                                                                     
     {                                                                                                          
         $expressList = $this->loadModel('tree')->getPairs(0, 'express');                                       
         $expressInfo = zget($expressList, $order->express);                                                    
         return $expressInfo;                                                                                   
     }

    /**
     * Clear an order.
     * 
     * @param  int    $orderID 
     * @access public
     * @return bool
     */
    public function clearOrder($orderID)
    {
        $this->dao->delete()->from(TABLE_ORDER)->where('id')->eq($orderID)->exec();
        if(dao::isError()) return false;
        $this->dao->delete()->from(TABLE_ORDER_PRODUCT)->where('orderID')->eq($orderID)->exec();
        return !dao::isError();
    }

    /**
     * Get lastest orders 
     * 
     * @access public
     * @return array 
     */
    public function getOrders()
    {
        $orders = $this->dao->select('*')->from(TABLE_ORDER)
            ->where('createdDate')->like(date("Y-m-d") . '%')
            ->orderBy('`createdDate` desc')
            ->limit(5)
            ->fetchAll();

        return $orders;
    }

    /**
     * Get products of order.
     *
     * @param  int    $orderID
     * @access public
     * @return array
     */
    public function getOrderProducts($orderID)
    {
        return $this->dao->select('*')->from(TABLE_ORDER_PRODUCT)
            ->where('orderID')->eq($orderID)
            ->fetchAll();
    }

    /**
     * Set order payment.
     *
     * @param  int    $orderID
     * @param  int    $payment
     * @access public
     * @return void
     */
    public function setPayment($orderID, $payment)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('payment')->eq($payment)
            ->set('last')->eq(helper::now())
            ->where('id')->eq($orderID)
            ->exec();
        if(dao::isError()) return false;
        return true;
    }

    /**
     * Get the subject of order.
     *
     * @param  int    $orderID
     * @access public
     * @return void
     */
    public function getSubject($orderID)
    {
        $products = $this->dao->select('id,productName')->from(TABLE_ORDER_PRODUCT)->where('orderID')->eq($orderID)->fetchPairs();
        if(count($products) == 1) return current($products);

        return sprintf($this->lang->order->payInfo, $this->config->site->name, date('Y-m-d'));
    }
    
    /** 
     * Save the save pay data
     *
     * @access public
     * @param  int
     * @return array
     */
    public function savePayment($orderID)
    {   
        $data = fixer::input('post')
            ->add('last', helper::now())
            ->remove('savepay')
            ->get();

        $order     = $this->getByID($orderID);
        $order->sn = $data->sn;
        $this->processOrder($order);

        $this->dao->update(TABLE_ORDER)
            ->data($data)
            ->batchCheck($this->config->order->require->savepay, 'notempty')
            ->where('id')->eq($orderID)
            ->exec();
        return !dao::isError();
    }

    /**
     * Edit the order
     * 
     * @access public
     * @param  string
     * @return array
     */
    public function edit($orderID)
    {   
        $data = fixer::input('post')->get();
        $content = new stdclass();
        
        $order = $this->getByID($orderID);

        if(isset($data->product))
        {
            foreach($data->product as $orderProductID =>$count)
            {
                if(preg_match("/^[1-9][0-9]*$/",$count))
                {
                    $this->dao->update(TABLE_ORDER_PRODUCT)->set('count')->eq($count)->where('id')->eq($orderProductID)->exec();
                }
                if($count == '0')
                {
                    $this->dao->delete()->from(TABLE_ORDER_PRODUCT)->where('id')->eq($orderProductID)->exec();
                }
            }
            $totalAmount = $this->computeOrderAmount($orderID);
            if($totalAmount != $order->amount)
            {
                $this->dao->update(TABLE_ORDER)->set('amount')->eq($totalAmount)->where('id')->eq($orderID)->exec();
            }
        }
        
        $address['account'] = $this->app->user->account;
        $address['address'] = $data->address;
        $address['contact'] = $data->contact;
        $address['phone']   = $data->phone;
        $address['zipcode'] = $data->zipcode;
        $address['lang']    = $this->app->clientLang;
        $address = json_encode($address);

        $content->address = $address; 

        if($order->deliveryStatus === 'send')
        {   
            $content->express        = $data->express;
            $content->waybill        = $data->waybill;
            $content->deliveriedDate = $data->deliveriedDate;
            $content->deliveriedBy   = $this->app->user->account;
        }
        
        $content->note = $data->note;
        $content->last = helper::now();
        
        $this->dao->update(TABLE_ORDER)->data($content)->where('id')->eq($orderID)->exec();
        
        return !dao::isError();
    }

    /**
     * Delete the order
     * 
     * @access public
     * @param  string
     * @return bool
     */
    public function deleteOrder($orderID)
    {
        $this->dao->update(TABLE_ORDER)
            ->set('status')->eq('deleted')
            ->set('last')->eq(helper::now())
            ->where('id')->eq($orderID)
            ->exec();
        return !dao::isError(); 
    }

    /**
     * Compute the total amount of order 
     *
     * @access public
     * @param  string
     * @return int
     */
    public function computeOrderAmount($orderID)
    {
        $products = $this->getOrderProducts($orderID);
        $amount   = 0;
        foreach($products as $product)
        {
            $amount += $product->count * $product->price;
        }
        return $amount;
    }
}
