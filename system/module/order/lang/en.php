<?php
$lang->order->common  = 'Order';

$lang->order->id             = 'ID';
$lang->order->productInfo    = 'Product info';
$lang->order->account        = 'Account';
$lang->order->address        = 'Shipping Address';
$lang->order->price          = 'Price';
$lang->order->score          = 'Score';
$lang->order->count          = 'Count';
$lang->order->amount         = 'Amount';
$lang->order->sn             = 'TSN';
$lang->order->payStatus      = 'Payment Status';
$lang->order->paidDate       = 'Paid Date';
$lang->order->deliveryStatus = 'Shipment Status';
$lang->order->deliveriedDate = 'Shipping Date';
$lang->order->confirmedDate  = 'Deliver Date';
$lang->order->payment        = 'Check Out';
$lang->order->createdDate    = 'Order Created Date';
$lang->order->express        = 'Express Courier';
$lang->order->waybill        = 'Tracking Number';
$lang->order->expressInfo    = 'Express Info';
$lang->order->receiver       = 'Receiver';
$lang->order->noRecord       = 'N/A';
$lang->order->status         = 'Status';
$lang->order->note           = 'Note';
$lang->order->frontNote      = 'Note';
$lang->order->basic          = 'Basic Info';
$lang->order->type           = 'Type';
$lang->order->info           = 'Order details';
$lang->order->savePay        = 'Payment';
$lang->order->edit           = 'Edit';
$lang->order->contact        = 'Contact';
$lang->order->phone          = 'Phone';
$lang->order->zipcode        = 'Zipcode';
$lang->order->deliveryStatus = 'Delivery Status';

$lang->order->deliverList['not_send']  = 'To be delivered';
$lang->order->deliverList['send']      = 'Delivered';
$lang->order->deliverList['confirmed'] = 'Received';

$lang->order->admin          = 'Order';
$lang->order->view           = 'View Details';
$lang->order->setting        = 'System Settings';
$lang->order->browse         = 'My Order';
$lang->order->bought         = 'Purchased';
$lang->order->createdSuccess = 'Order has been created!';
$lang->order->paidSuccess    = 'Thank you for your payment!';
$lang->order->submit         = 'Submit Order';
$lang->order->cancel         = 'Cancel';
$lang->order->pay            = 'Check Out';
$lang->order->goToPay        = 'Order has been made. Please continue your payment.';
$lang->order->return         = 'Collect';
$lang->order->delivery       = 'Ship';
$lang->order->finish         = 'Submit';
$lang->order->confirm        = 'Confirm';
$lang->order->selectProducts = "You have <strong class='text-danger'>%s</strong> in your cart";
$lang->order->totalToPay     = "and your total is <strong id='amount' class='text-danger'>%s</strong>";
$lang->order->payInfo        = "%s %s order";
$lang->order->goToBank       = "Please pay online.";
$lang->order->track          = 'View Shipment';
$lang->order->life           = 'Track your order';
$lang->order->days           = 'Day';
$lang->order->deliveryInfo   = 'View Details';
$lang->order->backToCart     = 'Back to Cart';
$lang->order->paid           = 'Paid Order';
$lang->order->products       = 'Ordered Product';
$lang->order->selectPayment  = 'Choose payment';
$lang->order->settlement     = 'Check Out';

$lang->order->confirmLimit         = 'Receiving Cyle';
$lang->order->confirmReceived      = 'Receive Order';
$lang->order->deliveryConfirmed    = 'Your order has been received！';
$lang->order->confirmWarning       = "Please confirm after your order has been received!";
$lang->order->cancelWarning        = "Do you want to cancle this order?";
$lang->order->cancelSuccess        = "Order cancelled";
$lang->order->paymentRequired      = 'Choose payment method';
$lang->order->confirmLimitRequired = 'Set receiving cycle';
$lang->order->finishWarning        = "Do you want to submit this order?";
$lang->order->noProducts           = "No product in this order";
$lang->order->lowStocks            = "<strong>%s</strong> is out of stock!";

$lang->order->alipayPid   = 'Partner ID';
$lang->order->alipayKey   = 'Partner KEY';
$lang->order->alipayEmail = 'Alipay Email';
$lang->order->score       = 'Refill Points';

$lang->order->placeholder = new stdclass();
$lang->order->placeholder->pid   = 'Corporate identity to ID, 16 pure number begin with 2088.';
$lang->order->placeholder->key   = 'Security checking code, 32 characters to numbers and letters.';
$lang->order->placeholder->email = 'Alipay Email';

$lang->order->paymentList = array();
$lang->order->paymentList['alipay']        = 'Alipay Payment';
$lang->order->paymentList['alipaySecured'] = 'Alipay Secured';
$lang->order->paymentList['COD']           = 'Cash on Delivery';
$lang->order->paymentList['offlinepay']    = 'Offline Payment';

$lang->order->statusList = array();
$lang->order->statusList['not_paid']  = 'Not Paid';
$lang->order->statusList['paid']      = 'Paid';
$lang->order->statusList['not_send']  = 'To be Shipped';
$lang->order->statusList['send']      = 'Shipped';
$lang->order->statusList['confirmed'] = 'Confirmed';
$lang->order->statusList['normal']    = 'In Process';
$lang->order->statusList['finished']  = 'Finished';
$lang->order->statusList['canceled']  = 'Cancelled';

$lang->order->types = array();
$lang->order->types['shop']  = 'Goods order';
$lang->order->types['score'] = 'Score order';

$lang->order->abbr = new stdclass();
$lang->order->abbr->paidDate       = 'Paid';
$lang->order->abbr->deliveriedDate = 'Delivered';
$lang->order->abbr->confirmedDate  = 'Received';
$lang->order->abbr->createdDate    = 'Created';
