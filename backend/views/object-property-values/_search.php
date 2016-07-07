<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjectPropertyValuesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-object-property-values-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'object_property_id') ?>

    <?= $form->field($model, 'property_value_id') ?>

    <?= $form->field($model, 'object_id') ?>

    <?= $form->field($model, 'value_type') ?>

    <?php // echo $form->field($model, 'selected_value') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
