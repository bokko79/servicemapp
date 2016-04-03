<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use kartik\widgets\TouchSpin;
use kartik\field\FieldRange;
use yii\helpers\ArrayHelper;

$model_spec->value_operator = isset($input[$index]['value_operator']) ? $input[$index]['value_operator'] : null;
$model_spec->value = isset($input[$index]['value']) ? $input[$index]['value'] : null;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_spec, '['.$index.']value', [
        'label'=>$property->label, 
        'class'=>'col-sm-2 control-label'
    ]); ?>
    <div class="col-sm-1" style="padding-right:0">
        <?= $form->field($model_spec, '['.$index.']value_operator',[
                'showLabels'=>false
            ])->dropDownList(['exact'=>'=', 'approx'=>'oko', 'min'=>'min', 'max'=>'max'], ['class'=>'']) ?>
    </div>
    <div class="col-sm-2" style="padding-right:0">
        <?= $form->field($model_spec, '['.$index.']value',[
                'addon' => [
                    'append' => ['content'=>($property->unit!=null) ? $property->unit->oznaka : null],
                    'groupOptions' => ['class'=>'']],
                'feedbackIcon' => [
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%'],
                    'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:60%; top: 6px;']
                ],
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                'showLabels'=>false
            ])->input('number', ['min'=>$specification->range_min, 'max'=>$specification->range_max, 'step'=>$specification->range_step]); ?>
    </div>        
</div>