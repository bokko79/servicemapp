<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjectProperties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-object-properties-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'object_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_id')->textInput() ?>

    <?= $form->field($model, 'property_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_unit_id')->textInput() ?>

    <?= $form->field($model, 'property_unit_imperial_id')->textInput() ?>

    <?= $form->field($model, 'property_class')->dropDownList([ 'public' => 'Public', 'private' => 'Private', 'protected' => 'Protected', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'property_type')->dropDownList([ 'general' => 'General', 'product' => 'Product', 'model' => 'Model', 'part' => 'Part', 'empty' => 'Empty', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'input_type')->textInput() ?>

    <?= $form->field($model, 'value_default')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'value_min')->textInput() ?>

    <?= $form->field($model, 'value_max')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'step')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pattern')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'display_order')->textInput() ?>

    <?= $form->field($model, 'multiple_values')->textInput() ?>

    <?= $form->field($model, 'specific_values')->textInput() ?>

    <?= $form->field($model, 'read_only')->textInput() ?>

    <?= $form->field($model, 'required')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
