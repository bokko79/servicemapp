<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\slider\Slider;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */
/* @var $form yii\widgets\ActiveForm */
$message = '';
?>
<div class="wrapper headline search" style="">
    <label class="head">
        <i class="fa fa-users fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Koliko osoba') ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body notshown fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'consumer', [
            'label'=>'Broj korisnika', 
            'class'=>'col-sm-2 control-label'
        ]); ?>
        <div class="col-sm-1" style="padding-right:0">
            <?= $form->field($model, 'consumer_operator',[
                    'showLabels'=>false
                ])->dropDownList(['exact'=>'=', 'approx'=>'oko', 'min'=>'min', 'max'=>'max'], ['class'=>'']) ?>
        </div>
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'consumer',[
                    'addon' => [
                        'append' => ['content'=>'<i class="fa fa-user"></i>'],
                        'groupOptions' => ['class'=>'']],
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    'showLabels'=>false
                ])->input('number', ['min'=>$service->consumer_range_min, 'max'=>$service->consumer_range_max, 'step'=>$service->consumer_range_step,]); ?>
        </div> 
        <div class="col-sm-4" style="padding-right:0">
            <?php /* $form->field($model, 'consumer',['showLabels'=>false])->widget(Slider::classname(), [
                        'value'=>7,
                        'sliderColor'=>Slider::TYPE_INFO,
                        'handleColor'=>Slider::TYPE_INFO,
                        'pluginOptions'=>[
                            //'handle'=>'triangle',
                            'tooltip'=>'always',
                            'min'=>0,
                            'max'=>100,
                            'step'=>1,
                        ]
                ]);*/ ?>
        </div>        
    </div>
</div>