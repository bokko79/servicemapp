<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsUnitsTranslationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-units-translation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'unit_id') ?>

    <?= $form->field($model, 'lang_code') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'name_gen') ?>

    <?php // echo $form->field($model, 'name_imp') ?>

    <?php // echo $form->field($model, 'oznaka') ?>

    <?php // echo $form->field($model, 'oznaka_imp') ?>

    <?php // echo $form->field($model, 'ozn_htmlfree') ?>

    <?php // echo $form->field($model, 'ozn_htmlfree_imp') ?>

    <?php // echo $form->field($model, 'orig_name') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
