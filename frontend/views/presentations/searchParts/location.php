<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\field\FieldRange;

$message = 'Vaše sedište i područje na kojem vršite '.$service->tName.'.';
$inputLoc = Yii::$app->request->get('Locations');
?>
<div class="wrapper headline search" style="">
    <label class="head">
        <i class="fa fa-map-marker fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Lokacije') ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body notshown fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
 
	<div class="enter_location fadeIn animated" style="margin-top:0">	
		<div class="form-group kv-fieldset-inline">
		    <?= Html::activeLabel($model, 'amount', [
		        'label'=>'Lokacija pružaoca usluge', 
		        'class'=>'col-sm-2 control-label'
		    ]); ?>
		    <div class="col-sm-7" style="padding-right:0">
		        <?= $form->field($model, 'location_input', [
				    	'addon' => [
				    		'prepend' => ['content'=>'<i class="fa fa-map-marker"></i>'],
				    	],
				    	'options' => [],
				    ])->input([], ['id'=>'presentation-search',])->label(false) ?>
		    </div>        
		</div>	
						
		<div class="col-md-2">
			<p class="hint-text right">Ovde ide tekst, koji služi kao objašnjenje za unos lokacije korisnika. Povlačenje markera, bla bla bla.</p>
		</div>
		<div class="col-md-6">
			<div id="my_map-search" class="col-md-12" style="height:360px; margin-bottom:20px;"></div>
		</div>
		<div class="col-md-4">
			<div class="location_operational_plaza fadeIn animated" style="<?= !empty($inputLoc) ? '' : 'display:none' ?>">
			<?php $model->coverage = $model->coverage ? $model->coverage : $service->coverage; ?>
			<?= $form->field($model, 'coverage', [
				'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			    ])->radioList($model->locationOperatingModelsSearch())->label(false)->hint('Pokrivenost') ?>
			</div>
		</div>	    
	</div>	
</div>
<div class="overflow-hidden" style="height:0;">
<input type="hidden" id="control_input_locationName" value="<?= !empty($inputLoc) ? $inputLoc['location_name'] : (Yii::$app->user->location ? Yii::$app->user->location->location_name : 'Beograd, Srbija') ?>">
<input type="hidden" id="control_input_country" value="<?= !empty($inputLoc) ? $inputLoc['country'] : (Yii::$app->user->location ? Yii::$app->user->location->country : 'Srbija') ?>">
<input type="hidden" id="control_input_city" value="<?= !empty($inputLoc) ? $inputLoc['city'] : (Yii::$app->user->location ? Yii::$app->user->location->city : 'Beograd') ?>">
<input type="hidden" id="control_input_lat" value="<?= !empty($inputLoc) ? $inputLoc['lat'] : (Yii::$app->user->location ? Yii::$app->user->location->lat : 44.786568) ?>">
<input type="hidden" id="control_input_lng" value="<?= !empty($inputLoc) ? $inputLoc['lng'] : (Yii::$app->user->location ? Yii::$app->user->location->lng : 20.44892159999995) ?>">
<?= yii\helpers\Html::activeHiddenInput($model, 'coverage_within', ['id'=>'hidden-geo-input', 'class'=>'location_within_input']) ?>

<?= $form->field($location, 'lat', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geosrch'=>'lat', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc_hq_lat'])->label(false) ?>
<?= $form->field($location, 'lng', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geosrch'=>'lng', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc_hq_lng'])->label(false) ?>
<?= $form->field($location, 'city', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geosrch'=>'locality', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc_hq_city'])->label(false) ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'country', ['data-geosrch'=>'country', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_country']) ?>

<?= yii\helpers\Html::activeHiddenInput($location, 'location_name', ['data-geosrch'=>'formatted_address', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_location_name']) ?>

</div>