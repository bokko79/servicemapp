<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use PetraBarus\Yii2\GooglePlacesAutoComplete\GooglePlacesAutoComplete;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserObjects */
/* @var $form yii\widgets\ActiveForm */
?>
    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 7,      
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>
        <fieldset class="settings new_object_atts" style="margin-bottom:10px !important;">
            <div class="wrapper headline" style="">

                <label class="head">
                    <i class="fa fa-map-marker"></i>&nbsp;
                    <?php echo Yii::t('app', 'Requests Notifications'); ?>
                </label>
                <i class="fa fa-chevron-right chevron"></i>
            </div>

            <div class="wrapper" style="border-top:none;margin-bottom:10px !important;">

                <?= $form->field($model, 'object_id', [
                    'feedbackIcon' => [
                        'default' => 'envelope',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->textInput() ?>


                <?= $form->field($model, 'object_type_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(\frontend\models\CsObjectTypes::find()->all(), 'id', 'name'),
                                'options' => ['placeholder' => 'Select object type ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>

                <?= $form->field($model, 'ime')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'loc_id')->widget(GooglePlacesAutoComplete::className(), ['autocompleteOptions'=>[]]) ?>

                <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'is_set')->textInput() ?>

                <?= $form->field($model, 'update_time', [
                    'feedbackIcon' => [
                        'default' => 'calendar',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->widget(DatePicker::classname(), [
                    'name' => 'operation_time', 
                    'language' => 'sr',
                    'value' => date('d-M-Y H:i A', strtotime('+2 days')),
                    'options' => ['placeholder' => 'Select operating time ...'],
                ]) ?>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>                
            </div>            
        </fieldset>
    <?php ActiveForm::end(); ?>

