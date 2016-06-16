<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\TimePicker;
use kartik\datecontrol\DateControl;

$model_action_property->actionProperty = $actionProperty->value_default;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_action_property, '['.$key.']actionProperty', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-3" style="padding-right:0">
        <?= $form->field($model_action_property, '['.$key.']actionProperty', [
                'showLabels' => false,
            ])->widget(DateControl::classname(), [
                    'language' => 'rs-latin',
                    'type' => 'time',                    
                    'options'=> [                        
                        'size' => 'lg',
                        'pluginOptions' => [                        
                            'autoclose' => true,
                            'minuteStep' => $actionProperty->step,
                            'defaultTime' => $actionProperty->value_default,
                        ],
                    ],                                
            ]) ?>
    </div>        
</div>