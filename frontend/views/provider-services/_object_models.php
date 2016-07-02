<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$o_models = $object->models;
$new_presentation = new \common\models\ProviderServices;
$model_list = ArrayHelper::map($o_models, 'id', 'sCaseName');
?>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-vertical',
    'method' => 'get',
    'action' => '/new-presentation',
    'type' => ActiveForm::TYPE_VERTICAL,
]); ?>
	<div class="enclosedCheckboxes">		
        <?php if($model->service_object!=1): ?>
            <p class="hint">Možete izabrati više vrsta.</p>
            <div class="enclosedCheckboxes">
                <div class="checkbox"><label><input type="checkbox" id="ckbCheckAll"> <i>Izaberite/Poništite sve</i></label></div>
                <?= $form->field($new_presentation,  'object_model[]')->checkboxList($model_list, ['unselect'=>null])->label(false) ?>
            </div>
        <?php else: ?>      
            <?= $form->field($new_presentation, 'object_model[]')->radioList($model_list, ['unselect'=>null])->label(false) ?>
        <?php endif; ?>
            <?= $form->field($new_presentation, 'service_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
            <?= $form->field($new_presentation, 'id')->hiddenInput(['value'=>$proService->id])->label(false) ?>
	</div>
	<div class="float-right">
        <?= Html::submitButton(Yii::t('app', 'Nastavi'), ['class' => 'btn btn-success']) ?>
    </div>
<?php ActiveForm::end(); ?>