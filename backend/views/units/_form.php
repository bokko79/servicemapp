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

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_trans, 'name')->input(['value' => $model->name]) ?>

    <?= $form->field($model_trans, 'name_gen')->input(['value' => $model->name]) ?>

    <?= $form->field($model_trans, 'oznaka')->input(['value' => $model->name]) ?>    

    <?= $form->field($model, 'oznaka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ozn_htmlfree')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_trans, 'ozn_htmlfree')->input(['value' => $model->name]) ?>

    <?= $form->field($model, 'conversion_unit')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\CsUnits::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'conversion_value')->input('number', ['step' => 0.000000000001]) ?>    

    <?= $form->field($model, 'measurement')->dropDownList(['metric' => 'metric', 'imperial' => 'imperial'], ['class'=>'']) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>
