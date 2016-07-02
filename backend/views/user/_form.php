<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_reset_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_reset_time')->textInput() ?>

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_provider')->textInput() ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activation_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activation_time')->textInput() ?>

    <?= $form->field($model, 'invite_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'registered_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'last_login_time')->textInput() ?>

    <?= $form->field($model, 'login_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'login_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'online_status')->textInput() ?>

    <?= $form->field($model, 'last_activity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_verification_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_verification_time')->textInput() ?>

    <?= $form->field($model, 'rememberme_token')->textInput() ?>

    <?= $form->field($model, 'role_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>

</div>