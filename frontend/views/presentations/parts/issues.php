<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$message = 'Problemi u vezi sa predmetom usluge koje rešavate ili otklanjate.';
if($object_model and count($object_model)==1){
	$rel_obj = $object_model[0];
} else {
	$rel_obj = $object;
}
$model_list = ArrayHelper::map($rel_obj->issues, 'issue', 'issue');
?>
<div class="wrapper headline" style="" id="issues">
    <label class="head">
        <span class="badge"><?= $model->noIssues ?></span>&nbsp;
        <i class="fa fa-stethoscope fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Problemi'); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections04">
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
        		'label' => 'Problem(i) sa '.$rel_obj->tNameInst.'<br><div class="checkbox col-sm-offset-3"><label><input type="checkbox" id="ckbCheckAll"> <i>Izaberite/Poništite sve</i></label></div>',
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
    <div class="form-group">
    	<label class="control-label col-md-3" for="presentations-name">Ostali problemi</label>
	    <div class="col-sm-9">
		    <div class="input_object_syn_wrap" style="margin-bottom:10px;">
				<span class="add_object_syn_button center overflow-hidden"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj novi problem', null, ['class'=>'btn btn-info shadow', 'style'=>'margin:10px 0']) ?></span>
			</div>
		</div>
    </div>
</div>
<?= $this->render('_submitButton.php') ?>
</div>