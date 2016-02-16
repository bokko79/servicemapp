<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use kartik\widgets\TouchSpin;
use kartik\field\FieldRange;
use yii\helpers\ArrayHelper;
?>
<?php if($object_type!=1): ?>
	<?= FieldRange::widget([
	    'form' => $form,
	    'model' => $model_spec,
	    'label' => $property->label,
	    'attribute1' => '['.$key.']spec',
	    'attribute2' => '['.$key.']spec_to',
	    'type' => FieldRange::INPUT_SPIN,
	    'separator'=>'&larr; '.\Yii::t('app', 'do').' &rarr;',
	    'widgetOptions1' => [
	    	'options' => ['style'=>'width:70px;', 'placeholder' => 'Od ...'],
		    'pluginOptions' => [
		        'buttonup_class' => 'btn btn-default', 
		        'buttondown_class' => 'btn btn-default', 
		        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
		        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
		        'initval' => $specification->default_value,
		        'min' => $specification->range_min,
		        'max' => $specification->range_max,
		        'step' => $specification->range_step,
		    ]
	    ],
	    'widgetOptions2' => [
	    	'options' => ['style'=>'width:70px;', 'placeholder' => '... do'],
		    'pluginOptions' => [
		        'buttonup_class' => 'btn btn-default', 
		        'buttondown_class' => 'btn btn-default', 
		        'buttonup_txt' => '<i class="glyphicon glyphicon-plus-sign"></i>', 
		        'buttondown_txt' => '<i class="glyphicon glyphicon-minus-sign"></i>',
		        'initval' => $specification->default_value,
		        'min' => $specification->range_min,
		        'max' => $specification->range_max,
		        'step' => $specification->range_step,
		    ]
	    ],
	]); ?>
<?php else: ?>
	<?= $form->field($model_spec, '['.$key.']spec', [
	'addon' => ['append' => ['content'=>$service->unit->oznaka]],
	'feedbackIcon' => [
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'successOptions' => ['class'=>'text-primary', 'style'=>'right:18%;'],
                        'errorOptions' => ['class'=>'text-primary', 'style'=>'right:18%;']
                    ],
	'hintType' => ActiveField::HINT_SPECIAL,
	'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->input('number', ['min'=>$specification->range_min, 'max'=>$specification->range_max, 'step'=>$specification->range_step, 'value'=>$specification->default_value])->label($property->label)->hint($property->tHint) ?>
<?php endif; ?>