<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">1</span>&nbsp;
        <i class="fa fa-map-marker fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Gde?'); ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;">
	<p class="hint-text">Lokacija za izvršenje usluga.</p>
<?php 
	if($service->location==1){
		if(!Yii::$app->user->isGuest) { 
			$user = \frontend\models\User::findOne(Yii::$app->user->id); ?>
			<?= $form->field($model, 'loc_id', [])->dropDownList(ArrayHelper::map($user->locations, 'id', 'location_name'), ['prompt'=>'Izaberite jednu od sačuvanih lokacija', 'class'=>'input-lg']) ?>
			<div class="right">
			<?= Html::a('Nova lokacija', null, ['class'=>'btn btn-default new_loc']) ?>
			</div>
	<?php
		}
	} ?>
    
    <div class="enter_location fadeIn animated" style="<?= (Yii::$app->user->isGuest) ? '' : 'display:none;' ?>">
	    <?= $form->field($location, 'name', [
		    	'addon' => ['prepend' => ['content'=>'<i class="fa fa-map-marker"></i>']],
				'feedbackIcon' => [
			        'success' => 'ok',
			        'error' => 'exclamation-sign',
			        'successOptions' => ['class'=>'text-primary'],
			        'errorOptions' => ['class'=>'text-primary']
			    ],
		    ])->input([], []) ?>

		<div class="col-md-3">
			<p class="hint right">Ovde ide tekst, koji služi kao objašnjenje za unos lokacije korisnika. Povlačenje markera, bla bla bla.</p>
		</div>
	    <div id="my_map" class="col-md-9" style="height:360px; margin-bottom:20px;"></div>
		<?= yii\helpers\Html::activeHiddenInput($location, 'lat', ['data-geo'=>'lat', 'id'=>'hidden-geo-input']) ?>
		<?= yii\helpers\Html::activeHiddenInput($location, 'lng', ['data-geo'=>'lng', 'id'=>'hidden-geo-input']) ?>     	
		<?= yii\helpers\Html::activeHiddenInput($location, 'country', ['data-geo'=>'country', 'id'=>'hidden-geo-input']) ?>
		<?= yii\helpers\Html::activeHiddenInput($location, 'state', ['data-geo'=>'state', 'id'=>'hidden-geo-input']) ?>
		<?= yii\helpers\Html::activeHiddenInput($location, 'district', ['data-geo'=>'sublocality', 'id'=>'hidden-geo-input']) ?>
		<?= yii\helpers\Html::activeHiddenInput($location, 'city', ['data-geo'=>'locality', 'id'=>'hidden-geo-input']) ?>
		<?= yii\helpers\Html::activeHiddenInput($location, 'zip', ['data-geo'=>'postal_code', 'id'=>'hidden-geo-input']) ?>
		<?= yii\helpers\Html::activeHiddenInput($location, 'mz', ['data-geo'=>'neighborhood', 'id'=>'hidden-geo-input']) ?>    	
		<?= yii\helpers\Html::activeHiddenInput($location, 'street', ['data-geo'=>'route', 'id'=>'hidden-geo-input']) ?>
		<?= yii\helpers\Html::activeHiddenInput($location, 'no', ['data-geo'=>'street_number', 'id'=>'hidden-geo-input']) ?>
		<?= yii\helpers\Html::activeHiddenInput($location, 'location_name', ['data-geo'=>'formatted_address', 'id'=>'hidden-geo-input']) ?>
	    
		<input type="hidden" id="control_input_lat" value="<?= $user->location->lat ?>">
		<input type="hidden" id="control_input_lng" value="<?= $user->location->lng ?>">
	</div>

<?php if($service->location==4): ?>
    <?= $form->field($model, 'loc_id2')->textInput(['maxlength' => true]) ?>
<?php endif; ?>
    


</div>