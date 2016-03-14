<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

?>
<?= $form->field($model_spec, '['.$index.']value', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->input('text', ['value'=>$specification->default_value])->label($property->label)->hint($property->tHint) ?>
