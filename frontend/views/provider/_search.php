<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'industry_id') ?>

    <?= $form->field($model, 'legal_form') ?>

    <?= $form->field($model, 'phone2') ?>

    <?php // echo $form->field($model, 'phone3') ?>

    <?php // echo $form->field($model, 'website') ?>

    <?php // echo $form->field($model, 'VAT_ID') ?>

    <?php // echo $form->field($model, 'company_no') ?>

    <?php // echo $form->field($model, 'bank_acc_no') ?>

    <?php // echo $form->field($model, 'work_time_start') ?>

    <?php // echo $form->field($model, 'work_time_end') ?>

    <?php // echo $form->field($model, 'registration_time') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'is_active') ?>

    <?php // echo $form->field($model, 'del_upd_time') ?>

    <?php // echo $form->field($model, 'service_upd_time') ?>

    <?php // echo $form->field($model, 'score') ?>

    <?php // echo $form->field($model, 'rate') ?>

    <?php // echo $form->field($model, 'rating') ?>

    <?php // echo $form->field($model, 'licence_no') ?>

    <?php // echo $form->field($model, 'licence_hash') ?>

    <?php // echo $form->field($model, 'licence_upd_time') ?>

    <?php // echo $form->field($model, 'hit_counter') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
