<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$model_list = ArrayHelper::map($property->models, 'id', 'tNameWithMedia');

foreach($property->models as $prop_model){
    if($prop_model->selected_value==1){
        $model_method->method_models[] = $prop_model->id;
    }
}
?>
<div class="enclosedCheckboxes">
    <?= Form::widget([
        'model'=>$model_method,
        'form'=>$form,
        'options'=>['tag'=>'div', 'style'=>'margin:10px 0;'],
        'contentBefore'=>'',
        'attributes'=> [
        	'['.$key.']method_models' => [
        		'type'=>Form::INPUT_CHECKBOX_LIST,
        		'label' => $property->label .'<br><div class="checkbox col-sm-offset-3"><label><input type="checkbox" id="ckbCheckAll'. $property->id .'"> <i>Izaberite/Poništite sve</i></label></div>',
        		'hint'=> $property->tHint,
        		'fieldConfig'=>[
                    'hintType' => ActiveField::HINT_SPECIAL,
    				'hintSettings' => ['onLabelClick' => false, 'onLabelHover' => true, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
                ],	    		
        		'items' => $model_list,
        		'options'=>['tag'=>'ul', 'class'=>'column3 multiselect', 'style'=>'padding:13px 20px 20px; background:#f8f8f8; border:1px solid #ddd; border-radius:4px;'],
        	]
        ]
    ]) ?>
</div>