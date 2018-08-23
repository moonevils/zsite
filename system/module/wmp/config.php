<?php
if(!isset($config->wmp)) $config->wmp = new stdclass();
$config->wmp->projectConfigContent = <<<EOT
{
    "description": "%s",
    "packOptions":
    {
        "ignore": []
    },
    "setting":
    {
        "urlCheck": false,
        "es6": true,
        "postcss": true,
        "minified": true,
        "newFeature": true
    },
    "compileType": "miniprogram",
    "libVersion": "2.0.4",
    "appid": "%s",
    "projectname": "%s",
    "isGameTourist": false,
}
EOT;
