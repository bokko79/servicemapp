<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\SignupForm;

$model = new SignupForm();
?>
<div class="container-fluid">
	<div class="row">
        <div class="col-md-5">
            <h4><i class="fa fa-sign-in"></i>&nbsp;&nbsp; Registrujte se kao korisnik</h4>


           <div class="margin-top-20">
            <?php 
                $form = ActiveForm::begin([
                    'id' => 'signup-form-vertical', 
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'action' => Yii::$app->urlManager->createUrl('site/signup'),
                ]); 
            ?>
                <?= $form->field($model, 'username', [
                    'feedbackIcon' => [
                        'default' => 'user',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->input('text') ?>
                <?= $form->field($model, 'password', [
                    'feedbackIcon' => [
                        'default' => 'lock',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->passwordInput() ?>
                <?= $form->field($model, 'password_repeat', [
                    'feedbackIcon' => [
                        'default' => 'lock',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->passwordInput() ?>
                <?= $form->field($model, 'email', [
                    'feedbackIcon' => [
                        'default' => 'envelope',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->input('email') ?>
                <label>I Aggree With <a href="#">Terms &amp; Conditions</a></label>
                <div class="form-group">
                    <?= Html::submitButton('Registracija korisnika', ['class' => 'btn btn-primary', 'style'=>'width:100%']) ?>
                </div>
            <?php ActiveForm::end(); ?>    
            </div>
        </div>
        <?php /*<div class="col-md-3">
            <h4><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Social</h4>
            <div class="socials clearfix">
                <a class="fa fa-facebook facebook"></a>
                <a class="fa fa-twitter twitter"></a>
                <a class="fa fa-google-plus google-plus"></a>
                <a class="fa fa-pinterest pinterest"></a>
                <a class="fa fa-linkedin linked-in"></a>
                <a class="fa fa-github github"></a>
            </div>
        </div> */ ?>
        <div class="col-md-7">
            <h4><i class="fa fa-user"></i>&nbsp;&nbsp;Login</h4>
            <div class="box">
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel.
                </p>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel sapien elit in.
                </p>
            </div>
            <div class="box">
                Already Have An Account.<br>
                Click Here For <a href="#panel2" data-toggle="tab">Login</a>
            </div>
        </div>
    </div>
</div>