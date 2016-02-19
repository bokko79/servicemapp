<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-history fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Koliko često?'); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
    <?= $form->field($model, 'frequency')->textInput() ?>
    <?= $form->field($model, 'frequency_unit')->dropDownList([ 'day' => 'dnevno', 'week' => 'sedmično', 'month' => 'mesečno', 'year' => 'godišnje', ], ['prompt' => '']) ?>
</div>