<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\CsProperties */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-properties-form">

    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'login-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 7,      
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_akk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(\common\models\CsProperties::find()->all(), 'id', 'name'),
                                'options' => ['placeholder' => 'Izaberi svojstvo ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>

    <?= $form->field($model, 'hint')->textArea(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 
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

    <?= $form->field($model, 'multiple_values')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>

    <?= $form->field($model, 'translatable_values')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>

    <?= $form->field($model, 'class')->dropDownList([ 
                'types' => 'types',
                'product' => 'product',
                'time' => 'time',
                'parts' => 'parts',
                'models' => 'models',
                'number' => 'number',
                'string' => 'string',
                'other' => 'drugo',

            ], ['prompt' => '']) ?>

    <?= $form->field($model, 'description')->dropDownList([ 
                'specs' => 'svojstvo predmeta',
                'methods' => 'svojstvo akcije',
                'skills' => 'svojstvo delatnosti',

            ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
