<style>
.panel-body .cards-custom .card > .card-heading {min-height: 20px; height: 20px; padding: 10px; font-size: 13px;}
.panel-body .cards-custom .card > .card-content {padding: 0 10px 10px 10px; margin-bottom: 10px;}
</style>

<div class='panel-body'>
  <div class='cards cards-borderless cards-custom'>
    <?php foreach($products as $product):?>
    <?php $url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias");?>

    <?php if(!empty($product->image)): ?>
    <?php $recPerRow = (isset($content->recPerRow) and !empty($content->recPerRow)) ? $content->recPerRow : '3';?>
    <div class='col-md-12' data-recperrow="<?php echo $recPerRow;?>">
      <a class='card' href="<?php echo $url;?>">
        <div class='media' style='background-image: url(<?php echo $this->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, 'product', 'middleURL');?>);'>
          <?php $title = $product->image->primary->title ? $product->image->primary->title : $product->name;?>
          <?php echo html::image($this->loadModel('file')->printFileURL($product->image->primary->pathname, $product->image->primary->extension, 'product', 'middleURL'), "title='{$title}' alt='{$product->name}'"); ?>
        </div>

        <div class="card-heading <?php if(isset($content->alignTitle) && $content->alignTitle == 'middle') echo 'text-center';?>">
          <strong>
            <?php 
            if(zget($content, 'showCategory') == 1) echo '[' . ($content->categoryName == 'abbr' and $product->category->abbr) ? $product->category->abbr : $product->category->name . ']';
            echo $product->name;
            ?>
          </strong>

          <?php if(isset($content->showPrice) and $content->showPrice):?>
          <span>
            <?php
            $currencySymbol = $this->config->product->currencySymbol;
            if(!$product->unsaleable)
            {
                if($product->negotiate)
                {
                    $priceLabel = $this->lang->product->negotiate;
                }
                else
                {
                    if($product->promotion) $priceLabel = $currencySymbol . $product->promotion;
                    if(!$product->promotion and $product->price) $priceLabel = $currencySymbol . $product->price;
                }
            }
            if(isset($priceLabel)) echo "&nbsp;&nbsp;<span class='text-danger'>" . $priceLabel . '</span>';
            ?>
          </span>
          <?php endif;?>

          <?php if(isset($content->showViews) and $content->showViews):?>
          <div class='pull-right'><i class="icon icon-eye-open"></i> <?php echo $product->views;?></div>
          <?php endif;?>
        </div>

        <?php if(isset($content->showInfo) and isset($content->infoAmount)):?>
        <?php 
        $productInfo = empty($product->desc) ? $product->content : $product->desc; 
        $productInfo = strip_tags($productInfo);
        $productInfo = helper::substr($productInfo, $content->infoAmount);
        ?>
        <div class='card-content text-muted with-padding'><?php echo $productInfo;?></div>
        <?php endif;?>
      </a>
    </div>
    <?php endif;?>
    <?php endforeach;?>
  </div>
</div>
