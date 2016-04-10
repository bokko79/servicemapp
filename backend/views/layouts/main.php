<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
?>

<?php $this->beginContent('@app/views/layouts/html/html_simple.php'); ?>

<?php /* PROFILE HEADING */ ?>
<div class="grid-container" style="">
    <div class="grid-row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>

    <div class="grid-row">
        <div class="grid-full" style="">        
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>