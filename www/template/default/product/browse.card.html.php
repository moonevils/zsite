<section id="cardMode" class='cards cards-products cards-borderless hide'>
  <?php foreach($products as $product):?>
  <div class='col-sm-4 col-xs-6'>
    <div class='card' data-ve='product' id='product<?php echo $product->id?>'>
      <?php
      if(empty($product->image))
      {
          echo html::a(inlink('view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"), '<div class="media-placeholder" data-id="' . $product->id . '">' . $product->name . '</div>', "class='media-wrapper'");
      }
      else
      {
          $title = $product->image->primary->title ? $product->image->primary->title : $product->name;
          echo html::a(inlink('view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"), html::image($product->image->primary->middleURL, "title='{$title}' alt='{$product->name}'"), "class='media-wrapper'");
      }
      ?>
      <div class='card-heading'>
        <?php $showPrice    = isset($this->config->product->showPrice) ? $this->config->product->showPrice : true;?>
        <?php $showViews    = isset($this->config->product->showViews) ? $this->config->product->showViews : true;?>
        <?php $namePosition = isset($this->config->product->namePosition) ? 'text-' . $this->config->product->namePosition : '';?>
        <?php if($showPrice):?>
        <div class='price'>
          <?php
          $currencySymbol = $this->config->product->currencySymbol;
          if(!$product->unsaleable)
          {
              if($product->negotiate)
              {
                  echo "<span class='text-danger'>" . $lang->product->negotiate . '</span>';
              }
              else
              {
                  if($product->promotion != 0)
                  {
                      echo "<strong class='text-danger' style='margin:-3px;'>" . $currencySymbol . $product->promotion . '</strong>';
                  }
                  else
                  {
                      if($product->price != 0)
                      {
                          echo "<strong class='text-danger' style='margin:-3px;'>" . $currencySymbol . $product->price . '</strong>';
                      }
                  }
              }
          }
          ?>
        </div>
        <?php endif;?>
        <div class='text-nowrap text-ellipsis <?php echo $namePosition;?>'>
          <span><?php echo html::a(inlink('view', "id={$product->id}", "category={$product->category->alias}&name=$product->alias"), $product->name, "style='color:{$product->titleColor}'");?></span>
          <?php if($showViews):?><span data-toggle='tooltip' class='text-muted views-count' title='<?php echo $lang->product->viewsCount;?>'><i class="icon icon-eye-open"></i> <?php echo $config->viewsPlaceholder . $product->id . $config->viewsPlaceholder;?></span><?php endif;?>
        </div>
      </div>
    </div>
  </div>
  <?php endforeach;?>
</section>
