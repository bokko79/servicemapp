<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->propertyValues, 'id', 'tNameWithHint');
$additional_option[null] = 'bilo koje';
$model_list = ArrayHelper::merge($model_list, $additional_option);
foreach($property->propertyValues as $propertyValue){
    if($propertyValue->selected_value==1){
        $model_object_property->value = $propertyValue->id;
        break;
    }
} ?>
	<?= $form->field($model_object_property, '['.$key.']objectPropertyValues', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioButtonGroup($model_list, [
		    'class' => 'btn-group',
		    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
		])->label($property->label)->hint($property->tHint) ?>
