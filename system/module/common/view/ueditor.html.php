<?php if($extView = $this->getExtViewFile(__FILE__)){include $extView; return helper::cd();}?>
<?php
$module = $this->moduleName;
$method = $this->methodName;
js::set('themeRoot', $themeRoot);
if(!isset($config->$module->editor->$method)) return;
$editor = $config->$module->editor->$method;
$editor['id'] = explode(',', $editor['id']);
$editorLangs  = array('en' => 'en', 'zh-cn' => 'zh-cn', 'zh-tw' => 'zh-tw');
$editorLang   = isset($editorLangs[$app->getClientLang()]) ? $editorLangs[$app->getClientLang()] : 'en';

/* set uid for upload. */
$uid = uniqid('');
js::set('kuid', $uid);
?>
<script charset="utf-8" src="<?php echo $this->app->getWebRoot() . "js/"?>ueditor/ueditor.config.js"></script>
<script charset="utf-8" src="<?php echo $this->app->getWebRoot() . "js/"?>ueditor/ueditor.all.min.js"> </script>
<style>.edui-default.form-control{height: auto; padding: 0; box-shadow: none; width: auto;}</style>
<script>
var editor = <?php echo json_encode($editor);?>;

var toolbars = [[
    'paragraph', 'fontfamily', 'fontsize', '|',
    'forecolor', 'backcolor', 'bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'pasteplain', '|',
    'insertorderedlist', 'insertunorderedlist', 'justifyleft', 'justifycenter', 'justifyright', '|'],
    ['simpleupload', 'insertcode', '|',
    'link', 'unlink', '|',
    'inserttable', '|',
    'fullscreen', 'source', '|',
    'preview', 'help'
]];

var simple =
[ 'formatblock', 'fontsize', '|', 'bold', 'italic','underline', '|',
'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist', 'insertunorderedlist', '|',
'emoticons', 'image', 'link', '|', 'removeformat','undo', 'redo', 'source' ];
var simple = [[
    'paragraph', 'fontfamily', 'fontsize', 'lineheight', '|',
    'bold', 'italic', 'underline', 'strikethrough', '|',
    'justifyleft', 'justifycenter', 'justifyright', '|',
    'pasteplain', 'emotion', 'simpleupload', '|', 
    'link', 'unlink', 'anchor',
    'undo', 'redo', 'removeformat','insertorderedlist', 'insertunorderedlist', '|',
    'source', 'help']];

var full = [[
    'paragraph', 'fontfamily', 'fontsize', 'lineheight', '|',
    'forecolor', 'backcolor', '|', 
    'bold', 'italic', 'underline', 'strikethrough', '|',
    'justifyleft', 'justifycenter', 'justifyright', '|',
    'pasteplain', 'emotion', 'simpleupload', 'insertimage', '|', 
    'link', 'unlink', 'anchor', 'insertvideo', 'map'],
    ['undo', 'redo', 'removeformat', 'insertcode', '|',
    'insertorderedlist', 'insertunorderedlist', 'inserttable', '|',
    'indent', 'fullscreen', '|',
    'preview', 'source', 'searchreplace', 'help']];
function initUeditor(afterInit)
{
    $(':input[type=submit]').after("<input type='hidden' id='uid' name='uid' value=" + v.kuid + ">");
    var options = 
    {
        lang: '<?php echo $editorLang?>',
        toolbars: <?php echo $editor['tools']?>,
        serverUrl: '<?php echo $this->createLink('file', 'apiforueditor', "uid=$uid")?>',
        autoClearinitialContent: false,
        wordCount: false,
        <?php if($editorLang != 'zh-cn' and $editorLang != 'zh-tw') echo "iframeCssUrl:'',"; //When lang is zh-cn or zh-tw then load ueditor/themes/iframe.css file for font-family and size of editor.?>
        enableAutoSave: false,
        elementPathEnabled: false,
        initialFrameWidth: '100%',
        zIndex: 5
    };
    if(!window.editor) window.editor = {};
    $.each(editor.id, function(key, editorID)
    {
        var $editor = $('#' + editorID);
        if($editor.length)
        {
            var ueditor = UE.getEditor(editorID, options);
            window.editor['#'] = window.editor[editorID] = ueditor;
            
            ueditor.addListener('ready', function()
            {
                $(this.container).parent().removeClass('form-control');
            });
            ueditor.addListener('fullscreenchanged', function(e, fullscreen)
            {
                $(this.container).css('z-index', fullscreen ? 1050 : 5);
            });
        }
    });

    if($.isFunction(afterInit)) afterInit();
}
$(document).ready(initUeditor);
</script>
