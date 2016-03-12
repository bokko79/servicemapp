<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Što bolje i opširnije opišete šta Vam treba i šta zahtevate, bolje ćete ponude sakupiti i samim tim povećati sebi šanse za dobro obavljen posao. Ovde imate priliku da svojim rečima upotpunite svoju porudžbinu.';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"></span>&nbsp;
        <i class="fa fa-user fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Nemate nalog?') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper notshown body fadeIn animated" style="border-top:none;;">
	<?= $this->render('../_hint.php', ['message'=>$message]) ?>
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