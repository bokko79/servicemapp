<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\slider\Slider;

$model_method->method = $method->default_value;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_method, '['.$key.']method', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-3" style="padding-right:0; margin: 30px 0 0px;">
        <?= $form->field($model_method, '['.$key.']method', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                'showLabels'=>false
            ])->widget(Slider::classname(), [
                'sliderColor'=>Slider::TYPE_INFO,
                'handleColor'=>Slider::TYPE_INFO,
                'value'=>$method->default_value,
                'pluginOptions'=>[
                    'min'=>$method->range_min,
                    'max'=>$method->range_max,
                    'step'=>$method->range_step,
                    'tooltip'=>'always'
                ]
            ])->hint($property->tHint) ?>
    </div>        
</div>