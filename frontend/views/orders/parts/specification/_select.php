<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->propertyValues, 'id', 'tName');

foreach($property->propertyValues as $propertyValue){
    if($propertyValue->selected_value==1){
        $model_spec->value = $propertyValue->id;
        break;
    }
}
?>
	<?= $form->field($model_spec, '['.$key.']property_values', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->dropDownList($model_list, ['prompt'=>'Izaberite...', 'class'=>'input-lg'])->label($property->label)->hint($property->tHint) ?>
