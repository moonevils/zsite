<?php
/**
 * The action en file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Tingting Dai <daitingting@xirangit.com>
 * @package     action
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->action->common  = 'Logs';

$lang->action->objectType = 'Type';
$lang->action->objectID   = 'ID';
$lang->action->objectName = 'Details';
$lang->action->actor      = 'Account';
$lang->action->action     = 'Action';
$lang->action->date       = 'Date';

$lang->action->objectTypes['order'] = 'Order';

$lang->action->desc = new stdclass();
$lang->action->desc->common            = '$date, <strong>$action</strong> by <strong>$actor</strong>' . "\n";
$lang->action->desc->created           = '$date, created by <strong>$actor</strong>.';
$lang->action->desc->paid              = '$date, paid by <strong>$actor</strong>.' . "\n";
$lang->action->desc->savedpayment      = '$date, saved payment by <strong>$actor</strong>.' . "\n";
$lang->action->desc->refunded          = '$date, refunded $extra by <strong>$actor</strong>.' . "\n";
$lang->action->desc->deliveried        = '$date, deliveried by <strong>$actor</strong>.' . "\n";
$lang->action->desc->confirmedDelivery = '$date, confirmed delivery by <strong>$actor</strong>.' . "\n";
$lang->action->desc->edited            = '$date, edited by <strong>$actor</strong>.' . "\n";
$lang->action->desc->finished          = '$date, finished by <strong>$actor</strong>.' . "\n";
$lang->action->desc->canceled          = '$date, canceled by <strong>$actor</strong>.' . "\n";
$lang->action->desc->deleted           = '$date, 由 <strong>$actor</strong> 删除。' . "\n";

/* The action labels. */
$lang->action->label = new stdclass();
$lang->action->label->created           = 'created';
$lang->action->label->paid              = 'paid';
$lang->action->label->savedpayment      = 'saved payment';
$lang->action->label->refunded          = 'refunded';
$lang->action->label->deliveried        = 'deliveried';
$lang->action->label->confirmedDelivery = 'confirmed delivery';
$lang->action->label->edited            = 'edited';
$lang->action->label->finished          = 'finished';
$lang->action->label->canceled          = 'canceled';
$lang->action->label->deleted           = 'deleted';
