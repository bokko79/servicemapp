<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$model_list = ArrayHelper::map($industry->skills->property->models, 'id', 'tName');
$new_provider_industry_skill = new \frontend\models\ProviderIndustrySkills();
foreach($model->skills as $model_skill){	
	$new_provider_industry_skill->selection[] = $model_skill->property_model_id;
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
			<?= $form->field($new_provider_industry_skill, 'selection')->checkboxList($model_list, [
								'unselect'=>null])->label(false) ?>
			<?= $form->field($new_provider_industry_skill, 'provider_industry_id')->hiddenInput(['value'=>$model->id])->label(false) ?>
			<?= $form->field($new_provider_industry_skill, 'skill_id')->hiddenInput(['value'=>$model->industry->skills->id])->label(false) ?>
		</div>
	
	<div class="float-right">
            <?= Html::submitButton(Yii::t('app', 'Sačuvaj'), ['class' => 'btn btn-success']) ?>
        </div>
<?php ActiveForm::end(); ?>