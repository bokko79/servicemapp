<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;
use kartik\widgets\Select2;

$model_list = ArrayHelper::map($property->propertyValues, 'id', 'tName');

foreach($property->propertyValues as $propertyValue){
    if($propertyValue->selected_value==1){
        $model_object_property->objectPropertyValues[] = $propertyValue->id;
    }
}
?>
<?= $form->field($model_object_property, '['.$index.']objectPropertyValues', [
        'hintType' => ActiveField::HINT_SPECIAL,
        'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
        ])->widget(Select2::classname(), [
            'data' => $model_list,
            'size' => Select2::LARGE,
            'maintainOrder' => true,
            'options' => ['placeholder' => 'Izaberite...', 'multiple' => true],
            'language' => 'sr-Latn',
            'changeOnReset' => false,
            'pluginOptions' => [
                'tags' => true,
                //'maximumInputLength' => 10,
                'allowClear' => false
            ],            
        ])->label($property->label)->hint($property->tHint) ?>