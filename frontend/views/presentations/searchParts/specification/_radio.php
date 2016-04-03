<?php
use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
if(isset($input[$index]['spec_models']) and $input[$index]['spec_models']!=''){
	$model_spec->spec_models[] = $input[$index]['spec_models'][0];
}
?>
	<?= $form->field($model_spec, '['.$index.']spec_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioList($model_list)->label($property->label)->hint($property->tHint) ?>