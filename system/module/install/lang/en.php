<?php
/**
 * The install module English file of chanzhiEPS.
 *
 * @copyright   Copyright 2009-2015 青岛易软天创网络科技有限公司(QingDao Nature Easy Soft Network Technology Co,LTD, www.cnezsoft.com)
 * @license     ZPLV1.2 (http://zpl.pub/page/zplv12.html)
 * @author      Chunsheng Wang <chunsheng@cnezsoft.com>
 * @package     install
 * @version     $Id$
 * @link        http://www.chanzhi.org
 */
$lang->install->common  = 'Install';
$lang->install->next    = 'Next';
$lang->install->pre     = 'Return';
$lang->install->reload  = 'Refresh';
$lang->install->error   = 'Error';

$lang->install->start            = 'Install';
$lang->install->keepInstalling   = 'Continue installation';
$lang->install->welcome          = 'Thank you for choosing Changer!';
$lang->install->license          = 'License';
$lang->install->desc             = <<<EOT
<p>With Changer, you can </p>
<blockquote>
  <ul>
    <li><strong>Brand promotion</strong>：build official website and show corporate image.</li>
    <li><strong>Marketing</strong>：SEO, email, text message, etc.</li>
    <li><strong>E-commerce</strong>：product demonstration and online sales.</li>
    <li><strong>CRM</strong>：aftersales support and maintain clients.</li>
  </ul>
</blockquote>
EOT;

$lang->install->newVersion = "Note: Changer has released <span id='version'></span> on <span id='releaseDate'></span>.<a href='' target='_blank' id='upgradeLink'>Download Now!</a>";

$lang->install->choice     = 'You can choose';
$lang->install->checking   = 'System Checkup';
$lang->install->ok         = 'Pass(√)';
$lang->install->fail       = 'Failed(×)';
$lang->install->loaded     = 'Loaded';
$lang->install->unloaded   = 'Not Loaded';
$lang->install->exists     = 'Directory exists. ';
$lang->install->notExists  = 'Directory does not exist. ';
$lang->install->writable   = 'Directory Writable ';
$lang->install->notWritable= 'Directory not Writable ';
$lang->install->phpINI     = 'PHP .ini file';
$lang->install->checkItem  = 'Check Item';
$lang->install->current    = 'Current Config';
$lang->install->result     = 'Check Result';
$lang->install->action     = 'Modification';

$lang->install->phpVersion = 'PHP version';
$lang->install->phpFail    = 'PHP version is 5.2.0+';

$lang->install->pdo          = 'PDO Extension';
$lang->install->pdoFail      = 'Change PHP .ini file and load PDO extension.';
$lang->install->pdoMySQL     = 'PDO_MySQL Extension';
$lang->install->pdoMySQLFail = 'Change PHP .ini file and load pdo_mysql extension.';
$lang->install->tmpRoot      = 'Temporary File Root';
$lang->install->dataRoot     = 'Upload File Root';
$lang->install->mkdir        = '<p>Directory %s has to be created. Use Linux command line is <br /> <code>mkdir -p %s</code></p>.';
$lang->install->chmod        = 'Permission of Directory "%s" has to be modified. Use Linux command line is <br /><code>chmod o=rwx -R %s</code>.';

$lang->install->settingDB      = 'Database Settings';
$lang->install->dbHost         = 'Database Host';
$lang->install->dbHostNote     = 'If you have no access to 127.0.0.1, please try localhost.';
$lang->install->dbPort         = 'Daatabase Port';
$lang->install->dbUser         = 'Database User';
$lang->install->dbPassword     = 'Database Password';
$lang->install->dbName         = 'Database Name';
$lang->install->dbPrefix       = 'Databse Prefix';
$lang->install->createDB       = 'Auto Create Database';
$lang->install->clearDB        = 'Clear Changer data';
$lang->install->importDemoData = 'Import demo data';

$lang->install->errorDBName        = "No '.' in databse name.";
$lang->install->errorConnectDB     = 'Database connection failed. ';
$lang->install->errorCreateDB      = 'Database creation failed.';
$lang->install->errorDBExists      = 'Database existed. Go back and Clear Data before try it again.';
$lang->install->errorCreateTable   = 'Table creation failed.';

$lang->install->setConfig  = 'Database Config';
$lang->install->key        = 'Config Key';
$lang->install->value      = 'Value';
$lang->install->saveConfig = 'Save Config';
$lang->install->save2File  = '<span class="red">Configuration file is not writable. Failed!</span> Copy the content in text box above and save it to "<strong> %s </strong>".';
$lang->install->saved2File = 'Configuration files has been saved to " <strong>%s</strong> ". You can modify this file later.';
$lang->install->errorNotSaveConfig = 'Configuration is not saved.';

$lang->install->setAdmin = 'Set Admin';
$lang->install->account  = 'Account';
$lang->install->password = 'Password';
$lang->install->errorEmptyPassword = 'Password Required!';

$lang->install->success    = "Installed!";
$lang->install->visitAdmin = 'Admin Login';
