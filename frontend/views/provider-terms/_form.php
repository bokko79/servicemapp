<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderTerms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-terms-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'provider_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ip_warranty')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', 'irrelevant' => 'Irrelevant', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'performance_warranty')->dropDownList([ 'yes' => 'Yes', 'no' => 'No', 'irrelevant' => 'Irrelevant', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'invoicing')->dropDownList([ 'servicemapp' => 'Servicemapp', 'direct' => 'Direct', 'irrelevant' => 'Irrelevant', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'payment_methods')->dropDownList([ 'any' => 'Any', 'cheque' => 'Cheque', 'credit_card/paypal' => 'Credit card/paypal', 'servicemapp' => 'Servicemapp', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'payment')->dropDownList([ 'at_once' => 'At once', 'installments' => 'Installments', 'milestones' => 'Milestones', 'advance' => 'Advance', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'payment_advance_percentage')->textInput() ?>

    <?= $form->field($model, 'payment_at_once_time')->dropDownList([ 'after_delivery' => 'After delivery', 'after_invoicing' => 'After invoicing', 'upon_start' => 'Upon start', 'other' => 'Other', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'payment_installment_no_rates')->textInput() ?>

    <?= $form->field($model, 'payment_installment_rate')->textInput() ?>

    <?= $form->field($model, 'payment_installment_frequency')->textInput() ?>

    <?= $form->field($model, 'payment_installment_frequency_unit')->dropDownList([ 'day' => 'Day', 'week' => 'Week', 'month' => 'Month', 'year' => 'Year', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'liability')->dropDownList([ 'none' => 'None', 'possible' => 'Possible', 'full' => 'Full', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'agreement_effective_until')->dropDownList([ 'end_date' => 'End date', '1 month' => '1 month', '3 months' => '3 months', '6 months' => '6 months', '12 months' => '12 months', '24 months' => '24 months', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'cancellation_policy')->dropDownList([ 'flex' => 'Flex', 'moderate' => 'Moderate', 'strict' => 'Strict', 'very_strict' => 'Very strict', 'long_term' => 'Long term', 'short_term' => 'Short term', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
