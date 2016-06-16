<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use kartik\datecontrol\DateControl;

$model_action_property->actionProperty = $actionProperty->default_value;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_action_property, '['.$key.']actionProperty', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-5" style="padding-right:0">
        <?= $form->field($model_action_property, '['.$key.']actionProperty', [
                'showLabels' => false,
                'feedbackIcon' => [
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'successOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;'],
                    'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
                ],
            ])->widget(DateControl::classname(), [
                    'language' => 'rs-latin',
                    'type' => 'date',
                    'options'=> [
                        'type'=>2,
                        'size' => 'lg',
                        'pickerButton'=>['title'=>'Izaberite datum'],
                        'pluginOptions' => [                        
                            'autoclose' => true,
                            'todayHighlight' => true,
                            'startDate'=>date('Y-m-d H:i:s'),                      
                        ],
                    ],                                
            ]) ?>
    </div>        
</div>