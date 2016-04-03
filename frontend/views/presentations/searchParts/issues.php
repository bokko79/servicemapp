<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$message = 'Problemi u vezi sa predmetom usluge koje rešavate ili otklanjate.';

$model_list = ArrayHelper::map($service->object->issues, 'issue', 'issue');
?>
<div class="wrapper headline search" style="">
    <label class="head">
        <i class="fa fa-stethoscope fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Problemi'); ?>
    </label>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
     <div class="enclosedCheckboxes">    
    <?= Form::widget([
        'model'=>$model,
        'form'=>$form,
        'options'=>['tag'=>'div', 'style'=>'margin:10px 0;'],
        'contentBefore'=>'',
        'attributes'=> [
            'issues[]' => [
                'type'=>Form::INPUT_CHECKBOX_LIST,
                'label' => 'Problem(i) sa '.$service->object->tNameInst.'<br><div class="checkbox col-sm-offset-3"><label><input type="checkbox" id="ckbCheckAll"> <i>Izaberite/Poništite sve</i></label></div>',
                //'hint'=> $property->tHint,
                'fieldConfig'=>[
                    'hintType' => ActiveField::HINT_SPECIAL,
                    'hintSettings' => ['onLabelClick' => false, 'onLabelHover' => true, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                ],              
                'items' => $model_list,
                'options'=>['tag'=>'ul', 'class'=>'column2 multiselect', 'style'=>'padding:13px 20px 20px; background:#f8f8f8; border:1px solid #ddd; border-radius:4px;'],
            ]
        ]
    ]) ?>
    </div>
</div>