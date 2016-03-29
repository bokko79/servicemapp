<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>    
<input type="hidden" id="control_input_locationName" value="<?= ($pl = $model->hasProviderLocation()) ? $pl->location_name : 'Beograd, Srbija' ?>">
<input type="hidden" id="control_input_country" value="<?= ($pl = $model->hasProviderLocation()) ? $pl->country : 'Srbija' ?>">
<input type="hidden" id="control_input_region" value="<?= ($pl = $model->hasProviderLocation()) ? $pl->district : 'Beograd' ?>">
<input type="hidden" id="control_input_city" value="<?= ($pl = $model->hasProviderLocation()) ? $pl->city : 'Beograd' ?>">
<input type="hidden" id="control_input_lat" value="<?= ($pl = $model->hasProviderLocation()) ? $pl->lat : 44.786568 ?>">
<input type="hidden" id="control_input_lng" value="<?= ($pl = $model->hasProviderLocation()) ? $pl->lng : 20.44892159999995 ?>">
<?= yii\helpers\Html::activeHiddenInput($model, 'coverage_within', ['id'=>'hidden-geo-input', 'class'=>'location_within_input']) ?>

<?php // HQ ?>
<?= yii\helpers\Html::activeHiddenInput($model, 'location_control', ['id'=>'checkLocationTypePres']) ?>
<?= yii\helpers\Html::activeHiddenInput($model, 'location_userControl', ['id'=>'checkUserTypePres']) ?>

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


<?php // LOCATION FROM ?>
<?= $form->field($locationPresentation, 'lat', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geo'=>'lat', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc_lat'])->label(false) ?>
<?= $form->field($locationPresentation, 'lng', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geo'=>'lng', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc_lng'])->label(false) ?>
<?= $form->field($locationPresentation, 'city', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geo'=>'locality', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc_city'])->label(false) ?>
	
<?= yii\helpers\Html::activeHiddenInput($locationPresentation, 'country', ['data-geo'=>'country', 'id'=>'hidden-geo-input', 'class'=>'loc_country']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentation, 'state', ['data-geo'=>'state', 'id'=>'hidden-geo-input', 'class'=>'loc_state']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentation, 'district', ['data-geo'=>'sublocality', 'id'=>'hidden-geo-input', 'class'=>'loc_district']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentation, 'zip', ['data-geo'=>'postal_code', 'id'=>'hidden-geo-input', 'class'=>'loc_zip']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentation, 'mz', ['data-geo'=>'neighborhood', 'id'=>'hidden-geo-input', 'class'=>'loc_mz']) ?>    	
<?= yii\helpers\Html::activeHiddenInput($locationPresentation, 'street', ['data-geo'=>'route', 'id'=>'hidden-geo-input', 'class'=>'loc_street']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentation, 'location_name', ['data-geo'=>'formatted_address', 'id'=>'hidden-geo-input', 'class'=>'loc_location_name']) ?>

<?php if($service->location==2): ?>
<?php // LOCATION TO ?>
<?= $form->field($locationPresentationTo, 'lat', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geo2'=>'lat', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc2_lat'])->label(false) ?>
<?= $form->field($locationPresentationTo, 'lng', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geo2'=>'lng', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc2_lng'])->label(false) ?>
<?= $form->field($locationPresentationTo, 'city', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geo2'=>'locality', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;', 'class'=>'loc2_city'])->label(false) ?>    	
<?= yii\helpers\Html::activeHiddenInput($locationPresentationTo, 'country', ['data-geo2'=>'country', 'id'=>'hidden-geo-input', 'class'=>'loc2_country']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentationTo, 'state', ['data-geo2'=>'state', 'id'=>'hidden-geo-input', 'class'=>'loc2_state']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentationTo, 'district', ['data-geo2'=>'sublocality', 'id'=>'hidden-geo-input', 'class'=>'loc2_district']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentationTo, 'zip', ['data-geo2'=>'postal_code', 'id'=>'hidden-geo-input', 'class'=>'loc2_zip']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentationTo, 'mz', ['data-geo2'=>'neighborhood', 'id'=>'hidden-geo-input', 'class'=>'loc2_mz']) ?>    	
<?= yii\helpers\Html::activeHiddenInput($locationPresentationTo, 'street', ['data-geo2'=>'route', 'id'=>'hidden-geo-input', 'class'=>'loc_hq_street']) ?>
<?= yii\helpers\Html::activeHiddenInput($locationPresentationTo, 'location_name', ['data-geo2'=>'formatted_address', 'id'=>'hidden-geo-input', 'class'=>'loc2_location_name']) ?>
<?php endif; ?>