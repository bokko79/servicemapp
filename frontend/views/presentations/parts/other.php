<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Podesite prezentaciju.';
?>
<div class="wrapper headline" style="" id="other">
    <label class="head">
        <span class="badge"><?= $model->noOther ?></span>&nbsp;
        <i class="fa fa-cogs fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Opšta podešavanja prezentacije') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections11">
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
</div>