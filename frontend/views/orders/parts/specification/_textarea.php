<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

$model_spec->value = $objectProperty->value_default;
?>
<div class="form-group kv-fieldset-inline">
    <?= Html::activeLabel($model_spec, '['.$key.']value', [
        'label'=>$property->label, 
        'class'=>'col-sm-3 control-label'
    ]); ?>
    <div class="col-sm-9" style="padding-right:0">
	<?= $form->field($model_spec, '['.$key.']value', [
			'showLabels' => false,
			'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->widget(TinyMce::className(), [
		    'options' => ['rows' => 6],
		    'language' => 'sr',
		    'clientOptions' => [
		        'plugins' => [
		           "insertdatetime media table contextmenu paste" 
		        ],
		        'convert_fonts_to_spans' => true,
		        'paste_as_text' => true,
		        'menubar' => false,
		        'statusbar' => false,
		        'toolbar' => "undo redo | bold italic | bullist numlist outdent indent"
		    ]
		]) ?>
	</div>        
</div>
