<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/bootstrap3/css/bootstrap.min.css',
        'css/bootstrap3/css/bootstrap-theme.min.css',
        'css/bootstrap-select.min.css',
        'css/bootstrap-treeview.min.css',
        'css/site.css',
        'css/saoplus.css',
        'css/app90phut.css',
        'css/croppie.css',
        'css/bootstrap-datetimepicker.min.css',
        'css/treeview.css',
        'css/font-awesome/css/font-awesome.min.css'
    ];
    public $js = [
        'css/bootstrap3/js/bootstrap.min.js',
        'js/bootstrap-treeview.min.js',
        'js/jquery-1.12.4.min.js',
        'js/treeview.js',
        'js/croppie.min.js',
        'js/crop.js',
        'js/mask-input.js',
        'js/moment-with-locales.js',
        'js/bootstrap-datetimepicker.min.js',
        'js/main.js',
        'js/90phut.js',
        'js/saoplus.js',
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset'
        'yii\web\JqueryAsset',
    ];

}
