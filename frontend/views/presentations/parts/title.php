<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Što bolje i opširnije opišete šta Vam treba i šta zahtevate, bolje ćete ponude sakupiti i samim tim povećati sebi šanse za dobro obavljen posao. Ovde imate priliku da svojim rečima upotpunite svoju porudžbinu.';
?>
<div class="wrapper headline" style="" id="title">
    <label class="head">
        <span class="badge"><?= $model->noTitle ?></span>&nbsp;
        <i class="fa fa-pencil fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Ime i opis...') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections05">
	<?= $this->render('../_hint.php', ['message'=>$message]) ?>
	<?= $form->field($model, 'name', [])->input('text', ['value'=>$service->sCaseName.(($object_model!=null) ? ': '.$object_model->tName : null)]) ?>    
	<?= $form->field($model, 'description')->textArea(['rows'=>4]) ?>
</div>