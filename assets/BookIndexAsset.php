<?php

namespace app\assets;

use yii\web\AssetBundle;

class BookIndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/book-index.js',
    ];

    public $css = [
        'css/book-index.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
