<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use kartik\widgets\TouchSpin;
use kartik\field\FieldRange;
use yii\helpers\ArrayHelper;
?>
	<?= FieldRange::widget([
	    'form' => $form,
	    'model' => $model_spec,
	    'label' => $property->label,
	    'attribute1' => '['.$index.']value',
	    'attribute2' => '['.$index.']value_max',
	    'type' => FieldRange::INPUT_SPIN,
	    'separator'=>'&larr; '.\Yii::t('app', 'do').' &rarr;',
	    'widgetOptions1' => [
	    	'options' => ['style'=>'width:70px;', 'placeholder' => 'Od ...'],
		    'pluginOptions' => [
		        'initval' => $specification->default_value,
		        'min' => $specification->range_min,
		        'max' => $specification->range_max,
		        'step' => $specification->range_step,
		    ]
	    ],
	    'widgetOptions2' => [
	    	'options' => ['style'=>'width:70px;', 'placeholder' => '... do'],
		    'pluginOptions' => [
		        'initval' => $specification->default_value,
		        'min' => $specification->range_min,
		        'max' => $specification->range_max,
		        'step' => $specification->range_step,
		    ]
	    ],
	]); ?>