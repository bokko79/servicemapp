<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Vaši login podaci su neophodni kako bi sačuvali Vaša podešavanja i omogućili Vam najbolje moguće uslove za našu uslugu.';
?>
<div class="wrapper headline" style="" id="uac">
    <label class="head">
        <span class="badge"><?= $model->noUac ?></span>&nbsp;
        <i class="fa fa-user fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'A Vi ste...?') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections15">   
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="col-sm-offset-3 margin-bottom-20">
        <?= Html::a('<span>Registrujte se</span>', null, ['class'=>'btn btn-warning toggle-register-login', 'style'=>'display:none;']); ?>
        <?= Html::a('<span class="reg">Već imate nalog? Prijavite se</span><span class="log" style="display:none;">Registrujte se</span>', null, ['class'=>'btn btn-warning toggle-register-login']); ?>
    </div> 
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
    <div class="returning_user_login" style="display:none;">
        <h6 class="col-sm-offset-3 margin-top-20 gray-color"><i class="fa fa-user"></i>&nbsp;&nbsp;Login</h6>
        <p class="col-sm-offset-3 hint-text margin-bottom-20"></p>
        <?php /* $form->field($returning_user, 'login', [
            'feedbackIcon' => [
                'default' => 'user',
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'defaultOptions' => ['class'=>'text-primary']
            ]]) ?>
        <?= $form->field($returning_user, 'password', [
            'feedbackIcon' => [
                'default' => 'lock',
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'defaultOptions' => ['class'=>'text-primary']
            ]])->passwordInput() ?>
        <?= $form->field($returning_user, 'rememberMe')->checkbox() */ ?>
    </div>
</div>