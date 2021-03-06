<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceIndustryPropertyValues */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-service-industry-property-values-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'service_industry_property_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'industry_property_value_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'selected_value')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
