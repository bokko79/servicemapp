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
                    'options' => ['class' => 'breadcrumb inverted bg-blue-gray-900'],
                ]) ?>
            </div>
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData'=>[
                        'background' => 'bg-blue-gray-900',
                        'icon' => 'cog',
                        'title' => 'Podešavanja'.Html::a('<i class="fa fa-arrow-circle-left"></i>&nbsp;'.Yii::t('app', 'Nazad na profil'), Url::to('/'.Yii::$app->user->username.'/home'), ['class' => 'btn btn-default btn-sm float-right']),
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
                
        <div class="grid-right media_right_sidebar">
            <?= $this->render('partial/settings-menu.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>