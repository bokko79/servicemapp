<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsMethodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-methods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'action_id') ?>

    <?= $form->field($model, 'property_id') ?>

    <?php // echo $form->field($model, 'default_value') ?>

    <?php // echo $form->field($model, 'range_min') ?>

    <?php // echo $form->field($model, 'range_max') ?>

    <?php // echo $form->field($model, 'range_step') ?>

    <?php // echo $form->field($model, 'display_order') ?>

    <?php // echo $form->field($model, 'required') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
