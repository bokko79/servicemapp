<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
if($model_method->models)$model_method->method_models = $model_method->models[0]->method_model;
?>
<?= $form->field($model_method, '['.$index.']method_models', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->radioList($model_list)->label($property->label)->hint($property->tHint) ?>
