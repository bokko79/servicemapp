<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\LoginForm;

$model = new LoginForm();
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
                    'action' => Yii::$app->urlManager->createUrl('site/login'),
                ]); 
            ?>
                <?= $form->field($model, 'username', [
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
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce vel.
                </p>
            </div>
            <div class="box">
                Nemate nalog?<br>
                Kliknite ovde za <a href="#w21-tab1" data-toggle="tab">besplatnu Registraciju.</a>
            </div>
        </div>
    </div>
</div>