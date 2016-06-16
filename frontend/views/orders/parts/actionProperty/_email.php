<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_action_property->actionProperty = $actionProperty->value_default;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_action_property, '['.$key.']actionProperty', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-3" style="padding-right:0">
        <?= $form->field($model_action_property, '['.$key.']actionProperty', [
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