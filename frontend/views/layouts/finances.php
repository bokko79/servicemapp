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
<div class="subnav-fixed">
    <?= $this->render('partial/subnav/user_profile.php') ?>
</div>

<div class="grid-container" style="margin-top:70px;">   

    <div class="grid-row">
        <div class="grid-leftacross">
            <div class="grid-row">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class' => 'breadcrumb inverted bg-green-900'],
                ]) ?>
            </div>
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData'=>[
                        'background' => 'bg-green-900',
                        'icon' => 'line-chart',
                        'title' => 'Finansije'.Html::a('<i class="fa fa-arrow-circle-left"></i>&nbsp;'.Yii::t('app', 'Nazad na profil'), Url::to('/'.Yii::$app->user->username.'/home'), ['class' => 'btn btn-default btn-sm float-right']),
                        'description' => null,                        
                    ],
                    'invert' => true,
                ]); ?>
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData'=>$this->pageTitle,
                ]); ?> 
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar margin-top-0">
            <?= $this->render('partial/finances-menu.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>