<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderServices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'provider_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_id')->textInput() ?>

    <?= $form->field($model, 'industry_id')->textInput() ?>

    <?= $form->field($model, 'is_set')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
