<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tNameWithHint');

/*foreach($property->models as $prop_model){
	if($prop_model->selected_value==1){
		$model_method->method_models[] = $prop_model->id;
	}
}*/
?>
	<?= $form->field($model_method, '['.$key.']method_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->checkboxButtonGroup($model_list, [
							    'class' => 'btn-group-sm',
							    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
							])->label($property->label)->hint($property->tHint) ?>