<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="float-left" style="padding-left: 60px;">
    <?php $form = ActiveForm::begin([
        //'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline',
        ],         
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fa fa-search"></i>', ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
