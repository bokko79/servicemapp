<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BidsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bids-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'activity_id') ?>

    <?= $form->field($model, 'offer_id') ?>

    <?= $form->field($model, 'order_id') ?>

    <?= $form->field($model, 'loc_id') ?>

    <?php // echo $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'period_unit') ?>

    <?php // echo $form->field($model, 'delivery_starts') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'currency_id') ?>

    <?php // echo $form->field($model, 'price_per') ?>

    <?php // echo $form->field($model, 'price_per_unit') ?>

    <?php // echo $form->field($model, 'fixed_price') ?>

    <?php // echo $form->field($model, 'warranty') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'spec') ?>

    <?php // echo $form->field($model, 'reject_reason') ?>

    <?php // echo $form->field($model, 'report_reason') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'hit_counter') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
