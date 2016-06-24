<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\slider\Slider;

$model_object_property->value = $objectProperty->value_default;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_object_property, '['.$index.']value', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label',        
    ]); ?>
    <div class="col-sm-3" style="padding-right:0; margin: 30px 0 10px;">
        <?= $form->field($model_object_property, '['.$index.']value',[                
                //'hintType' => ActiveField::HINT_SPECIAL,
                //'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false,'iconBesideInput' => true, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                'showLabels'=>false
            ])->widget(Slider::classname(), [
                'sliderColor'=>Slider::TYPE_INFO,
                'handleColor'=>Slider::TYPE_INFO,
                'value'=>$objectProperty->value_default,
                'pluginOptions'=>[
                    'min'=>$objectProperty->value_min,
                    'max'=>$objectProperty->value_max,
                    'step'=>$objectProperty->step,
                    'tooltip'=>'always'
                ]
            ])->hint($property->tHint) ?>
    </div>        
</div>