<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use PetraBarus\Yii2\GooglePlacesAutoComplete\GooglePlacesAutoComplete;

/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 7,      
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>
    <fieldset class="settings new_object_atts" style="margin-bottom:10px !important;">
        <div class="wrapper addition" style="">
            <label class="head">
                <i class="fa fa-map-marker"></i>&nbsp;
                <?php echo Yii::t('app', 'Location'); ?>
            </label>
            <i class="fa fa-chevron-right chevron"></i>
        </div>

        <div class="wrapper location" style="border-top:none;">
            <?= $form->field($model, 'loc_id')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'loc_id2')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'loc_within')->textInput() ?>
        </div>

        <div class="wrapper addition" style="">
            <label class="head">
                <i class="fa fa-map-marker"></i>&nbsp;
                <?php echo Yii::t('app', 'Time'); ?>
            </label>
            <i class="fa fa-chevron-right chevron"></i>
        </div>

        <div class="wrapper location" style="border-top:none;">
            <?= $form->field($model, 'delivery_starts')->textInput() ?>

            <?= $form->field($model, 'delivery_ends')->textInput() ?>
        </div>

        <div class="wrapper addition" style="">
            <label class="head">
                <i class="fa fa-map-marker"></i>&nbsp;
                <?php echo Yii::t('app', 'Validity'); ?>
            </label>
            <i class="fa fa-chevron-right chevron"></i>
        </div>

        <div class="wrapper location" style="border-top:none;">
            <?= $form->field($model, 'validity')->textInput() ?>
        </div>

        <div class="wrapper addition" style="">
            <label class="head">
                <i class="fa fa-map-marker"></i>&nbsp;
                <?php echo Yii::t('app', 'Other'); ?>
            </label>
            <i class="fa fa-chevron-right chevron"></i>
        </div>

        <div class="wrapper location" style="border-top:none;">
             <?= $form->field($model, 'phone_contact')->textInput() ?>

            <?= $form->field($model, 'turn_key')->textInput() ?>

            <?= $form->field($model, 'order_type')->dropDownList([ 'single' => 'Single', 'multi' => 'Multi', 'operation' => 'Operation', 'process' => 'Process', ], ['prompt' => '']) ?>

        </div>

        <div class="col-sm-offset-3 col-sm-9">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </fieldset>

    <?php ActiveForm::end(); ?>

