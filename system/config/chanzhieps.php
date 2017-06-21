<?php

$config->cookiePath  = '/';               // The path of cookies.
$config->multi       = false;             // The config of multi site.
$config->seoMode     = true;              // Whether turn on seo mode or not.
$config->langVar     = 'l';               // RequestType=GET: the name of the view var.

$config->framework->autoLang = true;

$config->execPlaceholder       = 'EXEC_PLACEHOLDER';
$config->siteNavHolder         = 'SITENAV_PLACEHOLDER';
$config->viewsPlaceholder      = 'VIEWS_PLACEHOLDER';
$config->idListPlaceHolder     = 'IDLIST_PLACEHOLDER';
$config->searchWordPlaceHolder = 'SEARCHWORD_PLACEHOLDER';

/* Set the allowed tags.  */
$config->allowedTags = new stdclass();
$config->allowedTags->front = '<p><span><h1><h2><h3><h4><h5><em><u><strong><br><ol><ul><li><img><a><b><font><hr><pre><embed><video>';           // For front mode.
$config->allowedTags->admin = $config->allowedTags->front . '<dd><dt><dl><div><table><td><th><tr><tbody><iframe><style><header><nav><meta><video>'; // For admin users.

/* The methods should not display the exec infomation*/
$config->ignoreExecInfoPages = array();
$config->ignoreExecInfoPages[] = 'wechat.response';
$config->ignoreExecInfoPages[] = 'message.reply';

/* The methods should replace the views information*/
$config->replaceViewsPages = array();
$config->replaceViewsPages[] = 'article_view';
$config->replaceViewsPages[] = 'blog_view';
$config->replaceViewsPages[] = 'book_read';

/* The methods should replcae the list of views number */
$config->replaceViewsListPages = array();
$config->replaceViewsListPages[] = 'article_browse';
$config->replaceViewsListPages[] = 'blog_index';
$config->replaceViewsListPages[] = 'product_browse';

/* Views and themes. */

$config->product = new stdclass();

$config->enabledLangs = 'zh-cn,zh-tw,en';
$config->defaultLang  = 'zh-cn';

$config->site = new stdclass();
$config->site->resetPassword     = 'open'; 
$config->site->importantValidate = 'okFile,email';
$config->site->modules           = 'article,product';
$config->site->type              = 'portal';
$config->site->filterFunction    = 'close';
$config->site->keywords          = '';
$config->site->indexKeywords     = '';
$config->site->slogan            = '';
$config->site->copyright         = '';
$config->site->icpSN             = '';
$config->site->meta              = '';
$config->site->desc              = '';
$config->site->theme             = 'default';
$config->site->lang              = 'zh-cn';
$config->site->menu              = json_encode(array());
$config->site->execInfo          = 'show';

$config->company          = new stdclass();
$config->company->name    = '';
$config->company->desc    = '';
$config->company->content = '';
$config->company->contact = json_encode(array());

$config->template = new stdclass();
$config->template->desktop = new stdclass();
$config->template->desktop->name  = 'default';   // Supported themes.
$config->template->desktop->theme = 'default';   // Supported themes.
$config->template->parser         = 'default';   // Default parser.
$config->template->customVersion  = '';
$config->template->mobile = new stdclass();
$config->template->mobile->name  = 'mobile';   // Supported themes.
$config->template->mobile->theme = 'default';   // Supported themes.

$config->layout = new stdclass();
$config->layout->default_default = 0;
$config->layout->default_tartan  = 0;
$config->layout->default_wide    = 0;
$config->layout->default_clean   = 0;
$config->layout->default_blank   = 0;
$config->layout->mobile_default  = 0;
$config->layout->mobile_colorful = 0;

$config->cdn = new stdclass();
$config->cdn->open = 'close';
$config->cdn->host = 'http://cdn.chanzhi.org/';

$config->css = new stdclass();
$config->js  = new stdclass();

/* Suported languags label. */
$config->langAbbrLabels['zh-cn'] = '简';
$config->langAbbrLabels['zh-tw'] = '繁';
$config->langAbbrLabels['en']    = 'En';

/* Languags shortcuts. */
$config->langsShortcuts['zh-cn'] = 'cn';
$config->langsShortcuts['zh-tw'] = 'tw';
$config->langsShortcuts['en']    = 'en';

$config->file->maxSize = 2 * 1024 * 1024;  // Max size allowed(Byte).

/*Thanks list*/
$config->thanksList['IPIP.NET']            = 'http://www.ipip.net/';
$config->thanksList['Lessphp v0.4.0']      = 'http://leafo.net/lessphp/';
$config->thanksList['MobileDetect 2.8.15'] = 'http://mobiledetect.net/';
$config->thanksList['PhpConcept 2.8.2']    = 'http://www.phpconcept.net/';
$config->thanksList['PHPMailer 5.1']       = 'http://phpmailer.worxware.com/';
$config->thanksList['PhpThumb 3.0']        = 'http://phpthumb.sourceforge.net/';
$config->thanksList['HTML Purifier 4.6.0'] = 'http://htmlpurifier.org/';
$config->thanksList['PHP QRCode 1.1.4']    = 'http://phpqrcode.sourceforge.net/';
$config->thanksList['Snoopy 1.2.4']        = 'http://snoopy.sourceforge.net/';
$config->thanksList['Spyc 0.5']            = 'http://code.google.com/p/spyc/';

/* Module dependence setting. */
$config->dependence = new stdclass();
$config->dependence->article[]      = 'article';
$config->dependence->blog[]         = 'blog';
$config->dependence->page[]         = 'page';
$config->dependence->product[]      = 'product';
$config->dependence->book[]         = 'book';
$config->dependence->user[]         = 'user';
$config->dependence->forum[]        = 'forum';
$config->dependence->forum[]        = 'user';
$config->dependence->reply[]        = 'forum';
$config->dependence->reply[]        = 'user';
$config->dependence->message[]      = 'message';
$config->dependence->shop[]         = 'shop';
$config->dependence->shop[]         = 'user';
$config->dependence->cart[]         = 'shop';
$config->dependence->address[]      = 'shop';
$config->dependence->express[]      = 'shop';
$config->dependence->order[]        = 'user';
$config->dependence->search[]       = 'search';
$config->dependence->score[]        = 'score';
$config->dependence->score[]        = 'user';
$config->dependence->stat[]         = 'stat';
$config->dependence->log[]          = 'stat';
$config->dependence->submission[]   = 'submission';
$config->dependence->submission[]   = 'user';
$config->dependence->orderSetting[] = 'product';
$config->dependence->comment[]      = 'message';
$config->dependence->wechat[]       = 'user';
$config->dependence->tag[]          = 'article';
$config->dependence->order[]        = 'shop';

/* The tables. */
define('TABLE_CONFIG',         $config->db->prefix . 'config');
define('TABLE_CATEGORY',       $config->db->prefix . 'category');
define('TABLE_PACKAGE',        $config->db->prefix . 'package');
define('TABLE_RELATION',       $config->db->prefix . 'relation');
define('TABLE_PRODUCT',        $config->db->prefix . 'product');
define('TABLE_PRODUCT_CUSTOM', $config->db->prefix . 'product_custom');
define('TABLE_ARTICLE',        $config->db->prefix . 'article');
define('TABLE_BLOCK',          $config->db->prefix . 'block');
define('TABLE_TAG',            $config->db->prefix . 'tag');
define('TABLE_BOOK',           $config->db->prefix . 'book');
define('TABLE_LAYOUT',         $config->db->prefix . 'layout');
define('TABLE_COMMENT',        $config->db->prefix . 'comment');
define('TABLE_THREAD',         $config->db->prefix . 'thread');
define('TABLE_REPLY',          $config->db->prefix . 'reply');
define('TABLE_USER',           $config->db->prefix . 'user');
define('TABLE_OAUTH',          $config->db->prefix . 'oauth');
define('TABLE_GROUP',          $config->db->prefix . 'group');
define('TABLE_GROUPPRIV',      $config->db->prefix . 'grouppriv');
define('TABLE_USERGROUP',      $config->db->prefix . 'usergroup');
define('TABLE_FILE',           $config->db->prefix . 'file');
define('TABLE_DOWN',           $config->db->prefix . 'down');
define('TABLE_LOG',            $config->db->prefix . 'log');
define('TABLE_MESSAGE',        $config->db->prefix . 'message');
define('TABLE_WX_PUBLIC',      $config->db->prefix . 'wx_public');
define('TABLE_WX_MESSAGE',     $config->db->prefix . 'wx_message');
define('TABLE_WX_RESPONSE',    $config->db->prefix . 'wx_response');
define('TABLE_SEARCH_INDEX',   $config->db->prefix . 'search_index');
define('TABLE_SEARCH_DICT',    $config->db->prefix . 'search_dict');
define('TABLE_CART',           $config->db->prefix . 'cart');
define('TABLE_ORDER',          $config->db->prefix . 'order');
define('TABLE_ORDER_PRODUCT',  $config->db->prefix . 'order_product');
define('TABLE_ADDRESS',        $config->db->prefix . 'address');
define('TABLE_SLIDE',          $config->db->prefix . 'slide');
define('TABLE_STATLOG',        $config->db->prefix . 'statlog');
define('TABLE_STATVISITOR',    $config->db->prefix . 'statvisitor');
define('TABLE_STATREFERER',    $config->db->prefix . 'statreferer');
define('TABLE_STATREPORT',     $config->db->prefix . 'statreport');
define('TABLE_STATREGION',     $config->db->prefix . 'statregion');
define('TABLE_SCORE',          $config->db->prefix . 'score');
define('TABLE_BLACKLIST',      $config->db->prefix . 'blacklist');
define('TABLE_OPERATIONLOG',   $config->db->prefix . 'operationlog');
define('TABLE_WIDGET',         $config->db->prefix . 'widget');
define('TABLE_ACTION',         $config->db->prefix . 'action');
define('TABLE_HISTORY',        $config->db->prefix . 'history');
