<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$model_list = ArrayHelper::map($property->propertyValues, 'id', 'tNameWithMedia');

foreach($property->propertyValues as $propertyValue){
    if($propertyValue->selected_value==1){
        $model_object_property->value = $propertyValue->id;
        break;
    }
}
?>
<div class="enclosedCheckboxes">
    <?= Form::widget([
        'model'=>$model_object_property,
        'form'=>$form,
        'options'=>['tag'=>'div', 'style'=>'margin:10px 0;'],
        'contentBefore'=>'',
        'attributes'=> [
        	'['.$key.']objectPropertyValues' => [
        		'type'=>Form::INPUT_RADIO_LIST,
        		'label' => $property->label,
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