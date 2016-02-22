<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
$model_list_hints = ArrayHelper::map($property->models, 'id', 'tNameWithHint');
?>
<?php
	foreach($property->models as $prop_model){
		if($prop_model->selected_value==1){
			$model_method->method = $prop_model->id;
			break;
		}
	} ?>
	<?= $form->field($model_method, '['.$key.']method', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->radioButtonGroup($model_list, [
							    'class' => 'btn-group-lg',
							    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default btn-lg']]
							])->label($property->label)->hint($property->tHint) ?>
