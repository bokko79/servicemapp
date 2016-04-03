<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tNameWithHint');
if(isset($input[$index]['spec_models']) and $input[$index]['spec_models']!=''){
    foreach($input[$index]['spec_models'] as $m_spec_model){
        $model_spec->spec_models[] = $m_spec_model;
    } 
}
?>
	<?= $form->field($model_spec, '['.$index.']spec_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->checkboxButtonGroup($model_list, [
							    'class' => 'btn-group-sm',
							    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
							])->label($property->label)->hint($property->tHint) ?>