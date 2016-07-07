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

    <?= $form->field($model, 'entity')->dropDownList([ 'service' => 'Service', 'industry' => 'Industry', 'object' => 'Object', 'category' => 'Category', 'action' => 'Action', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'entity_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lang_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orig_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>