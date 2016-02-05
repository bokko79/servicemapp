<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderIndustrySkills */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="provider-industry-skills-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'provider_industry_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'skill_id')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
