<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');

foreach($property->models as $prop_model){
	if($prop_model->selected_value==1){
		$model_skill->skills[] = $prop_model->id;
	}
} ?>
	<?= $form->field($model_skill, '['.$key.']skill_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->dropDownList($model_list, ['prompt'=>'Izaberite...', 'class'=>'input-lg'])->label($property->label)->hint($property->tHint) ?>
