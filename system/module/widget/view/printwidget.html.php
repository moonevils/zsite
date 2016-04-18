<?php $type = strtolower($widget->type);?>
<?php if(file_exists("{$type}.html.php")) include "$type.html.php";?>
