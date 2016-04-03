<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */
/* @var $form yii\widgets\ActiveForm */
$message = '';
?>
<div class="wrapper headline search" style="">
    <label class="head">
        <i class="fa fa-signal fa-rotate-270 fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Koliko ').$service->unit->tNameGen ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body notshown fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'amount', [
            'label'=>'Potrebna količina usluge', 
            'class'=>'col-sm-2 control-label'
        ]); ?>
        <div class="col-sm-1" style="padding-right:0">
            <?= $form->field($model, 'quantity_operator',[
                    'showLabels'=>false
                ])->dropDownList(['exact'=>'=', 'approx'=>'oko', 'min'=>'min', 'max'=>'max'], ['class'=>'']) ?>
        </div>
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'quantity',[
                    'addon' => [
                        'append' => ['content'=>$service->unit->oznaka],
                        'groupOptions' => ['class'=>'']],
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    'showLabels'=>false
                ])->input('number', ['min'=>$service->amount_range_min, 'max'=>$service->amount_range_max, 'step'=>$service->amount_range_step]); ?>
        </div>        
    </div>
</div>