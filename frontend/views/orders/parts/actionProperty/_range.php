<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use kartik\widgets\TouchSpin;
use kartik\field\FieldRange;
use yii\helpers\ArrayHelper;

$model_action_property->actionProperty = $actionProperty->value_default;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_action_property, '['.$key.']actionProperty', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-2" style="padding-right:0">
        <?= $form->field($model_action_property, '['.$key.']method_operator', [
                'showLabels'=>false
            ])->dropDownList(['exact'=>'=', 'approx'=>'oko', 'min'=>'min', 'max'=>'max'], ['class'=>'input-lg']) ?>
    </div>
    <div class="col-sm-3" style="padding-right:0">
        <?= $form->field($model_action_property, '['.$key.']actionProperty', [
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
            ])->input('number', ['min'=>$actionProperty->value_min, 'max'=>$actionProperty->value_max, 'step'=>$actionProperty->step]); ?>
    </div>        
</div>