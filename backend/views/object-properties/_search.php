<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjectPropertiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-object-properties-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'object_id') ?>

    <?= $form->field($model, 'object_name') ?>

    <?= $form->field($model, 'property_id') ?>

    <?= $form->field($model, 'property_name') ?>

    <?php // echo $form->field($model, 'property_unit_id') ?>

    <?php // echo $form->field($model, 'property_unit_imperial_id') ?>

    <?php // echo $form->field($model, 'property_class') ?>

    <?php // echo $form->field($model, 'property_type') ?>

    <?php // echo $form->field($model, 'input_type') ?>

    <?php // echo $form->field($model, 'value_default') ?>

    <?php // echo $form->field($model, 'value_min') ?>

    <?php // echo $form->field($model, 'value_max') ?>

    <?php // echo $form->field($model, 'step') ?>

    <?php // echo $form->field($model, 'pattern') ?>

    <?php // echo $form->field($model, 'display_order') ?>

    <?php // echo $form->field($model, 'multiple_values') ?>

    <?php // echo $form->field($model, 'specific_values') ?>

    <?php // echo $form->field($model, 'read_only') ?>

    <?php // echo $form->field($model, 'required') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
