<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;

$model_list = ArrayHelper::map($property->propertyValues, 'id', 'tName');

foreach($property->propertyValues as $propertyValue){
    if($propertyValue->selected_value==1){
        $model_action_property->actionPropertyValues[] = $propertyValue->id;
    }
}
?>
<?= $form->field($model_action_property, '['.$key.']actionPropertyValues', [
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
