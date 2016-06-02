<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_spec->value = $objectProperty->value_default;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_spec, '['.$key.']value', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-9" style="padding-right:0">
	<?= $form->field($model_spec, '['.$key.']value', [
			'showLabels' => false,
			'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->input('text', ['value'=>$objectProperty->value_default, 'class'=>'input-lg'])->label($property->label)->hint($property->tHint) ?>
	</div>        
</div>