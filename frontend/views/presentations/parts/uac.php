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
    <?= $this->render('uac/_register.php', ['form'=>$form, 'new_provider'=>$new_provider, 'service'=>$service]) ?>
    <?php // $this->render('uac/_login.php', ['form'=>$form, 'returning_user'=>$returning_user, 'service'=>$service]) ?> 
    <?= yii\helpers\Html::activeHiddenInput($new_provider, 'checker', ['value'=>1]) ?>
    <?= yii\helpers\Html::activeHiddenInput($returning_user, 'checker', ['value'=>0]) ?>
</div>