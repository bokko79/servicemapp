<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Koliko često Vam treba usluga?';
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
	<?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'frequency', [
            'label'=>'Učestalost', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'frequency', [
                    'addon' => [
                        'append' => ['content'=>'<i class="fa fa-times"></i>'],
                        'groupOptions' => ['class'=>'input-group-lg']],                    
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    'showLabels'=>false
                ])->input('number', ['min'=>0, 'class'=>'input-lg']) ?>
        </div>      
        <div class="col-sm-3" style="padding-right:0">
            <?= $form->field($model, 'frequency_unit',[
                    'showLabels'=>false
                ])->dropDownList([ 'day' => 'dnevno', 'week' => 'sedmično', 'month' => 'mesečno', 'year' => 'godišnje', ], ['prompt' => '', 'class'=>'input-lg']) ?>
        </div>
    </div>
</div>