<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$o_models = $object->models;

$model_list = ArrayHelper::map($o_models, 'id', 'sCaseName');
?>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-vertical',
    'method' => 'get',
    'action' => '/add/'.mb_strtolower(str_replace(' ', '-', $model->name)),
    'type' => ActiveForm::TYPE_VERTICAL,
]); ?>
	
	<?php if($model->service_object==1): ?>
		<p class="hint">Možete izabrati više vrsta.</p>
		<div class="enclosedCheckboxes">
			<div class="checkbox"><label><input type="checkbox" id="ckbCheckAll"> <i>Izaberite/Poništite sve</i></label></div>
			<?= $form->field(new \frontend\models\CsObjects, 'id[]')->checkboxList($model_list)->label(false) ?>
		</div>
	<?php else: ?>
		<?= $form->field(new \frontend\models\CsObjects, 'id[]', [])->radioList($model_list)->label(false) ?>
	<?php endif; ?>
	<div class="float-right">
            <?= Html::submitButton(Yii::t('app', 'Nastavi'), ['class' => 'btn btn-success']) ?>
        </div>
<?php ActiveForm::end(); ?>