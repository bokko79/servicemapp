<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Activities */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activities-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'activity')->dropDownList([ 'order' => 'Order', 'promotion' => 'Promotion', 'bid' => 'Bid', 'agreement' => 'Agreement', 'feedback' => 'Feedback', 'comment_order' => 'Comment order', 'comment_promotion' => 'Comment promotion', 'comment_bid' => 'Comment bid', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'normal' => 'Normal', 'urgent' => 'Urgent', 'sponsored' => 'Sponsored', 'private' => 'Private', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'active' => 'Active', 'edited' => 'Edited', 'suspended' => 'Suspended', 'draft' => 'Draft', 'expired' => 'Expired', 'banned' => 'Banned', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'time')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
