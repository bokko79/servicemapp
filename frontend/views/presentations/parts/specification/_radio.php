<?php
use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
if($model_spec->models)$model_spec->spec_models = $model_spec->models[0]->spec_model;
?>
	<?= $form->field($model_spec, '['.$index.']spec_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioList($model_list)->label($property->label)->hint($property->tHint) ?>