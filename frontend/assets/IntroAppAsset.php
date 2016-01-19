<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class IntroAppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style_uac.css',
        'css/style_form.css',
        'css/temp/style.css',
        'css/temp/media-queries.css',
        'css/temp/form-elements.css',
        'css/animate.css',
    ];
    public $js = [
        'js/intro/jquery.backstretch.min.js',
        'js/intro/retina-1.1.0.min.js',
        'js/intro/scripts.js',
        'js/intro/wow.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
