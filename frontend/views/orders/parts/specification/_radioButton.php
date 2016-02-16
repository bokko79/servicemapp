<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
$model_list_hints = ArrayHelper::map($property->models, 'id', 'tNameWithHint');
$model_spec->spec = 11;
?>
<?php if($object_type!=1): 
	foreach($property->models as $prop_model){
		if($prop_model->selected_value==1){
			$model_spec->spec = $prop_model->id;
			break;
		}
	} ?>
	<?= $form->field($model_spec, '['.$key.']spec', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioButtonGroup($model_list, [
							    'class' => 'btn-group-sm',
							    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
							])->label($property->label)->hint($property->tHint) ?>
<?php else: 
	foreach($property->models as $prop_model){
		if($prop_model->selected_value==1){
			$model_spec->spec_models[] = $prop_model->id;
		}
	} ?>
	<?= $form->field($model_spec, '['.$key.']spec_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->checkboxButtonGroup($model_list, [
							    'class' => 'btn-group-sm',
							    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
							])->label($property->label)->hint($property->tHint) ?>
<?php endif; ?>