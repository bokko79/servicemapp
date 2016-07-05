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
class MaterialAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/style.css',
        'css/style_box.css',
        'css/style_form.css',
        'css/style_home.css',
        'css/style_index.css',
        'css/style_profile.css',
        'css/style_view.css',
        'css/style_uac.css',
        'css/animate.css',
        'css/materialize/materialize.css',
    ];
    public $js = [
        'js/masonry.pkgd.min.js',
        'js/app.js',
        'js/service_index.js',
        'js/cards.js',
        'js/easy-ticker.min.js',
        'js/materialize/materialize.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
    ];
}
