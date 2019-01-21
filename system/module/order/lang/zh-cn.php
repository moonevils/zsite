<?php
$lang->order->common  = '订单';

$lang->order->id                = 'ID';
$lang->order->productInfo       = '商品信息';
$lang->order->account           = '帐号';
$lang->order->address           = '收货地址';
$lang->order->price             = '价格';
$lang->order->score             = '积分';
$lang->order->count             = '数量';
$lang->order->amount            = '金额';
$lang->order->sn                = '交易号';
$lang->order->payStatus         = '付款状态';
$lang->order->paidDate          = '付款时间';
$lang->order->deliveryStatus    = '发货状态';
$lang->order->deliveriedDate    = '发货时间';
$lang->order->confirmedDate     = '收货时间';
$lang->order->payment           = '交易方式';
$lang->order->createdDate       = '下单时间';
$lang->order->express           = '快递公司';
$lang->order->waybill           = '快递单号';
$lang->order->expressInfo       = '快递详情';
$lang->order->receiver          = '收货人';
$lang->order->noRecord          = '无';
$lang->order->status            = '状态';
$lang->order->note              = '买家留言';
$lang->order->frontNote         = '留言';
$lang->order->basic             = '基本信息';
$lang->order->type              = '类型';
$lang->order->info              = '订单信息';
$lang->order->savePay           = '回款';
$lang->order->edit              = '编辑';
$lang->order->contact           = '收货姓名';
$lang->order->phone             = '手机号';
$lang->order->zipcode           = '邮编';
$lang->order->deliveryStatus    = '发货状态';
$lang->order->last              = '最后处理时间';
$lang->order->comment           = '备注';

$lang->order->deliverList['not_send']  = '待发货';
$lang->order->deliverList['send']      = '已发货';
$lang->order->deliverList['confirmed'] = '已收货';

$lang->order->admin          = '订单管理';
$lang->order->view           = '详情';
$lang->order->setting        = '系统设置';
$lang->order->browse         = '我的订单';
$lang->order->bought         = '查看已买商品';
$lang->order->createdSuccess = '订单创建成功！';
$lang->order->paidSuccess    = '恭喜，订单支付成功！';
$lang->order->submit         = '提交订单';
$lang->order->cancel         = '取消';
$lang->order->pay            = '支付';
$lang->order->goToPay        = '订单创建成功，请到支付页面完成付款。';
$lang->order->editPrice      = '改价';
$lang->order->return         = '收款';
$lang->order->refund         = '退款';
$lang->order->delivery       = '发货';
$lang->order->delete         = '删除';
$lang->order->finish         = '完成';
$lang->order->confirm        = '确认订单信息';
$lang->order->selectProducts = "选择了 <strong class='text-danger'>%s</strong> 件商品，";
$lang->order->totalToPay     = "共计：<strong id='amount' class='text-lg text-danger'>%s</strong>";
$lang->order->cartProducts   = "共<strong>%s</strong> 件商品";
$lang->order->statistics     = "<strong class='text-danger'>%s</strong> 件商品共计:<strong id='amount' class='text-lg text-danger'>%s</strong>";
$lang->order->payInfo        = "%s %s 商品订单";
$lang->order->goToBank       = "请在线支付您的订单。";
$lang->order->track          = '物流';
$lang->order->life           = '订单跟踪';
$lang->order->days           = '天';
$lang->order->deliveryInfo   = '查看详情';
$lang->order->backToCart     = '返回购物车修改';
$lang->order->paid           = '我已付款';
$lang->order->products       = '订单产品';
$lang->order->selectPayment  = '选择支付方式';
$lang->order->settlement     = '去结算';
$lang->order->check          = '订单结算';
$lang->order->all            = '所有';
$lang->order->applyRefund    = '申请退款';
$lang->order->wechatpay      = '微信支付';
$lang->order->scanCode       = '微信扫码支付';
$lang->order->wechatScan     = '请使用微信扫一扫<br>扫描二维码支付';
$lang->order->inWechatTip    = '提示：微信浏览器不支持支付宝支付，如需使用支付宝支付，请复制本页网址到其他浏览器进行操作';

$lang->order->confirmLimit         = '确认收货周期';
$lang->order->expireLimit          = '订单过期时间';
$lang->order->confirmReceived      = '确认收货';
$lang->order->deliveryConfirmed    = '您的订单已经确认收货成功！';
$lang->order->confirmWarning       = "请收到货后，再确认收货！否则您可能钱货两空！";
$lang->order->cancelWarning        = "确认取消订单？";
$lang->order->cancelSuccess        = "订单已取消";
$lang->order->paymentRequired      = '需要至少一种交易方式';
$lang->order->confirmLimitRequired = '需要设定确认收货周期';
$lang->order->finishWarning        = "确认完成订单？";
$lang->order->noProducts           = "订单中没有产品";
$lang->order->lowStocks            = "<strong>%s</strong> 库存不足";
$lang->order->invokeWechatpay      = '正在调用微信支付';

$lang->order->alipayParam    = '支付宝参数';
$lang->order->wechatpayParam = '微信支付参数';

$lang->order->alipayPid   = '合作者ID';
$lang->order->alipayKey   = '合作者KEY';
$lang->order->alipayEmail = '支付宝邮箱';

$lang->order->wechatpayAppid     = '公众号APPID';
$lang->order->wechatpayMchid     = '商户号';
$lang->order->wechatpayApiKey    = '支付密钥';
$lang->order->wechatpayAppSecret = '公众号密钥';
$lang->order->wechatpayH5Status  = 'H5支付';
$lang->order->wechatpayNote      = '如果微信长时间未打开，建议您返回选择其他方式';

$lang->order->placeholder = new stdclass();
$lang->order->placeholder->pid       = '合作身份者id，以2088开头的16位纯数字';
$lang->order->placeholder->key       = '安全检验码，以数字和字母组成的32位字符';
$lang->order->placeholder->email     = '支付宝商家邮箱';
$lang->order->placeholder->appid     = '微信分配的公众账号ID';
$lang->order->placeholder->mchid     = '微信支付分配的商户号';
$lang->order->placeholder->apikey    = '微信支付API安全密钥';
$lang->order->placeholder->appsecret = '微信公众号密钥';

$lang->order->paymentList = array();
$lang->order->paymentList['alipay']        = '支付宝即时到帐';
$lang->order->paymentList['alipaySecured'] = '支付宝担保交易';
$lang->order->paymentList['COD']           = '货到付款';
$lang->order->paymentList['offlinepay']    = '线下支付';
$lang->order->paymentList['wechatpay']     = '微信支付';

$lang->order->statusList = array();
$lang->order->statusList['not_paid']  = '待付款';
$lang->order->statusList['paid']      = '已付款';
$lang->order->statusList['not_send']  = '待发货';
$lang->order->statusList['send']      = '待收货';
$lang->order->statusList['confirmed'] = '已收货';
$lang->order->statusList['normal']    = '进行中';
$lang->order->statusList['finished']  = '已完成';
$lang->order->statusList['canceled']  = '已取消';
$lang->order->statusList['refunding'] = '待退款';
$lang->order->statusList['refunded']  = '已退款';
$lang->order->statusList['expired']   = '已过期';

$lang->order->payStatusList = array();
$lang->order->payStatusList['not_paid']  = '未付款';
$lang->order->payStatusList['paid']      = '已付款';
$lang->order->payStatusList['refunding'] = '待退款';
$lang->order->payStatusList['refunded']  = '已退款';

$lang->order->types = array();
$lang->order->types['shop']  = '商品';
$lang->order->types['score'] = '积分';

$lang->order->abbr = new stdclass();
$lang->order->abbr->paidDate       = '付款';
$lang->order->abbr->deliveriedDate = '发货';
$lang->order->abbr->confirmedDate  = '收货';
$lang->order->abbr->createdDate    = '下单';

$lang->order->searchLabels = new stdclass();
$lang->order->searchLabels->all         = '所有|mode=all';
$lang->order->searchLabels->waitPay     = '待付款|mode=payStatus&param=not_paid';
$lang->order->searchLabels->waitSend    = '待发货|mode=deliveryStatus&param=not_send';
$lang->order->searchLabels->waitConfirm = '待收货|mode=deliveryStatus&param=send';
$lang->order->searchLabels->refunding   = '待退款|mode=payStatus&param=refunding';
$lang->order->searchLabels->confirmed   = '已收货|mode=deliveryStatus&param=confirmed';
$lang->order->searchLabels->finished    = '已完成|mode=status&param=finished';
$lang->order->searchLabels->refunded    = '已退款|mode=payStatus&param=refunded';
$lang->order->searchLabels->canceled    = '已取消|mode=status&param=canceled';
$lang->order->searchLabels->expired     = '已过期|mode=status&param=expired';
