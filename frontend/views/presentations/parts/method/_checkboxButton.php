<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
?>
<?= $form->field($model_method, '['.$index.']method_models[]', [
			'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		    ])->checkboxButtonGroup($model_list, [
					    'class' => 'btn-group-lg',
					    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default']]
					])->label($property->label)->hint($property->tHint) ?>