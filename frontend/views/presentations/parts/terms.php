<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = '';
?>
<div class="wrapper headline" style="" id="terms">
    <label class="head">
        <span class="badge"><?= $model->noTerms ?></span>&nbsp;
        <i class="fa fa-gavel fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Uslovi izvršenja'); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections13">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?= $this->render('_submitButton.php') ?>
</div>