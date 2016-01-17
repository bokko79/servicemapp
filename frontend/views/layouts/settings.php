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
            <div class="grid-row" style="margin-top:-20px;">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>                
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData'=>$this->pageTitle,
                ]); ?> 
             <?php /* WIDGET: TABS */ ?>
                <?= Tabs::widget([
                    'tabs'=>$this->tabs,
                ]); ?>
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Progress Meter ?>
            <?php // Help ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>