<nav id='siteNav'>
<?php
if($this->device == 'desktop' and commonModel::isAvailable('shop'))
{
    $cartInfo = $this->loadModel('cart')->getCount();
    if($cartInfo) echo "<span class='text-center text-middle' id='cartBox'>{$cartInfo}</span>";
}
commonModel::printTopBar();
commonModel::printLanguageBar();
?>
</nav> 
