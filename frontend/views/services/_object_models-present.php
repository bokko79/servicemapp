<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use yii\web\Session;
$session = Yii::$app->session;

$new_presentation = new \frontend\models\ProviderServices;

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">	
		<?php $form = kartik\widgets\ActiveForm::begin([
		    'id' => 'form-vertical',
		    'method' => 'get',
		    'action' => '/new-presentation',
		    'type' => ActiveForm::TYPE_VERTICAL,
		]); ?>
			<?php if($model->object_ownership=='user'): ?>
					<p class="hint">Možete izabrati više vrsta.</p>
					<div class="enclosedCheckboxes">
						<div class="checkbox"><label><input type="checkbox" id="ckbCheckAll<?= $model->id ?>"> <i>Izaberite/Poništite sve</i></label></div>
						<?= $form->field($new_presentation,  'object_model[]')->checkboxList($model->objectModelsList, ['unselect'=>null, 'class'=>'column3 multiselect'])->label(false) ?>
					</div>
			<?php else: ?>		
					<?= $form->field($new_presentation, 'object_model[]')->radioList($model->objectModelsList, ['unselect'=>null, 'class'=>'column3 multiselect'])->label(false) ?>
			<?php endif; ?>
					<?= $form->field($new_presentation, 'service_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
					<?= $form->field($new_presentation, 'id')->hiddenInput(['value'=>null])->label(false) ?>
			<div class="float-right">
		            <?= Html::submitButton(Yii::t('app', 'Nastavi'), ['class' => 'btn btn-success']) ?>
		        </div>
		<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>