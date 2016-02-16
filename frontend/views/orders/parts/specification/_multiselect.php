<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$model_list = ArrayHelper::map($property->models, 'id', 'tNameWithHint');

foreach($property->models as $prop_model){
	if($prop_model->selected_value==1){
		$model_spec->spec_models[] = $prop_model->id;
	}
}
?>

	<?php /* $form->field($model_spec, '['.$key.']spec_models', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->checkboxList($model_list, ['options'=>['class'=>'lili']])->label($property->label)->hint($property->tHint) */?>

<?= Form::widget([
    'model'=>$model_spec,
    'form'=>$form,
    'options'=>['tag'=>'div', 'style'=>'margin:10px 0;'],
    'attributes'=> [
    	'['.$key.']spec_models' => [
    		'type'=>Form::INPUT_CHECKBOX_LIST,
    		'label' => $property->label,
    		'hint'=> $property->tHint,
    		'fieldConfig'=>[
                'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
            ],	    		
    		'items' => $model_list,
    		'options'=>['tag'=>'ul', 'class'=>'column2', 'style'=>'padding:13px 20px 20px; background:#f8f8f8; border:1px solid #ddd; border-radius:4px;'],
    	]
    ]
]) ?>