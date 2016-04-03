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
        <i class="fa fa-euro fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Budžet') ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body notshown fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'budget', [
            'label'=>'Budžet', 
            'class'=>'col-sm-2 control-label'
        ]); ?>
        <div class="col-sm-1" style="padding-right:0">
            <?= $form->field($model, 'budget_operator',[
                    'showLabels'=>false
                ])->dropDownList(['exact'=>'=', 'approx'=>'oko', 'min'=>'min', 'max'=>'max'], ['class'=>'']) ?>
        </div>
        <div class="col-sm-2" style="padding-right:0">
            <?= $form->field($model, 'budget',[
                    'addon' => [
                        'append' => ['content'=>Yii::$app->user->currency],
                        'groupOptions' => ['class'=>'']],
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    'showLabels'=>false
                ])->input('number', ['min'=>0,]); ?>
    <?php /* $form->field($model, 'budget',['showLabels'=>false])->widget(Slider::classname(), [
                        'sliderColor'=>Slider::TYPE_INFO,
                        'handleColor'=>Slider::TYPE_INFO,
                        'pluginOptions'=>[
                            //'handle'=>'triangle',
                            'tooltip'=>'always',
                            'min'=>0,
                            'max'=>10000,
                            'range'=>true,
                        ]
                ]); */ ?> 
        </div>             
    </div>
</div>