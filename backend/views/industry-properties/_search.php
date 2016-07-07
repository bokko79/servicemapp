<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsSkillsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-skills-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'industry_id') ?>

    <?= $form->field($model, 'property_id') ?>

    <?php // echo $form->field($model, 'value_default') ?>

    <?php // echo $form->field($model, 'value_min') ?>

    <?php // echo $form->field($model, 'value_max') ?>

    <?php // echo $form->field($model, 'step') ?>

    <?php // echo $form->field($model, 'display_order') ?>

    <?php // echo $form->field($model, 'multiple_values') ?>

    <?php // echo $form->field($model, 'read_only') ?>

    <?php // echo $form->field($model, 'required') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
