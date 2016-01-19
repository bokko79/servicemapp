<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\widgets\Tabs;
use frontend\widgets\PageTitle;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">   

    <div class="grid-row">
        <div class="grid-leftacross">
            <div class="grid-row">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>             
            <?php /* WIDGET: TABS */ ?>
                <?= Tabs::widget([
                    'tabs'=>[
                        ['url'=>Url::to('/index'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Index'), 'active'=>'provider/services'],
                        ['url'=>Url::to('/contact-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Contact'), 'active'=>''],
                        ['url'=>Url::to('/about-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'About'), 'active'=>''],
                        ['url'=>Url::to('/users'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Users'), 'active'=>''],
                    ],
                ]); ?>
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData'=>$this->pageTitle,
                ]); ?> 
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?= $this->render('partial/progress-meter.php') ?>
            <?= $this->render('partial/help.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>