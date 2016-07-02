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

    <?= $form->field($model, 'object_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\CsObjects::find()->all(), 'id', 'name'),
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

        <?= $form->field($model, 'property_unit_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\CsUnits::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

        <?= $form->field($model, 'property_unit_imperial_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\CsUnits::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'property_class')->dropDownList([ 'public' => 'Public', 'private' => 'Private', 'protected' => 'Protected', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'property_type')->dropDownList([ 'general' => 'General', 'product' => 'Product', 'model' => 'Model', 'part' => 'Part', 'empty' => 'Empty', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'input_type')->dropDownList([ 
                '1' => 'number',
                '2' => 'radio',
                '21' => 'radioButton',
                '22' => 'radio',
                '23' => 'radioButton',
                '3' => 'select',
                '31' => 'select2',
                '32' => 'select_media',
                '4' => 'multiselect',
                '41' => 'checkboxButton',
                '42' => 'multiselect_select',
                '43' => 'multiselect_select2',
                '44' => 'multiselect_media',
                '5' => 'checkbox',
                '6' => 'text',
                '7' => 'textarea',
                '8' => 'slider',
                '9' => 'range',
                '10' => 'date',
                '11' => 'time',
                '12' => 'datetime',
                '13' => 'email',
                '14' => 'url',
                '15' => 'color',
                '16' => 'date range',

            ], ['prompt' => '']) ?>

    <?= $form->field($model, 'value_default')->input('text') ?>

    <?= $form->field($model, 'value_min')->input('number') ?>

    <?= $form->field($model, 'value_max')->input('number') ?>

    <?= $form->field($model, 'step')->input('number', ['step'=>0.01]) ?>

    <?= $form->field($model, 'pattern')->input('text') ?>

    <?= $form->field($model, 'display_order')->input('number') ?>

    <?= $form->field($model, 'multiple_values')->checkbox()->label() ?>

    <?= $form->field($model, 'specific_values')->checkbox()->label() ?>

    <?= $form->field($model, 'read_only')->checkbox()->label() ?>

    <?= $form->field($model, 'required')->checkbox()->label() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

<?php ActiveForm::end(); ?>
