<?php if(commonModel::isAvailable('stat')):?>
<script>
var browserLanguage = navigator.language || navigator.userLanguage; 
var resolution      = screen.availWidth + ' X ' + screen.availHeight;
$.get(createLink('log', 'record'), {browserLanguage:browserLanguage, resolution:resolution});
</script>
<?php endif;?>
