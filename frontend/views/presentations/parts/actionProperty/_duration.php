<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>
<?php if($service->service_type==7 or $service->service_type==9 or $service->service_type==10 or $service->service_type==11): ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'duration', [
            'label'=>'Uobičajeno trajanje izvršenja usluge', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'duration_operator',[
                    'showLabels'=>false
                ])->dropDownList(['exact'=>'tačno', 'approx'=>'oko', 'min'=>'najmanje', 'max'=>'najviše'], ['class'=>'input-lg']) ?>
        </div>
        <div class="col-sm-3" style="padding-right:0">
            <?= $form->field($model, 'duration',[
                    'addon' => [
                        'prepend' => ['content'=>'<i class="fa fa-clock-o"></i>'],
                        'groupOptions' => ['class'=>'input-group-lg']],
                    'feedbackIcon' => [
                        'success' => 'ok',
                        'error' => 'exclamation-sign',
                        'successOptions' => ['class'=>'text-primary'],
                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
                    ],
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    'showLabels'=>false
                ])->input('number', ['step'=>1, 'min'=>0, 'placeholder'=>'Trajanje', 'class'=>'input-lg']); ?>
        </div>  
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'duration_unit',[
                    'showLabels'=>false
                ])->dropDownList([ 27 => 'minut(a)', 26 => 'sat(i)', 28 => 'dan(a)'], ['class'=>'input-lg']) ?>
        </div>
    </div>
<?php endif; ?>