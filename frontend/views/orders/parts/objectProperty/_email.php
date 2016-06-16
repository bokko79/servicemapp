<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_object_property->value = $objectProperty->value_default;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_object_property, '['.$key.']value', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-3" style="padding-right:0">
        <?= $form->field($model_object_property, '['.$key.']value',[
                'addon' => [
                    'groupOptions' => ['class'=>'input-group-lg']],
                'feedbackIcon' => [
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%'],
                    'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%; top: 6px;']
                ],
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                'showLabels'=>false
            ])->input('email', [])->hint($property->tHint) ?>
    </div>        
</div>