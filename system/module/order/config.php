<?php
$config->order = new stdclass();
$config->order->require = new stdclass();
$config->order->require->create   = 'account,address';
$config->order->require->delivery = 'deliveriedDate,express,waybill,deliveriedBy';
$config->order->require->setting  = 'payment,pid,key,confirmLimit,email';

$config->order->statusFields = new stdclass();
$config->order->statusFields->not_paid  = 'payStatus';
$config->order->statusFields->paid      = 'payStatus';
$config->order->statusFields->not_send  = 'deliveryStatus';
$config->order->statusFields->send      = 'deliveryStatus';
$config->order->statusFields->confirmed = 'deliveryStatus';
$config->order->statusFields->normal    = 'status';
$config->order->statusFields->finished  = 'status';
$config->order->statusFields->canceled  = 'status';
