<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>
<div class="new_user_register">
    <h6 class="col-sm-offset-3 margin-top-20 gray-color"><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Registracija</h6>
    <p class="col-sm-offset-3 hint-text margin-bottom-20"></p>
    <?= $form->field($new_provider, 'username', [
        'enableAjaxValidation' => true,
        'feedbackIcon' => [
            'default' => 'user',
            'success' => 'ok',
            'error' => 'exclamation-sign',
            'defaultOptions' => ['class'=>'text-primary']
        ]])->input('text') ?>
    <?= $form->field($new_provider, 'password', [
        'feedbackIcon' => [
            'default' => 'lock',
            'success' => 'ok',
            'error' => 'exclamation-sign',
            'defaultOptions' => ['class'=>'text-primary']
        ]])->passwordInput() ?>
    <?php /* $form->field($new_provider, 'password_repeat', [
        'feedbackIcon' => [
            'default' => 'lock',
            'success' => 'ok',
            'error' => 'exclamation-sign',
            'defaultOptions' => ['class'=>'text-primary']
        ]])->passwordInput() */ ?>
    <?= $form->field($new_provider, 'email', [
        'enableAjaxValidation' => true,
        'feedbackIcon' => [
            'default' => 'envelope',
            'success' => 'ok',
            'error' => 'exclamation-sign',
            'defaultOptions' => ['class'=>'text-primary']
        ]])->input('email') ?>
    <?= $form->field($new_provider, 'industry')->hiddenInput(['value'=>$service->industry_id])->label(false) ?>
    <?= $form->field($new_provider, 'registration_type')->hiddenInput(['value'=>4])->label(false) ?>
</div> 