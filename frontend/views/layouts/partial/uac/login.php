<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dektrium\user\models\LoginForm;
use dektrium\user\Finder;
use dektrium\user\widgets\Connect;

$model = Yii::createObject(LoginForm::className());
?>
<div class="container-fluid">   
    <div class="row">
        <div class="col-md-5 col-md-offset-1">
            <h4><i class="fa fa-user"></i>&nbsp;&nbsp; Prijavite se ovde</h4>
            <div class="margin-top-20">
            <?php 
                $form = ActiveForm::begin([
                    'id' => 'login-form-vertical', 
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'action' => Yii::$app->urlManager->createUrl('/user/security/login'),
                ]); 
            ?>
                <?= $form->field($model, 'login', [
                    'feedbackIcon' => [
                        'default' => 'user',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]]) ?>
                <?= $form->field($model, 'password', [
                    'feedbackIcon' => [
                        'default' => 'lock',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->passwordInput() ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'style'=>'width:100%']) ?>
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
        <div class="col-md-5">
            <h4><i class="fa fa-sign-in"></i>&nbsp;&nbsp;Registracija</h4>
            <div class="box">
                Prijavite se klikom na ikonu jedne od sledećih popularnih socijalnih mreža, ukoliko imate postojeći nalog: 
                <?= Connect::widget([
                    'baseAuthUrl' => ['/user/security/auth'],
                ]) ?>
            </div>
            <div class="box">
                Nemate nalog?<br>
                Kliknite ovde za <a href="#w21-tab1" data-toggle="tab">besplatnu Registraciju.</a>
            </div>
            <div class="box">
                Imate nalog, ali ste zaboravili lozinku? <a href="#w21-tab3" data-toggle="tab">Kliknite ovde.</a>
            </div>
        </div>
    </div>
</div>