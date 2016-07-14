<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceOrderingFlow */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-service-ordering-flow-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'service_id')->textInput() ?>

    <?= $form->field($model, 'industry_properties')->textInput() ?>

    <?= $form->field($model, 'object_container')->textInput() ?>

    <?= $form->field($model, 'object_models')->textInput() ?>

    <?= $form->field($model, 'object_properties')->textInput() ?>

    <?= $form->field($model, 'object_files')->textInput() ?>

    <?= $form->field($model, 'object_issues')->textInput() ?>

    <?= $form->field($model, 'action_properties')->textInput() ?>

    <?= $form->field($model, 'quantitites')->textInput() ?>

    <?= $form->field($model, 'locations')->textInput() ?>

    <?= $form->field($model, 'times')->textInput() ?>

    <?= $form->field($model, 'budget')->textInput() ?>

    <?= $form->field($model, 'advanced')->textInput() ?>

    <?= $form->field($model, 'notifications')->textInput() ?>

    <?= $form->field($model, 'terms')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
