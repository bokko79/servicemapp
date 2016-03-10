<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
$model_list_hints = ArrayHelper::map($property->models, 'id', 'tNameWithHint');
?>
<?php if($object_type!=1): 
	foreach($property->models as $prop_model){
		if($prop_model->selected_value==1){
			$model_method->method = $prop_model->id;
			break;
		}
	} ?>
	<?= $form->field($model_method, '['.$key.']method', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioList($model_list)->label($property->label)->hint($property->tHint) ?>
<?php else: 
	foreach($property->models as $prop_model){
		if($prop_model->selected_value==1){
			$model_method->method_models[] = $prop_model->id;
		}
	} ?>
	<?= $form->field($model_method, '['.$key.']method_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->checkboxList($model_list)->label($property->label)->hint($property->tHint) ?>
<?php endif; ?>