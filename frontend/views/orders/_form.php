<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loc_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loc_id2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'loc_within')->textInput() ?>

    <?= $form->field($model, 'delivery_starts')->textInput() ?>

    <?= $form->field($model, 'delivery_ends')->textInput() ?>

    <?= $form->field($model, 'validity')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'lang_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class')->dropDownList([ 'global' => 'Global', 'registered' => 'Registered', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'registered_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_contact')->textInput() ?>

    <?= $form->field($model, 'turn_key')->textInput() ?>

    <?= $form->field($model, 'order_type')->dropDownList([ 'single' => 'Single', 'multi' => 'Multi', 'operation' => 'Operation', 'process' => 'Process', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'process_id')->textInput() ?>

    <?= $form->field($model, 'success')->textInput() ?>

    <?= $form->field($model, 'success_time')->textInput() ?>

    <?= $form->field($model, 'hit_counter')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
