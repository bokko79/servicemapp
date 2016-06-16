<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->propertyValues, 'id', 'tName');
$additional_option[null] = 'bilo koje';
$model_list = ArrayHelper::merge($model_list, $additional_option);
foreach($property->propertyValues as $propertyValue){
	if($propertyValue->selected_value==1){
		$model_action_property->actionProperty = $propertyValue->id;
		break;
	}
}
?>
	<?= $form->field($model_action_property, '['.$key.']actionPropertyValues', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioButtonGroup($model_list, [
		    'class' => 'btn-group',
		    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
		])->label($property->label)->hint($property->tHint) ?>
