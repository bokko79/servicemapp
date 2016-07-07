<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceObjectPropertiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-service-object-properties-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'service_id') ?>

    <?= $form->field($model, 'object_property_id') ?>

    <?= $form->field($model, 'requirement') ?>

    <?= $form->field($model, 'readOnly') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
