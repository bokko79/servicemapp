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

    <?= $form->field($model, 'industry_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\CsIndustries::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'property_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\CsProperties::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'value_default')->input('text') ?>

    <?= $form->field($model, 'value_min')->input('number') ?>

    <?= $form->field($model, 'value_max')->input('number') ?>

    <?= $form->field($model, 'step')->input('number', ['step'=>0.01]) ?>

    <?= $form->field($model, 'pattern')->input('text') ?>

    <?= $form->field($model, 'display_order')->input('number') ?>

    <?= $form->field($model, 'multiple_values')->checkbox()->label() ?>

    <?= $form->field($model, 'read_only')->checkbox()->label() ?>

    <?= $form->field($model, 'required')->checkbox()->label() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
