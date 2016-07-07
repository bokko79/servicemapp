<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
?>


<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?= $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_property_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_unit_id')->textInput() ?>

    <?= $form->field($model, 'property_unit_imperial_id')->textInput() ?>

    <?= $form->field($model, 'property_class')->dropDownList([ 'private' => 'Private', 'protected' => 'Protected', 'public' => 'Public', ], ['prompt' => '']) ?>

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

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>