<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use dektrium\user\models\RecoveryForm;

$model = Yii::createObject([
            'class'    => RecoveryForm::className(),
            'scenario' => 'request',
        ]);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <h4><i class="fa fa-lock"></i>&nbsp;Zaboravljena lozinka</h4>
            <div class="margin-top-20">
            <?php 
                $form = ActiveForm::begin([
                    'id' => 'password-recovery-form', 
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'action' => Url::to('/user/recovery/request'),
                    //'enableAjaxValidation'   => true,
                    //'enableClientValidation' => false,
                ]); 
            ?>
                <?= $form->field($model, 'email', [
                    'enableAjaxValidation'   => true,
                    'feedbackIcon' => [
                        'default' => 'envelope',
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'defaultOptions' => ['class'=>'text-primary']
                    ]])->input('email') ?>
                
                
                <div class="form-group">
                    <?= Html::submitButton('Nastavi', ['class' => 'btn btn-primary', 'style'=>'width:100%']) ?>
                </div>
            <?php ActiveForm::end(); ?>    
            </div>
        </div>
        <div class="col-md-7">
            <h4><i class="fa fa-user"></i>&nbsp;&nbsp;Login</h4>
            <div class="box">
                Da bi se prijavili, <a href="#w21-tab0" data-toggle="tab">kliknite ovde.</a>
            </div>
        </div>
    </div>
</div>