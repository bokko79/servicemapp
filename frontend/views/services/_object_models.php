<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use yii\web\Session;
$session = Yii::$app->session;

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">	
		<?php $form = kartik\widgets\ActiveForm::begin([
		    'id' => 'form-vertical',
		    'method' => 'get',
		    'action' => '/add/'.slug($model->name),
		    'type' => ActiveForm::TYPE_VERTICAL,
		]); ?>
			<?php if($model->object_ownership=='provider'): ?>
				<p class="hint">Možete izabrati više vrsta.</p>
				<div class="enclosedCheckboxes">
					<div class="checkbox"><label><input type="checkbox" id="ckbCheckAll<?= $model->id ?>"> <i>Izaberite/Poništite sve</i></label></div>
					<?= $form->field(new \frontend\models\CsObjects, 'id[]')->checkboxList($model->objectModelsList, ['unselect'=>null])->label(false) ?>
				</div>
			<?php else: ?>
					<?= $form->field(new \frontend\models\CsObjects, 'id[]')->radioList($model->objectModelsList, ['unselect'=>null])->label(false) ?>
			<?php endif; ?>
			<div class="float-right">
		            <?= Html::submitButton(Yii::t('app', 'Nastavi'), ['class' => 'btn btn-success shadow']) ?>
		        </div>
		<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>