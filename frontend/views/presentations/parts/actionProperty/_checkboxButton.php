<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->propertyValues, 'id', 'tNameWithHint');

foreach($property->propertyValues as $propertyValue){
	if($propertyValue->selected_value==1){
		$model_action_property->actionPropertyValues[] = $propertyValue->id;
	}
}
?>
<?= $form->field($model_action_property, '['.$index.']actionPropertyValues', [
			'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		    ])->checkboxButtonGroup($model_list, [
					    'class' => 'btn-group-lg',
					    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
					])->label($property->label)->hint($property->tHint) ?>