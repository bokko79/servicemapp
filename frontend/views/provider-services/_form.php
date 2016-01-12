<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use PetraBarus\Yii2\GooglePlacesAutoComplete\GooglePlacesAutoComplete;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderServices */
/* @var $form yii\widgets\ActiveForm */
?>


     <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'login-form-horizontal',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 7,      
        'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_SMALL]
    ]); ?>

    <fieldset class="settings new_object_atts" style="margin-bottom:10px !important;">
            <div class="wrapper addition" style="">

                <label class="head">
                    <i class="fa fa-map-marker"></i>&nbsp;
                    <?php echo Yii::t('app', 'Requests Notifications'); ?>
                </label>
                <i class="fa fa-chevron-right chevron"></i>
            </div>

            <div class="wrapper location" style="border-top:none;margin-bottom:10px !important;">

                <?= $form->field($model, 'presentation_id')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'provider_id')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'service_id')->textInput() ?>

                <?= $form->field($model, 'industry_id')->textInput() ?>

                <?= $form->field($model, 'loc_id')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'period')->textInput() ?>

                <?= $form->field($model, 'period_unit')->textInput() ?>

                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'price_max')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'currency_id')->textInput() ?>

                <?= $form->field($model, 'fixed_price')->textInput() ?>

                <?= $form->field($model, 'warranty')->textInput() ?>

                <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'on_sale')->textInput() ?>

                <?= $form->field($model, 'is_set')->textInput() ?>

                <?= $form->field($model, 'update_time')->textInput() ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </fieldset>

    <?php ActiveForm::end(); ?>

