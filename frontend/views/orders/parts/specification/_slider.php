<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\slider\Slider;

$model_spec->spec = $specification->default_value;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_spec, '['.$key.']spec', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label',        
    ]); ?>
    <div class="col-sm-3" style="padding-right:0; margin: 30px 0 10px;">
        <?= $form->field($model_spec, '['.$key.']spec',[                
                //'hintType' => ActiveField::HINT_SPECIAL,
                //'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false,'iconBesideInput' => true, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                'showLabels'=>false
            ])->widget(Slider::classname(), [
                'sliderColor'=>Slider::TYPE_INFO,
                'handleColor'=>Slider::TYPE_INFO,
                'value'=>$specification->default_value,
                'pluginOptions'=>[
                    'min'=>$specification->range_min,
                    'max'=>$specification->range_max,
                    'step'=>$specification->range_step,
                    'tooltip'=>'always'
                ]
            ])->hint($property->tHint) ?>
    </div>        
</div>