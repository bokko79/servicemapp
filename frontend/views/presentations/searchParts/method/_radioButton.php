<?php
use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
if(isset($input[$index]['method_models']) and $input[$index]['method_models']!=''){
	$model_method->method_models[] = $input[$index]['method_models'][0];
}
?>
<?= $form->field($model_method, '['.$index.']method_models', [
			'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		    ])->radioButtonGroup($model_list, [
					    'class' => 'btn-group-sm',
					    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
					])->label($property->label)->hint($property->tHint) ?>
