<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
$additional_option[null] = 'bilo koje';
$model_list = ArrayHelper::merge($model_list, $additional_option);
foreach($property->models as $prop_model){
	if($prop_model->selected_value==1){
		$model_skill->skills[] = $prop_model->id;
	}
} ?>
	<?= $form->field($model_skill, '['.$key.']skill_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioButtonGroup($model_list, [
		    'class' => 'btn-group',
		    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
		])->label($property->label)->hint($property->tHint) ?>
