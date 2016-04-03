<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

$message = '';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">1</span>&nbsp;
        <i class="fa fa-tag fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Osnovni podaci') ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body notshown fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
	<?= $form->field($model, 'username', [])->input('text', []) ?>
	<?= $form->field($model, 'email', [])->input('email', []) ?>
<?= $this->render('_submitButton.php') ?>
</div>