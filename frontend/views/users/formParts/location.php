<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use dosamigos\tinymce\TinyMce;

$message = '';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">5</span>&nbsp;
        <i class="fa fa-map-marker fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Adresa') ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body notshown fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
	<?= $form->field($model, 'location_input', [
		    	'addon' => [
		    		'prepend' => ['content'=>'<i class="fa fa-map-marker"></i>'],
		    	],
				'feedbackIcon' => [
			        'success' => 'ok',
			        'error' => 'exclamation-sign',
			        'successOptions' => ['class'=>'text-primary'],
			        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
			    ],
			    'hintType' => ActiveField::HINT_SPECIAL,
				'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		    ])->input([], ['id'=>'user-location-hq'])->hint('Vaša adresa, odnosno adresa Vašeg preduzeća.') ?>		
		<div class="col-md-3">
			<p class="hint-text right">Ovde ide tekst, koji služi kao objašnjenje za unos lokacije korisnika. Povlačenje markera, bla bla bla.</p>
		</div>
	    <div id="my_map-hq" class="col-md-9" style="height:360px; margin-bottom:20px;"></div>
<?= $this->render('_submitButton.php') ?>
</div>
<input type="hidden" id="control_input_locationName" value="<?= ($pl = $model->location) ? $pl->location_name : 'Beograd, Srbija' ?>">
<input type="hidden" id="control_input_country" value="<?= ($pl = $model->location) ? $pl->country : 'Srbija' ?>">
<input type="hidden" id="control_input_region" value="<?= ($pl = $model->location) ? $pl->district : 'Beograd' ?>">
<input type="hidden" id="control_input_city" value="<?= ($pl = $model->location) ? $pl->city : 'Beograd' ?>">
<input type="hidden" id="control_input_lat" value="<?= ($pl = $model->location) ? $pl->lat : 44.786568 ?>">
<input type="hidden" id="control_input_lng" value="<?= ($pl = $model->location) ? $pl->lng : 20.44892159999995 ?>">

<?php // HQ ?>
<?= $form->field($locationHQ, 'lat', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geohq'=>'lat', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc_hq_lat'])->label(false) ?>
<?= $form->field($locationHQ, 'lng', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geohq'=>'lng', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc_hq_lng'])->label(false) ?>
<?= $form->field($locationHQ, 'city', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geohq'=>'locality', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc_hq_city'])->label(false) ?>
<?= yii\helpers\Html::activeHiddenInput($locationHQ, 'id', ['value'=>($locationHQ) ? $locationHQ->id : null]) ?>  	
<?= yii\helpers\Html::activeHiddenInput($locationHQ, 'country', ['data-geohq'=>'country', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_country']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationHQ, 'state', ['data-geohq'=>'state', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_state']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationHQ, 'district', ['data-geohq'=>'sublocality', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_district']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationHQ, 'zip', ['data-geohq'=>'postal_code', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_zip']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationHQ, 'mz', ['data-geohq'=>'neighborhood', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_mz']) ?>    	
<?= yii\helpers\Html::activeHiddenInput($locationHQ, 'street', ['data-geohq'=>'route', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_street']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationHQ, 'location_name', ['data-geohq'=>'formatted_address', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_location_name']) ?>
