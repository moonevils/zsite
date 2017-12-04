{!echo '<?xml version="1.0" encoding="utf-8"?>'}
<rss version="2.0">
<channel>
  <title>{!echo $title}</title>
  <link>{!echo $siteLink}</link>
  <description>{!echo $desc}</description>
  <copyright>{!echo $config->company->name . $config->site->copyright . '-' . date('Y')}</copyright>
  <lastBuildDate>{!echo $lastDate}</lastBuildDate>
  
{*php*}
  foreach($articles as $article):
    $category = current($article->categories);
    $article->content = str_replace('src="/data/upload/', 'src="' . getWebRoot(true) . 'data/upload/', $article->content);
    $article->content = str_replace("src='/data/upload/", "src='" . getWebRoot(true) . 'data/upload/', $article->content);
{*/php*}
  <item>
    <title>{!echo $article->title?></title>
    <description><![CDATA[  {!echo $article->content}]]></description>
    <link>{!echo str_replace('&', '&amp;', $siteLink . $control->createLink('blog', 'view', "id=$article->id", "category={$category->alias}&name=$article->alias", 'html'))}</link>
    <category>{!echo $category->name}</category>
    <pubDate>{!echo $article->addedDate . ' +0800'}</pubDate>
  </item>
  {/foreach}
</channel>
</rss>
