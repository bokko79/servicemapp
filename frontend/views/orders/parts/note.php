<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-pencil fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Ukoliko imate još nešto da dodate...') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper notshown body fadeIn animated" style="border-top:none;;">
    <?= $form->field($model, 'note')->textArea() ?>

    <?= $form->field($model, 'title', [])->input('text', ['value'=>$service->sCaseName]) ?>    
</div>