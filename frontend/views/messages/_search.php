<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\MsgThreadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="msg-thread-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sender') ?>

    <?= $form->field($model, 'receiver') ?>

    <?= $form->field($model, 'is_read') ?>

    <?= $form->field($model, 'is_read_rec') ?>

    <?php // echo $form->field($model, 'del') ?>

    <?php // echo $form->field($model, 'delbyrec') ?>

    <?php // echo $form->field($model, 'time') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
