<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list_hints = ArrayHelper::map($property->models, 'id', 'tNameWithHint');
$additional_option[null] = 'bilo koje';
$model_list_hints = ArrayHelper::merge($model_list_hints, $additional_option);
foreach($property->models as $prop_model){
	if($prop_model->selected_value==1){
		$model_method->method = $prop_model->id;
		break;
	}
} ?>
	<?= $form->field($model_method, '['.$key.']method_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioList($model_list_hints)->label($property->label)->hint($property->tHint) ?>