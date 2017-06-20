<?php
$filter = new stdclass();
$filter->rules   = new stdclass();
$filter->default = new stdclass(); 
$filter->stat    = new stdclass(); 
$filter->article = new stdclass();
$filter->block   = new stdclass();
$filter->file    = new stdclass();
$filter->search  = new stdclass();
$filter->upgrade = new stdclass();
$filter->order   = new stdclass();
$filter->user    = new stdclass();
$filter->message = new stdclass();
$filter->thread  = new stdclass();
$filter->guarder = new stdclass();
$filter->log     = new stdclass();
$filter->reply   = new stdclass();

$filter->rules->md5        = '/^[a-z0-9]{32}$/';
$filter->rules->base64     = '/^[a-zA-Z0-9\+\/\=]+$/';
$filter->rules->checked    = '/^[0-9,]+$/';
$filter->rules->idList     = '/^[0-9\|]+$/';
$filter->rules->lang       = '/^[a-zA-Z_\-]+$/';
$filter->rules->any        = '/./';
$filter->rules->number     = '/^[0-9]+$/';
$filter->rules->character  = '/^[a-zA-Z_\-]+$/';
$filter->rules->date       = '/^[0-9\-]+$/';
$filter->rules->orderBy    = '/^\w+_(desc|asc)$/i';
$filter->rules->word       = '/^\w+$/';
$filter->rules->path       = '/(^//.|^/|^[a-zA-Z])?:?/.+(/$)?/';
$filter->rules->paramName  = '/^[a-zA-Z0-9_\.]+$/';
$filter->rules->paramValue = '/^[a-zA-Z0-9=_,`#+\^\/\.%\|\x7f-\xff]+$/';

$filter->default->moduleName = 'code';
$filter->default->methodName = 'code';
$filter->default->paramName  = 'reg::paramName';
$filter->default->paramValue = 'reg::paramValue';

$filter->default->get['onlybody'] = 'equal::yes';
$filter->default->get['HTTP_X_REQUESTED_WITH'] = 'equal::XMLHttpRequest';
$filter->default->get['recTotal']   = 'reg::number';
$filter->default->get['recPerPage'] = 'reg::number';
$filter->default->get['pageID']     = 'reg::number';
$filter->default->get['categoryID'] = 'reg::number';
$filter->default->get['searchWord'] = 'reg::word';
$filter->default->get['fullScreen'] = 'reg::number';
$filter->default->get['key']        = 'reg::word';

$filter->stat->default->get['begin'] = 'reg::date';
$filter->stat->default->get['end']   = 'reg::date';

$filter->article->get['admin']['tab']                     = 'reg::character';
$filter->block->get['edit']['type']                       = 'reg::character';
$filter->file->get['fileManager']['order']                = 'reg::character';
$filter->file->get['fileManager']['path']                 = 'reg::path';
$filter->search->get['index']['words']                    = 'reg::any';
$filter->upgrade->get['upgradeLicense']['agree']          = 'reg::any';
$filter->order->get['processAlipayOrder']['trade_status'] = 'reg::character';
$filter->order->get['processAlipayOrder']['out_trade_no'] = 'reg::character';
$filter->order->get['processAlipayOrder']['trade_no']     = 'reg::word';
$filter->user->get['admin']['provider']                   = 'reg::character';
$filter->user->get['admin']['user']                       = 'reg::character';
$filter->user->get['admin']['admin']                      = 'reg::number';
$filter->user->get['adminLog']['account']                 = 'account';
$filter->user->get['adminLog']['ip']                      = 'ip';
$filter->user->get['adminLog']['location']                = 'reg::base64';
$filter->user->get['adminLog']['date']                    = 'reg::date';
$filter->user->get['oauthCallback']['state']              = 'reg::base64';
$filter->user->get['oauthCallback']['code']               = 'reg::base64';
$filter->user->get['oauthCallback']['referer']            = 'reg::base64';

$filter->default->cookie['adminLang']    = 'reg::lang';
$filter->default->cookie['cart']         = 'reg::any';
$filter->default->cookie['currentGroup'] = 'reg::character';
$filter->default->cookie['device']       = 'reg::character';
$filter->default->cookie['lang']         = 'reg::lang';
$filter->default->cookie['adminsid']     = 'reg::word';
$filter->default->cookie['theme']        = 'reg::character';

$filter->message->default->cookie['cmts'] = 'reg::any';
$filter->thread->default->cookie['t']     = 'reg::checked';
$filter->user->default->cookie['referer'] = 'reg::base64';

$filter->guarder->cookie['validate']['validate'] = 'reg::character';
$filter->log->cookie['record']['vid']            = 'reg::number';
$filter->reply->cookie['post']['r']              = 'reg::checked';
