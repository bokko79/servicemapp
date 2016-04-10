<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsSpecs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-specs-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'object_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_id')->textInput() ?>

    <?= $form->field($model, 'property_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'default_value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'range_min')->textInput() ?>

    <?= $form->field($model, 'range_max')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'range_step')->textInput() ?>

    <?= $form->field($model, 'required')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
