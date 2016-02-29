<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use kartik\widgets\TouchSpin;
use kartik\field\FieldRange;
use yii\helpers\ArrayHelper;

$model_spec->spec = $specification->default_value;
?>

<?php if($object_type!=1): ?>
	<div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model_spec, '['.$key.']spec', [
            'label'=>$property->label, 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-3" style="padding-right:0">
            <?= $form->field($model_spec, '['.$key.']spec',[
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
                ])->input('number', ['min'=>$specification->range_min, 'max'=>$specification->range_max, 'step'=>$specification->range_step])->hint($property->tHint) ?>
        </div>        
    </div>
<?php else: ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model_spec, '['.$key.']spec', [
            'label'=>$property->label, 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model_spec, '['.$key.']spec_operator',[
                    'showLabels'=>false
                ])->dropDownList(['exact'=>'tačno', 'approx'=>'oko', 'min'=>'najmanje', 'max'=>'najviše'], ['class'=>'input-lg']) ?>
        </div>
        <div class="col-sm-3" style="padding-right:0">
            <?= $form->field($model_spec, '['.$key.']spec',[
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
                ])->input('number', ['min'=>$specification->range_min, 'max'=>$specification->range_max, 'step'=>$specification->range_step]); ?>
        </div>        
    </div>
			
<?php endif; ?>