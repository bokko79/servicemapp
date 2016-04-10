<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;

$model_list = ArrayHelper::map($property->models, 'id', 'tName');
?>
<?php
	foreach($property->models as $prop_model){
		if($prop_model->selected_value==1){
			$model_spec->spec = $prop_model->id;
			break;
		}
	} ?>
<?= $form->field($model_spec, '['.$key.']spec_models', [
        'hintType' => ActiveField::HINT_SPECIAL,
        'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
        ])->widget(Select2::classname(), [
            'data' => $model_list,
            'options' => ['placeholder' => 'Izaberite...'],
            'size' => Select2::LARGE,
            'language' => 'sr-Latn',
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])->label($property->label)->hint($property->tHint) ?>
