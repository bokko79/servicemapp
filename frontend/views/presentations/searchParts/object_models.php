<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */
/* @var $form yii\widgets\ActiveForm */
$o_models = $service->object->models;
$model_list = ArrayHelper::map($o_models, 'id', 'sCaseName');
$message = '';
?>
<div class="wrapper headline search" style="">
    <label class="head">
        <i class="fa fa-cubes fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Vrste '. $service->object->tNameGen) ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body notshown fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="enclosedCheckboxes">    
        <?= Form::widget([
            'model'=>$model,
            'form'=>$form,
            'options'=>['tag'=>'div', 'style'=>'margin:10px 0;'],
            'contentBefore'=>'',
            'attributes'=> [
                'object_models' => [
                    'type'=>Form::INPUT_CHECKBOX_LIST,
                    'label' => 'Vrste '. $service->object->tNameGen .'<br><div class="checkbox col-sm-offset-3"><label><input type="checkbox" id="ckbCheckAll'. $service->id .'"> <i>Izaberite/Poništite sve</i></label></div>',
                    //'hint'=> $property->tHint,
                    'fieldConfig'=>[
                        'hintType' => ActiveField::HINT_SPECIAL,
                        'hintSettings' => ['onLabelClick' => false, 'onLabelHover' => true, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                    ],              
                    'items' => $model_list,
                    'options'=>['tag'=>'ul', 'class'=>'column4 multiselect', 'style'=>'padding:13px 20px 20px; background:#f8f8f8; border:1px solid #ddd; border-radius:4px;', 'unselect'=>null],
                ]
            ]
        ]) ?>
    </div>
</div>