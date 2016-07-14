<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceOrderingFlowSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-service-ordering-flow-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'service_id') ?>

    <?= $form->field($model, 'industry_properties') ?>

    <?= $form->field($model, 'object_container') ?>

    <?= $form->field($model, 'object_models') ?>

    <?= $form->field($model, 'object_properties') ?>

    <?php // echo $form->field($model, 'object_files') ?>

    <?php // echo $form->field($model, 'object_issues') ?>

    <?php // echo $form->field($model, 'action_properties') ?>

    <?php // echo $form->field($model, 'quantitites') ?>

    <?php // echo $form->field($model, 'locations') ?>

    <?php // echo $form->field($model, 'times') ?>

    <?php // echo $form->field($model, 'budget') ?>

    <?php // echo $form->field($model, 'advanced') ?>

    <?php // echo $form->field($model, 'notifications') ?>

    <?php // echo $form->field($model, 'terms') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
