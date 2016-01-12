<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\OrdersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'loc_id') ?>

    <?= $form->field($model, 'loc_id2') ?>

    <?= $form->field($model, 'loc_within') ?>

    <?php // echo $form->field($model, 'delivery_starts') ?>

    <?php // echo $form->field($model, 'delivery_ends') ?>

    <?php // echo $form->field($model, 'validity') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'lang_code') ?>

    <?php // echo $form->field($model, 'class') ?>

    <?php // echo $form->field($model, 'registered_to') ?>

    <?php // echo $form->field($model, 'phone_contact') ?>

    <?php // echo $form->field($model, 'turn_key') ?>

    <?php // echo $form->field($model, 'order_type') ?>

    <?php // echo $form->field($model, 'process_id') ?>

    <?php // echo $form->field($model, 'success') ?>

    <?php // echo $form->field($model, 'success_time') ?>

    <?php // echo $form->field($model, 'hit_counter') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
