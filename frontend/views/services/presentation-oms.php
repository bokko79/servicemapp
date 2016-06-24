<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">	
		<?php $form = kartik\widgets\ActiveForm::begin([
		    'id' => 'form-vertical',
		    'method' => 'get',
		    //'action' => '/new-presentation',
		    'type' => ActiveForm::TYPE_VERTICAL,
		]); ?>
			<?php if($service->object_ownership=='user'): ?>
				<p class="hint">Možete izabrati više vrsta.</p>
				<div class="enclosedCheckboxes">
					<div class="checkbox"><label><input type="checkbox" id="ckbCheckAll<?= $service->id ?>"> <i>Izaberite/Poništite sve</i></label></div>
					<?= $form->field($model,  'object_models[]')->checkboxList($service->objectModelsList, ['unselect'=>null, 'class'=>'column3 multiselect'])->label(false) ?>
				</div>
			<?php else: ?>		
				<?= $form->field($model, 'object_models[]')->radioList($service->objectModelsList, ['unselect'=>null, 'class'=>'column3 multiselect'])->label(false) ?>
			<?php endif; ?>
			<div class="float-right">
	            <?= Html::submitButton(Yii::t('app', 'Nastavi'), ['class' => 'btn btn-success']) ?>
			</div>
		<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>