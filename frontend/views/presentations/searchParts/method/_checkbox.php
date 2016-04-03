<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;
$model_method->value = isset($input[$index]['value']) ? $input[$index]['value'] : null;
?>
<?= $form->field($model_method, '['.$index.']value', [
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->widget(SwitchInput::classname(), [
    	'value'=>true,
	    'pluginOptions' => [
	        'onText' => 'Da',
	        'offText' => 'Ne',
	        //'size' => 'mini',
	        'inlineLabel' => false,	        
	    ]
    ])->label(c($property->label))->hint($property->tHint) ?>