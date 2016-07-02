<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class MaterialAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/animate.css',
        'css/materialize/materialize.css',
        'css/materialize/style.min.css',
        'css/materialize/prism.css',
        'css/materialize/perfect-scrollbar.css',
        'css/materialize/chartist.min.css',
        'css/materialize/fullcalendar.min.css',
    ];
    public $js = [
        'js/materialize/materialize.js',        
        'js/materialize/perfect-scrollbar.min.js',
        'js/materialize/chartist.min.js',
        'js/materialize/chart.min.js',
        'js/materialize/chart-script.js',
        'js/materialize/jquery.sparkline.min.js',
        'js/materialize/sparkline-script.js',
        'js/materialize/jquery-jvectormap-1.2.2.min.js',
        'js/materialize/plugins.min.js',
        'js/materialize/prism.js',
        'js/materialize/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
