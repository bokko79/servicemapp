<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

?>
<?php if($object_type!=1): ?>
<?= $form->field($model_spec, '['.$key.']spec', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->textarea()->label($property->label)->hint($property->tHint) ?>
<?php endif; ?>