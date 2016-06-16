<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjectsTranslationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-objects-translation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'object_id') ?>

    <?= $form->field($model, 'lang_code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'name_gen') ?>

    <?php // echo $form->field($model, 'name_dat') ?>

    <?php // echo $form->field($model, 'name_akk') ?>

    <?php // echo $form->field($model, 'name_inst') ?>

    <?php // echo $form->field($model, 'name_gender') ?>

    <?php // echo $form->field($model, 'orig_name') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>