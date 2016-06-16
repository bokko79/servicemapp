<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\slider\Slider;

$model_action_property->actionProperty = $actionProperty->value_default;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_action_property, '['.$key.']actionProperty', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-3" style="padding-right:0; margin: 30px 0 0px;">
        <?= $form->field($model_action_property, '['.$key.']actionProperty', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                'showLabels'=>false
            ])->widget(Slider::classname(), [
                'sliderColor'=>Slider::TYPE_INFO,
                'handleColor'=>Slider::TYPE_INFO,
                'value'=>$actionProperty->value_default,
                'pluginOptions'=>[
                    'min'=>$actionProperty->value_min,
                    'max'=>$actionProperty->value_max,
                    'step'=>$actionProperty->step,
                    'tooltip'=>'always'
                ]
            ])->hint($property->tHint) ?>
    </div>        
</div>