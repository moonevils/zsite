  <div class='panel-body'>
    <div class='cards cards-borderless cards-custom'>
      <?php foreach($products as $product):?>
      <?php 
      $url = helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias");
      ?>
      <?php if(!empty($product->image)): ?>
      <?php $recPerRow = (isset($content->recPerRow) and !empty($content->recPerRow)) ? $content->recPerRow : '3';?>
      <div class='col-md-12' style="width:<?php echo 100 / $recPerRow;?>%" data-recperrow="<?php echo $recPerRow;?>">
        <a class='card' href="<?php echo $url;?>">
          <?php $title = $product->image->primary->title ? $product->image->primary->title : $product->name;?>
          <div class='media' style='background-image: url(<?php echo helper::createLink('file', 'read', "fileID={$product->image->primary->id}&type=middleURL", '', "{$product->image->primary->extension}");?>);'><?php echo html::image(helper::createLink('file', 'read', "fileID={$product->image->primary->id}&type=middleURL", '', "{$product->image->primary->extension}"), "title='{$title}' alt='{$product->name}'"); ?></div>
          <div class='card-heading' style='min-height:20px;'>
            <?php if(isset($content->alignTitle) and $content->alignTitle == 'middle'):?>
            <?php $showPriceOrViews = (isset($content->showPrice) and $content->showPrice) or (isset($content->showViews) and $content->showViews);?>
            <ul style="list-style:none;overflow:hidden;margin:0 auto;padding:0;">
                <li style='float:left;width:100%;list-style:none;text-align:center;'>
                <span style='<?php if($showPriceOrViews) echo 'width:50%;'?>height:15px;display:inline-block;overflow:hidden;'>
                <?php 
                  if(isset($content->showCategory) and $content->showCategory == 1)
                  {
                    $categoryName = ($content->categoryName == 'abbr') ? '[' . ($product->category->abbr ? $product->category->abbr : $product->category->name) . '] ' : ' [' . $product->category->name . '] ';
                    echo $categoryName;
                  }
                  echo $product->name;
                ?>
                </span>
                <span style='display:inline-block;'>
                <?php if(isset($content->showPrice) and $content->showPrice):?>
                <?php
                $currencySymbol = $this->config->product->currencySymbol;
                if(!$product->unsaleable)
                {
                    if($product->negotiate)
                    { 
                        echo "&nbsp;&nbsp;";
                        echo "<strong class='text-danger'>" . $this->lang->product->negotiate . '</strong>';
                    }
                    else
                    {
                        if($product->promotion != 0)
                        {
                            echo "&nbsp;&nbsp;";
                            echo "<strong class='text-danger'>" . $currencySymbol . $product->promotion . '</strong>';
                        }
                        else
                        {
                            if($product->price != 0)
                            {
                                echo "<strong class='text-danger'>" . $currencySymbol . $product->price . '</strong>';
                            }
                        }
                    }
                }
                ?>
                <?php endif;?>
                <?php if(isset($content->showViews) and $content->showViews):?>
                <i class="icon icon-eye-open"></i> <?php echo $product->views;?>
                <?php endif;?>
                </span>
                </li>
            </ul> 
            <?php else:?>
            <span style='width:60%;float:left; overflow: hidden;text-overflow: ellipsis;white-space: nowrap;'>
            <?php 
              if(isset($content->showCategory) and $content->showCategory == 1)
              {
                $categoryName = ($content->categoryName == 'abbr') ? '[' . ($product->category->abbr ? $product->category->abbr : $product->category->name) . '] ' : ' [' . $product->category->name . '] ';
                echo $categoryName;
              }
              echo $product->name;
            ?>
            </span>
            <?php if(isset($content->showViews) and $content->showViews):?>
            <span style='float:right;margin-left:5px;'>
               <i class="icon icon-eye-open"></i> <?php echo $product->views;?>
            </span>
            <?php endif;?>
            <?php if(isset($content->showPrice) and $content->showPrice):?>
            <span class='text-latin' style='float:right'>
            <?php
            $currencySymbol = $this->config->product->currencySymbol;
            if(!$product->unsaleable)
            {
                if($product->negotiate)
                { 
                    echo "&nbsp;&nbsp;";
                    echo "<strong class='text-danger'>" . $this->lang->product->negotiate . '</strong>';
                }
                else
                {
                    if($product->promotion != 0)
                    {
                        echo "&nbsp;&nbsp;";
                        echo "<strong class='text-danger'>" . $currencySymbol . $product->promotion . '</strong>';
                    }
                    else
                    {
                        if($product->price != 0)
                        {
                            echo "<strong class='text-danger'>" . $currencySymbol . $product->price . '</strong>';
                        }
                    }
                }
            }
            ?>
            </span>
            <?php endif;?>
            <?php endif;?>
          </div>
        </a>
         <?php if(isset($content->showInfo) and isset($content->infoAmount)):?>
         <?php 
           $productInfo = empty($product->desc) ? $product->content : $product->desc; 
           $productInfo = strip_tags($productInfo);
           $productInfo = (mb_strlen($productInfo) > $content->infoAmount) ? mb_substr($productInfo, 0 , $content->infoAmount, 'utf8') : $productInfo;
         ?>
         <div style='padding-left:10px;'><?php echo $productInfo;?></div>
         <?php endif;?>
      </div>
      <?php endif;?>
      <?php endforeach;?>
    </div>
  </div>
