  <div class='panel-body'>
    <ul class='ul-list'>
      <?php 
      foreach($products as $product):
      $url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias");
      ?>
      <li>
        <span class='text-latin pull-right'>
        <?php if(isset($content->showPrice) and $content->showPrice):?>
        <span>
        <?php
        if(!$product->unsaleable)
        {
            if($product->promotion != 0)
            {
                if($product->price != 0)
                {
                    echo "<small class='text-muted'>" . $this->config->product->currencySymbol . "</small> ";
                    echo "<del><small class='text-muted'>" . $product->price . "</small></del>";
                }
                echo "&nbsp; <small class='text-muted'>" . $this->config->product->currencySymbol . "</small> ";
                echo "<strong class='text-danger'>" . $product->promotion . "</strong>";
            }
            else if($product->price != 0)
            {
                echo "&nbsp; <small class='text-muted'>" . $this->config->product->currencySymbol . "</small> ";
                echo "<strong class='text-important'>" . $product->price . "</strong>";
            }
        }
        ?>
        <?php endif;?>
        </span>
        <?php if(isset($content->showViews) and $content->showViews):?>
        <span>
          <i class="icon icon-eye-open"></i> <?php echo $product->views;?>
        </span>
        <?php endif;?>
        </span>
        <?php if(isset($content->showCategory) and $content->showCategory == 1):?>
          <?php if($content->categoryName == 'abbr'):?>
          <?php $categoryName = '[' . ($product->category->abbr ? $product->category->abbr : $product->category->name) . '] ';?>
          <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), $categoryName);?>
          <?php else:?>
          <?php echo html::a(helper::createLink('product', 'browse', "categoryID={$product->category->id}", "category={$product->category->alias}"), '[' . $product->category->name . '] ');?>
          <?php endif;?>
        <?php endif;?>
        <?php echo html::a($url, $product->name);?>
      </li>
      <?php if(isset($content->showInfo) and isset($content->infoAmount)):?>
      <?php 
        $productInfo = empty($product->desc) ? $product->content : $product->desc; 
        $productInfo = strip_tags($productInfo);
        $productInfo = (mb_strlen($productInfo) > $content->infoAmount) ? mb_substr($productInfo, 0 , $content->infoAmount, 'utf8') : $productInfo;
      ?>
      <div style='padding-left:30px;'><?php echo $productInfo;?></div>
      <?php endif;?>
      <?php endforeach;?>
    </ul>
  </div>
