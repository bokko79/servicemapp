<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use yii\web\Session;
$session = Yii::$app->session;

$o_models = $object->models;
if($session['state']=='present'){
	$new_presentation = new \frontend\models\ProviderServices;
}
$model_list = ArrayHelper::map($o_models, 'id', 'sCaseName');
?>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-vertical',
    'method' => 'get',
    'action' => $session['state']=='present' ? '/new-presentation' : '/add/'.slug($model->name),
    'type' => ActiveForm::TYPE_VERTICAL,
]); ?>
	<?php if($model->service_object==1 && $session['state']!='present'): ?>
		<p class="hint">Možete izabrati više vrsta.</p>
		<div class="enclosedCheckboxes">
			<div class="checkbox"><label><input type="checkbox" id="ckbCheckAll"> <i>Izaberite/Poništite sve</i></label></div>
			<?= $form->field(new \frontend\models\CsObjects, 'id[]')->checkboxList($model_list, ['unselect'=>null])->label(false) ?>
		</div>
	<?php else: ?>		
		<?php if($session['state']=='present'){ ?>
			<?= $form->field($new_presentation, 'object_model')->radioList($model_list, ['unselect'=>null])->label(false) ?>
			<?= $form->field($new_presentation, 'service_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
		<?php } else { ?>
			<?= $form->field(new \frontend\models\CsObjects, 'id[]')->radioList($model_list, ['unselect'=>null])->label(false) ?>
		<?php } ?>
	<?php endif; ?>
	<div class="float-right">
            <?= Html::submitButton(Yii::t('app', 'Nastavi'), ['class' => 'btn btn-success']) ?>
        </div>
<?php ActiveForm::end(); ?>