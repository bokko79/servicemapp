<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$model_list = ArrayHelper::map($property->models, 'id', 'tNameWithHint');
//print_r($model_spec->models); die();
foreach($model_spec->models as $m_spec_model){
    //if($m_spec->selected_value==1){
        $model_spec->spec_models[] = $m_spec_model->spec_model;
    //}
}
?>
<div class="enclosedCheckboxes">    
    <?= Form::widget([
        'model'=>$model_spec,
        'form'=>$form,
        'options'=>['tag'=>'div', 'style'=>'margin:10px 0;'],
        'contentBefore'=>'',
        'attributes'=> [
        	'['.$index.']spec_models' => [
        		'type'=>Form::INPUT_CHECKBOX_LIST,
        		'label' => $property->label .'<br><div class="checkbox col-sm-offset-3"><label><input type="checkbox" id="ckbCheckAll'. $property->id .'"> <i>Izaberite/Poništite sve</i></label></div>',
        		'hint'=> $property->tHint,
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