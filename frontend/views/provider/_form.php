<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Provider */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'industry_id')->textInput() ?>

    <?= $form->field($model, 'legal_form')->dropDownList([ 'fizičko' => 'Fizičko', 'pravno' => 'Pravno', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'phone2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'VAT_ID')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bank_acc_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'work_time_start')->textInput() ?>

    <?= $form->field($model, 'work_time_end')->textInput() ?>

    <?= $form->field($model, 'registration_time')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_active')->textInput() ?>

    <?= $form->field($model, 'del_upd_time')->textInput() ?>

    <?= $form->field($model, 'service_upd_time')->textInput() ?>

    <?= $form->field($model, 'score')->textInput() ?>

    <?= $form->field($model, 'rate')->textInput() ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <?= $form->field($model, 'licence_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'licence_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'licence_upd_time')->textInput() ?>

    <?= $form->field($model, 'hit_counter')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
