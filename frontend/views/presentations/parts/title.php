<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

$message = 'Što bolje i opširnije opišete šta Vam treba i šta zahtevate, bolje ćete ponude sakupiti i samim tim povećati sebi šanse za dobro obavljen posao. Ovde imate priliku da svojim rečima upotpunite svoju porudžbinu.';
?>
<div class="wrapper headline" style="" id="title">
    <label class="head">
        <span class="badge"><?= $model->noTitle ?></span>&nbsp;
        <i class="fa fa-pencil fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Naslov i opis ponude...') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections05">
	<?= $this->render('../_hint.php', ['message'=>$message]) ?>
	<?= $form->field($model, 'title', [])->input('text', ['value'=>$model->title==null ? ($service->sCaseName.(count($object_model)==1 ? ': '.$object_model[0]->tName : null)) : $model->title]) ?>    
	<?= $form->field($model, 'description')->widget(TinyMce::className(), [
		    'options' => ['rows' => 6],
		    'language' => 'sr',
		    'clientOptions' => [
		        'plugins' => [
		           "insertdatetime media table contextmenu paste" 
		        ],
		        'convert_fonts_to_spans' => true,
		        'paste_as_text' => true,
		        'menubar' => false,
		        'statusbar' => false,
		        'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
		    ]
		]) ?>
	<?= $this->render('_submitButton.php') ?>
</div>