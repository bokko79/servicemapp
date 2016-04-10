<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');

foreach($property->models as $prop_model){
	if($prop_model->selected_value==1){
		$model_method->method_models[] = $prop_model->id;
	}
}
?>
<?= $form->field($model_method, '['.$key.']method_models', [
        'hintType' => ActiveField::HINT_SPECIAL,
        'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
        ])->dropDownList($model_list, ['multiple'=>true, 'size'=>6])->label($property->label)->hint($property->tHint) ?>