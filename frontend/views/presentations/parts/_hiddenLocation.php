<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>
<?= yii\helpers\Html::activeHiddenInput($location, 'control', ['id'=>'checkLocationTypePres']) ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'userControl', ['id'=>'checkUserTypePres']) ?>

<?= $form->field($location, 'lat', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geo'=>'lat', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;'])->label(false) ?>
<?= $form->field($location, 'city', ['options'=>['style'=>'height:0;']])->hiddenInput(['data-geo'=>'locality', 'id'=>'hidden-geo-input', 'style'=>'margin:0;padding:0;'])->label(false) ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'lng', ['data-geo'=>'lng', 'id'=>'hidden-geo-input']) ?>     	
<?= yii\helpers\Html::activeHiddenInput($location, 'country', ['data-geo'=>'country', 'id'=>'hidden-geo-input']) ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'state', ['data-geo'=>'state', 'id'=>'hidden-geo-input']) ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'district', ['data-geo'=>'sublocality', 'id'=>'hidden-geo-input']) ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'zip', ['data-geo'=>'postal_code', 'id'=>'hidden-geo-input']) ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'mz', ['data-geo'=>'neighborhood', 'id'=>'hidden-geo-input']) ?>    	
<?php // yii\helpers\Html::activeHiddenInput($location, 'street', ['data-geo'=>'route', 'id'=>'hidden-geo-input']) ?>
<?= yii\helpers\Html::activeHiddenInput($location, 'location_name', ['data-geo'=>'formatted_address', 'id'=>'hidden-geo-input']) ?>
    
<input type="hidden" id="control_input_locationName" value="<?= ($pl = $model->hasProviderLocations()) ? $pl[0]->loc->location_name : 'Beograd, Srbija' ?>">
<input type="hidden" id="control_input_country" value="<?= ($pl = $model->hasProviderLocations()) ? $pl[0]->loc->country : 'Srbija' ?>">
<input type="hidden" id="control_input_region" value="<?= ($pl = $model->hasProviderLocations()) ? $pl[0]->loc->district : 'Beograd' ?>">
<input type="hidden" id="control_input_city" value="<?= ($pl = $model->hasProviderLocations()) ? $pl[0]->loc->city : 'Beograd' ?>">
<input type="hidden" id="control_input_lat" value="<?= ($pl = $model->hasProviderLocations()) ? $pl[0]->loc->lat : 44.786568 ?>">
<input type="hidden" id="control_input_lng" value="<?= ($pl = $model->hasProviderLocations()) ? $pl[0]->loc->lng : 20.44892159999995 ?>">
<?= yii\helpers\Html::activeHiddenInput($model, 'coverage_within', ['id'=>'hidden-geo-input', 'class'=>'location_within_input']) ?>