<?php
/**
 * Created by PhpStorm.
 * User: Android0660
 * Date: 14/03/2017
 * Time: 22:40
 */

namespace app\assets;


use yii\web\AssetBundle;

class SisgcAsset extends AssetBundle
{

    public $basePath = '@webroot/sisgc';
    public $baseUrl = '@web/sisgc';
    public $css = [
        'css/styles.css',
        'css/font-awesome.min.css'
    ];
    public $js = [
        'js/lumino.glyphs.js',
        'js/html5shiv.min.js',
        'js/respond.min.js',
        'js/jquery.mask.min.js'
        //'js/jquery-1.11.1.min.js',
        //'css/bootstrap.min.css'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}