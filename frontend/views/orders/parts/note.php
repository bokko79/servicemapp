<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Što bolje i opširnije opišete šta Vam treba i šta zahtevate, bolje ćete ponude sakupiti i samim tim povećati sebi šanse za dobro obavljen posao. Ovde imate priliku da svojim rečima upotpunite svoju porudžbinu.';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $model->noOther ?></span>&nbsp;
        <i class="fa fa-pencil fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Ukoliko imate još nešto da dodate...') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper notshown body fadeIn animated" style="border-top:none;;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <?= $form->field($model, 'note')->textArea(['rows'=>4]) ?>

    <?= $form->field($model, 'title', [])->input('text', ['value'=>$service->sCaseName.((isset($objects)) ? ': '.$objects[0]->tName : null)]) ?>    
</div>