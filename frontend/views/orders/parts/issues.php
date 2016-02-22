<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = '';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-wrench fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Problemi'); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
</div>