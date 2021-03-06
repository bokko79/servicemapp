<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use kartik\switchinput\SwitchInput;
use yii\helpers\ArrayHelper;

?>
<?= $form->field($model_action_property, '['.$index.']value', [
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