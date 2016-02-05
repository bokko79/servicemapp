<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderTermsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-terms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'provider_id') ?>

    <?= $form->field($model, 'ip_warranty') ?>

    <?= $form->field($model, 'performance_warranty') ?>

    <?= $form->field($model, 'invoicing') ?>

    <?= $form->field($model, 'payment_methods') ?>

    <?php // echo $form->field($model, 'payment') ?>

    <?php // echo $form->field($model, 'payment_advance_percentage') ?>

    <?php // echo $form->field($model, 'payment_at_once_time') ?>

    <?php // echo $form->field($model, 'payment_installment_no_rates') ?>

    <?php // echo $form->field($model, 'payment_installment_rate') ?>

    <?php // echo $form->field($model, 'payment_installment_frequency') ?>

    <?php // echo $form->field($model, 'payment_installment_frequency_unit') ?>

    <?php // echo $form->field($model, 'liability') ?>

    <?php // echo $form->field($model, 'agreement_effective_until') ?>

    <?php // echo $form->field($model, 'cancellation_policy') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
