<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use kartik\widgets\TouchSpin;
use kartik\field\FieldRange;
use yii\helpers\ArrayHelper;

$model_method->method = $method->default_value;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_method, '['.$key.']method', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-2" style="padding-right:0">
        <?= $form->field($model_method, '['.$key.']method_operator', [
                'showLabels'=>false
            ])->dropDownList(['exact'=>'=', 'approx'=>'oko', 'min'=>'min', 'max'=>'max'], ['class'=>'input-lg']) ?>
    </div>
    <div class="col-sm-3" style="padding-right:0">
        <?= $form->field($model_method, '['.$key.']method', [
                'addon' => [
                    'append' => ['content'=>($property->unit!=null) ? $property->unit->oznaka : null],
                    'groupOptions' => ['class'=>'input-group-lg']],
                'feedbackIcon' => [
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%'],
                    'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%; top: 6px;']
                ],
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                'showLabels'=>false
            ])->input('number', ['min'=>$method->range_min, 'max'=>$method->range_max, 'step'=>$method->range_step]); ?>
    </div>        
</div>
<?php /* FieldRange::widget([
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
	]);*/ ?>