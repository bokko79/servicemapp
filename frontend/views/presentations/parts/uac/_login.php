<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>
<div class="returning_user_login" style="display:none;">
    <h6 class="col-sm-offset-3 margin-top-20 gray-color"><i class="fa fa-user"></i>&nbsp;&nbsp;Login</h6>
    <p class="col-sm-offset-3 hint-text margin-bottom-20"></p>
    <?= $form->field($returning_user, 'login', [
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
    <?= $form->field($returning_user, 'rememberMe')->checkbox()  ?>
</div>