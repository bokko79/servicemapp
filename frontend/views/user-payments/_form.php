<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserObjects */
/* @var $form yii\widgets\ActiveForm */
?>
    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 12,      
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>
        <fieldset class="settings new_object_atts" style="margin-bottom:10px !important;">
            <div class="wrapper addition" style="">

                <label class="head">
                    <i class="fa fa-map-marker"></i>&nbsp;
                    <?php echo Yii::t('app', 'aaa'); ?>
                </label>
                <i class="fa fa-chevron-right chevron"></i>
            </div>

            <div class="wrapper location" style="border-top:none;margin-bottom:10px !important;">

                <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'payment_type')->radioButtonGroup([ 'MasterCard' => 'MasterCard', 'Visa' => 'Visa', 'AmericanExpress' => 'AmericanExpress', 'PayPal' => 'PayPal', ], ['fullSpan' => 12, 'class' => 'btn-group-xs',
    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-success']]]) ?>

                <?= $form->field($model, 'details')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'card_no')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'exp_mnth')->dropDownList([ 1 => '1', 2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7', 8 => '8', 9 => '9', 10 => '10', 11 => '11', 12 => '12', ], ['prompt' => '']) ?>

                <?= $form->field($model, 'exp_year')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'scc')->textInput(['maxlength' => true, 'options'=>['class'=>'col-sm-9']]) ?>

                <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'street')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'country')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'inactive' => 'Inactive', 'banned' => 'Banned', ], ['prompt' => '']) ?>

                <?= $form->field($model, 'time')->textInput() ?>

                <?= $form->field($model, 'opis')->textInput() ?>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>                
            </div>            
        </fieldset>
    <?php ActiveForm::end(); ?>


