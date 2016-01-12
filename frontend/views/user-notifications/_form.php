<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\checkbox\CheckboxX;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserObjects */
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

                <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'new_req')->checkbox(['labelOptions'=>[]]) ?>

                <?= $form->field($model, 'upd_req')->widget(CheckboxX::classname(), ['pluginOptions'=>['size'=>'sm']]) ?>

                <?= $form->field($model, 'del_req')->checkbox() ?>

                <?= $form->field($model, 'exp_req')->checkbox() ?>

                <?= $form->field($model, 'succ_req')->checkbox() ?>

                <?= $form->field($model, 'new_bid')->checkbox() ?>

                <?= $form->field($model, 'upd_bid')->checkbox() ?>

                <?= $form->field($model, 'del_bid')->checkbox() ?>

                <?= $form->field($model, 'rej_bid')->checkbox() ?>

                <?= $form->field($model, 'rep_bid')->checkbox() ?>

                <?= $form->field($model, 'awa_bid')->checkbox() ?>

                <?= $form->field($model, 'exp_bid')->checkbox() ?>

                <?= $form->field($model, 'new_rev')->checkbox() ?>

                <?= $form->field($model, 'new_rate')->checkbox() ?>

                <?= $form->field($model, 'new_comm')->checkbox() ?>

                <?= $form->field($model, 'new_rcmnd')->checkbox() ?>

                <?= $form->field($model, 'new_deal')->checkbox() ?>

                <?= $form->field($model, 'subs_deal')->checkbox() ?>

                <?= $form->field($model, 'upd_deal')->checkbox() ?>

                <?= $form->field($model, 'exp_deal')->checkbox() ?>

                <?= $form->field($model, 'del_deal')->checkbox() ?>

                <?= $form->field($model, 'upd_memb')->checkbox() ?>

                <?= $form->field($model, 'exp_memb')->checkbox() ?>

                <?= $form->field($model, 'jubilee')->checkbox() ?>

                <?= $form->field($model, 'update_time')->checkbox() ?>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>                
            </div>            
        </fieldset>
    <?php ActiveForm::end(); ?>


