<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsActionsTranslationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-actions-translation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'action_id') ?>

    <?= $form->field($model, 'lang_code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'name_akk') ?>

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
