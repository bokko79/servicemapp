<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_method->method = $method->default_value;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_method, '['.$key.']method', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
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
            ])->input('number', ['min'=>$method->range_min, 'max'=>$method->range_max, 'step'=>$method->range_step])->hint($property->tHint) ?>
    </div>        
</div>