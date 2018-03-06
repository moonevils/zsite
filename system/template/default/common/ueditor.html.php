{$module = $this->moduleName}
{$method = $this->methodName}
{!js::set('themeRoot', $themeRoot)}
{if(!isset($config->$module->editor->$method))} {return true;} {/if}
{$editor = $config->$module->editor->$method}
{$editor['id'] = explode(',', $editor['id'])}
{$editorLangs  = array('en' => 'en', 'zh-cn' => 'zh-cn', 'zh-tw' => 'zh-tw')}
{$editorLang   = isset($editorLangs[$app->getClientLang()]) ? $editorLangs[$app->getClientLang()] : 'en'}
{$uid = uniqid('')}
{!js::set('kuid', $uid)}
<script type="text/javascript" charset="utf-8" src="{$this->app->getWebRoot()} 'js/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="{$this->app->getWebRoot()} 'js/ueditor/ueditor.all.js"> </script>
<script language='javascript'>
var editor = {!json_encode($editor)};
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

$(document).ready(initUeditor);
function initUeditor(afterInit)
{
    $(':input[type=submit]').after("<input type='hidden' id='uid' name='uid' value=" + v.kuid + ">");
    var options = 
    {
        lang: '{$editorLang}',
        toolbars: {$editor['tools']},
        serverUrl: '{$this->createLink('file', 'apiforueditor', "uid=$uid")}',
        autoClearinitialContent:false,
        wordCount:false,
        {if($editorLang != 'zh-cn' and $editorLang != 'zh-tw'}
        iframeCssUrl:'',
        {/if}
        enableAutoSave:false,
        elementPathEnabled:false
    };
    $.each(editor.id, function(key, editorID)
    {
        if(!window.editor) window.editor = {};
        if($('#' + editorID).size() != 0)
        {
            ueditor = UE.getEditor(editorID, options);
            window.editor['#'] = window.editor[editorID] = ueditor;
            ueditor.addListener('ready', function()
            {
                $('#' + editorID).find('.edui-editor').css('z-index', '5');
            });
        }
    });

    if($.isFunction(afterInit)) afterInit();
}
</script>
