<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\builder\FormGrid;
use yii\web\Session;

$model = new \frontend\models\CartForm();
$service = $presentation->pService;
$model->service = $service;
$object_type = $service->service_object;

$session = Yii::$app->session;
?>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'action' => '/quick-direct-order',
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <fieldset class="settings" style="margin:30px 0 !important;">

    <?php if($service->amount!=0): // SERVICE AMOUNT ?>
        <div class="form-group kv-fieldset-inline">
            <div class="col-sm-4" style="padding-right:0">
                <?= $form->field($model, 'amount_operator',[
                        'showLabels'=>false
                    ])->dropDownList(['exact'=>'tačno', 'approx'=>'oko', 'min'=>'najmanje', 'max'=>'najviše'], ['class'=>'']) ?>
            </div>
            <div class="col-sm-4" style="padding-right:0">
                <?= $form->field($model, 'amount',[
                        'addon' => [
                            'append' => ['content'=>$presentation->unit->oznaka],
                            'groupOptions' => ['class'=>'']],
                        'showLabels'=>false
                    ])->input('number', ['min'=>$service->amount_range_min, 'max'=>$service->amount_range_max, 'step'=>$service->amount_range_step]); ?>
            </div>        
        </div>
    <?php endif; ?>

    <?php if($service->consumer!=0): // SERVICE CONSUMERS ?>
        <div class="form-group kv-fieldset-inline">
            <div class="col-sm-4" style="padding-right:0">
                <?= $form->field($model, 'consumer',[
                        'addon' => [
                            'prepend' => ['content'=>'<i class="fa fa-user"></i>'],
                            'groupOptions' => ['class'=>'']
                        ],
                        'showLabels'=>false
                    ])->input('number', ['min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max, 'step'=>$service->consumer_range_step, 'placeholder'=>($service->consumer_children==0) ? '' : 'Osobe']) ?>
            </div>

            <?php if($service->consumer!=0 && $service->consumer_children!=0): ?>
            <div class="col-sm-4" style="padding-right:0">
                <?= $form->field($model, 'consumer_children',[
                        'addon' => [
                            'prepend' => ['content'=>'<i class="fa fa-child"></i>'],
                            'groupOptions' => ['class'=>'']
                        ],
                        'showLabels'=>false
                    ])->input('number', ['min'=>0, 'placeholder'=>'Deca']) ?>
            </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="" style="margin:20px;">
        <?= Html::hiddenInput('industry', $service->industry_id) ?>
        <?= Html::submitButton(Yii::t('app', 'Naruči <i class="fa fa-arrow-circle-right"></i>'), ['class' => 'btn btn-danger']) ?>
    </div>

    </fieldset>
<?php ActiveForm::end(); ?>

