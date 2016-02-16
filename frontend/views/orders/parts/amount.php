<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">6</span>&nbsp;
        <?php echo Yii::t('app', 'Koliko {unit} Vam treba {service}?', ['unit'=>$service->unit->tNameGen, 'service'=>$service->tName]); ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;">
<?php /*
    <?= $form->field($model, 'amount_operator')->dropDownList(['tačno', 'oko', 'najmanje', 'najviše']) ?>
    <?= $form->field($model, 'amount', [
    		'addon' => [
                'append' => ['content'=>$service->unit->oznaka],
                'groupOptions' => ['class'=>'input-group-lg'],
            ],
            'feedbackIcon' => [
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'successOptions' => ['class'=>'text-primary', 'style'=>'right:18%;'],
                'errorOptions' => ['class'=>'text-primary', 'style'=>'right:18%;']
            ]])->input('number', ['min'=>$service->amount_range_min, 'max'=>$service->amount_range_max, 'step'=>$service->amount_range_step, 'value'=>$service->amount_default, 'style' => 'width:120px']) ?>
*/ ?>
<?= Form::widget([
    'model'=>$model,
    'form'=>$form,
    'options'=>['tag'=>'div', 'class'=>''],
    'columns'=>12,    
    'attributes'=> [
        'amount_operator' => [
            'type'=>Form::INPUT_DROPDOWN_LIST,
            'label' => false,
            //'inputContainer'=>['class'=>'col-sm-12'],
            'items' => ['tačno', 'oko', 'najmanje', 'najviše'],
            'columnOptions'=>['colspan'=>3],
            'fieldConfig'=>[]
        ],
        'amount' => [
            'type'=>Form::INPUT_HTML5,
            'html5type'=>'number',
            'label' => false,
            'options'=>['min'=>$service->amount_range_min, 'max'=>$service->amount_range_max, 'step'=>$service->amount_range_step, 'value'=>$service->amount_default, 'style' => ''],
            'columnOptions'=>['colspan'=>5],
            'fieldConfig'=>[
                'addon' => [
                    'append' => ['content'=>$service->unit->oznaka],
                ],
                'feedbackIcon' => [
                    'success' => 'ok',
                    'error' => 'exclamation-sign',
                    'successOptions' => ['class'=>'text-primary', 'style'=>'right:18%;'],
                    'errorOptions' => ['class'=>'text-primary', 'style'=>'right:18%;']
                ]
            ]
        ]
    ]
]) ?>
</div>