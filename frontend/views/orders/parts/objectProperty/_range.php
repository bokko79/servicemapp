<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use kartik\widgets\TouchSpin;
use kartik\field\FieldRange;
use yii\helpers\ArrayHelper;

$model_object_property->value = $objectProperty->value_default;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_object_property, '['.$key.']value', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-2" style="padding-right:0">
        <?= $form->field($model_object_property, '['.$key.']value_operator',[
                'showLabels'=>false
            ])->dropDownList(['exact'=>'=', 'approx'=>'oko', 'min'=>'min', 'max'=>'max'], ['class'=>'input-lg']) ?>
    </div>
    <div class="col-sm-3" style="padding-right:0">
        <?= $form->field($model_object_property, '['.$key.']value',[
                'addon' => [
                    'append' => ['content'=>($property->unit!=null) ? $property->unit->oznaka : null],
                    'groupOptions' => ['class'=>'input-group-lg']],
                'feedbackIcon' => [
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%'],
                    'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%; top: 6px;']
                ],
                //'hintType' => ActiveField::HINT_SPECIAL,
                //'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                'showLabels'=>false
            ])->input('number', ['min'=>$objectProperty->value_min, 'max'=>$objectProperty->value_max, 'step'=>$objectProperty->step])->hint($property->tHint); ?>
    </div>        
</div>
<?php /* FieldRange::widget([
	    'form' => $form,
	    'model' => $model_object_property,
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