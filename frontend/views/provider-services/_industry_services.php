<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;


$model_list = ArrayHelper::map($model->industry->services, 'id', 'tName');
$new_provider_service = new \frontend\models\ProviderServices();

foreach($model->services as $model_service){	
	$new_provider_service->selection[] = $model_service->service_id;
}
?>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-vertical',
    //'method' => 'get',
    'action' => '/'.$model->provider->user->username.'/services',
    'type' => ActiveForm::TYPE_VERTICAL,
]); ?>	
		<p class="hint">Možete izabrati više vrsta.</p>
		<div class="enclosedCheckboxes">
			<div class="checkbox"><label><input type="checkbox" id="ckbCheckAll"> <i>Izaberite/Poništite sve</i></label></div>
			<?= $form->field($new_provider_service, 'selection')->checkboxList($model_list, [
								'unselect'=>null,
								'item' => function($index, $label, $name, $checked, $value){
							        $disable = false;
							        if ($checked) {
							            $disable = true;
							        }

							        $checkbox = Html::checkbox($name, $checked, ['value' => $value, 'disabled' => $disable]);
							        return Html::tag('div', Html::label($checkbox . $label), ['class' => 'checkbox']);
							    },
							])->label(false) ?>
		</div>
		<?= $form->field($new_provider_service, 'provider_industry_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
		<?= $form->field($new_provider_service, 'provider_id')->hiddenInput(['value'=>$model->provider_id])->label(false) ?>
		<?= $form->field($new_provider_service, 'industry_id')->hiddenInput(['value'=>$model->industry_id])->label(false) ?>
		<div class="float-right">
            <?= Html::submitButton(Yii::t('app', 'Nastavi'), ['class' => 'btn btn-success']) ?>
        </div>
<?php ActiveForm::end(); ?>