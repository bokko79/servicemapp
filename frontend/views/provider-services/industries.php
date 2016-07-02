<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$new_provider_industry = new \common\models\ProviderIndustries();
foreach($user->provider->industries as $provider_industry){		
	$new_provider_industry->selection[] = $provider_industry->industry_id;
}
?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">				
			<?php $form = kartik\widgets\ActiveForm::begin([
			    'id' => 'form-vertical',
			    //'method' => 'get',
			    'action' => '/'.$user->username.'/services',
			    'type' => ActiveForm::TYPE_VERTICAL,
			]); ?>
				<p class="hint">Možete izabrati više vrsta.</p>
				<hr>
				<?php foreach(\common\models\CsCategories::find()->all() as $category) { 
					$models_list = ArrayHelper::map($category->industries, 'id', 'sCaseName'); ?>					
					<h3><?= $category->tName ?></h3>
					<div class="enclosedCheckboxes" style="padding:20px 30px;">
						<div class="checkbox"><label><input type="checkbox" id="ckbCheckAll"> <i>Izaberite/Poništite sve</i></label></div>
						<ul class="column3">
						<?= $form->field($new_provider_industry, 'selection')->checkboxList($models_list, [
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
						</ul>
					</div>
				
					<div class="float-right margin-bottom-20">
			            <?= Html::submitButton(Yii::t('app', 'Sačuvaj'), ['class' => 'btn btn-success']) ?>
			        </div>
			        <hr>
			    <?php } ?>
			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>