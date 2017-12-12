{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'header')}
{include TPL_ROOT . 'common/datepicker.html.php'}
{include TPL_ROOT . 'common/kindeditor.html.php'}
{include TPL_ROOT . 'common/chosen.html.php'}
<div class='page-user-control'>
  <div class='row'>
    {include TPL_ROOT . 'user/side.html.php'}
    <div class='col-md-10'>
      <div class='panel'>
        <div class='panel-heading'><strong><i class='icon-edit'></i> {!echo $lang->article->edit}</strong></div>
        <div class='panel-body'>
        <form method='post' id='ajaxForm' class='ve-form'>
          <table class='table table-form'>
            <tbody class='articleInfo'>
            <tr>
              <th class='w-100px'>{!echo $lang->article->author}</th>
              <td>{!echo html::input('author', $article->author, "class='form-control w-150px'")}</td>
            </tr>
            <tr>
              <th>{!echo $lang->article->source}</th>
              <td class='w-100px'>{!echo html::select('source', $lang->article->sourceList, $article->source, "class='form-control chosen'")}</td>
              <td>
                <div id='copyBox' class='row'>
                  <div class='col-sm-4'>{!echo html::input('copySite', $article->copySite, "class='form-control' placeholder='{$lang->article->copySite}'")} </div>
                  <div class='col-sm-8'>{!echo html::input('copyURL',  $article->copyURL, "class='form-control' placeholder='{$lang->article->copyURL}'")}</div>
                </div>
              </td>
            </tr>
            </tbody>
            <tr>
              <th>{!echo $lang->article->title}</th>
              <td colspan='2'>
                <div class='input-group'>
                  {!echo html::input('title', $article->title, "class='form-control'")}
                </div>
              </td>
            <tbody class='articleInfo'>
            <tr>
              <th>{!echo $lang->article->keywords}</th>
              <td colspan='2'> {!echo html::input('keywords', $article->keywords, "class='form-control' placeholder='{$lang->keywordsHolder}'")}</td>
            </tr>
            <tr>
              <th>{!echo $lang->article->summary}</th>
              <td colspan='2'>{!echo html::textarea('summary', $article->summary, "rows='2' class='form-control'")}</td>
            </tr>
            </tbody>
            <tbody class='articleInfo'>
            <tr>
              <th>{!echo $lang->article->content}</th>
              <td colspan='2'>{!echo html::textarea('content', htmlspecialchars($article->content), "rows='10' class='form-control'")}</td>
            </tr>
            </tbody>
            <tr>
              <th></th><td colspan='2'>{!echo html::submitButton()}</td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
</div>
{include $control->loadModel('ui')->getEffectViewFile('default', 'common', 'footer')}
