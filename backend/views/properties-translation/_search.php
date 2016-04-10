<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsPropertiesTranslationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-properties-translation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'property_id') ?>

    <?= $form->field($model, 'lang_code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'name_akk') ?>

    <?php // echo $form->field($model, 'hint') ?>

    <?php // echo $form->field($model, 'orig_name') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
