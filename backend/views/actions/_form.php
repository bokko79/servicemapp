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

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model_trans, 'name')->input(['value' => $model->name]) ?>

    <?= $form->field($model_trans, 'name_gen')->input(['value' => $model->name]) ?>

    <?= $form->field($model_trans, 'name_dat')->input(['value' => $model->name]) ?>

    <?= $form->field($model_trans, 'name_akk')->input(['value' => $model->name]) ?>

    <?= $form->field($model_trans, 'name_inst')->input(['value' => $model->name]) ?>    

    <?= $form->field($model_trans, 'name_gender')->dropDownList(['m' => 'muški', 'f' => 'ženski', 'n' => 'srednji'], ['style'=>'width:50%']) ?>
<hr>
    <?= $form->field($model, 'status')->dropDownList([ 'approved' => 'Approved', 'submitted' => 'Submitted', 'rejected' => 'Rejected', 'to_finish' => 'To finish', ], ['prompt' => '']) ?>

    <?= $form->field($model_trans, 'description')->textArea() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>