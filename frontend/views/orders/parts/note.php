<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">8</span>&nbsp;
        <?php echo Yii::t('app', 'Ukoliko imate još nešto da dodate...'); ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;">
    <?= $form->field($model, 'note')->textArea() ?>

    <?= $form->field($model, 'title', [])->input('text', ['value'=>$service->sCaseName]) ?>    
</div>