{noparse}
<style>
.panel-body .cards-custom .card > .card-heading {min-height: 40px; height: 40px; padding: 10px; font-size: 13px; position: relative;}
.panel-body .cards-custom .card > .card-heading > strong {display: inline-block; vertical-align: middle; max-width: 150px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;}
.panel-body .cards-custom .card > .card-heading > .views {position: absolute; right: 0; top: 10px;}
.panel-body .cards-custom .card > .card-content {padding: 0 10px 10px 10px; margin-bottom: 10px;}
</style>
{/noparse}

<div class='panel-body'>
  <div class='cards cards-borderless cards-custom'>
    {foreach($products as $product)}
    {$url = helper::createLink('product', 'view', "id=$product->id", "category={{$product->category->alias}}&name=$product->alias")}

    {if(!empty($product->image))}
    {$recPerRow = (isset($content->recPerRow) and !empty($content->recPerRow)) ? $content->recPerRow : '3'}
    <div class='col-md-12' data-recperrow="{!echo $recPerRow}">
      <a class='card' href="{!echo $url}">
        <div class='media' style='background-image: url({!echo $model->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, 'product', 'middleURL')});'>
          {$title = $product->image->primary->title ? $product->image->primary->title : $product->name}
          {!echo html::image($model->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, 'product', 'middleURL'), "title='{{$title}}' alt='{{$product->name}}'")}
        </div>

        <div class="card-heading {if(isset($content->alignTitle) && $content->alignTitle == 'middle') echo 'text-center'}">
          <strong>
            {if(zget($content, 'showCategory') == 1)} {!echo '[' . ($content->categoryName == 'abbr' and $product->category->abbr) ? $product->category->abbr : $product->category->name . ']'} {/if}
            {!echo $product->name}
          </strong>
          {if(isset($content->showPrice) and $content->showPrice)}
          <span>
            $currencySymbol = $model->config->product->currencySymbol;
            {if(!$product->unsaleable)}
              {if($product->negotiate)}
                {$priceLabel = $lang->product->negotiate}
              {else}
                {if($product->promotion)} {$priceLabel = $currencySymbol . $product->promotion} {/if}
                {if(!$product->promotion and $product->price)} {$priceLabel = $currencySymbol . $product->price} {/if}
              {/if}
            {/if}
            {if(isset($priceLabel))} {!echo "&nbsp;&nbsp;<span class='text-danger'>" . $priceLabel . '</span>'} {/if}
          </span>
          {/if}

          {if(isset($content->showViews) and $content->showViews)}
            <div class='views'><i class="icon icon-eye-open"></i> {!echo $product->views}</div>
          {/if}
        </div>

        {if(isset($content->showInfo) and isset($content->infoAmount))}
          {$productInfo = empty($product->desc) ? $product->content : $product->desc}
          {$productInfo = strip_tags($productInfo)}
          {$productInfo = helper::substr($productInfo, $content->infoAmount)}
          <div class='card-content text-muted with-padding'>{!echo $productInfo}</div>
        {/if}
      </a>
    </div>
    {/if}
    {/foreach}
  </div>
</div>
