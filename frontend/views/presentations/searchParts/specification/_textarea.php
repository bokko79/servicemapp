<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
$model_spec->value = isset($input[$index]['value']) ? $input[$index]['value'] : null;
?>
<?= $form->field($model_spec, '['.$index.']value', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->textarea()->label($property->label)->hint($property->tHint) ?>