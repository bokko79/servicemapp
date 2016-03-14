<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Lokacija za izvršenje usluga.';
?>
<div class="wrapper headline" style="" id="locations">
    <label class="head">
        <span class="badge"><?= $model->noLocation ?></span>&nbsp;
        <i class="fa fa-map-marker fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Gde?'); ?>
    </label>
    <i class="fa fa-chevron-down chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;" onclick="initialize_pres_loc()" id="sections06">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php 
	if($service->location!=0){
		if(!Yii::$app->user->isGuest) { 
			$user = \frontend\models\User::findOne(Yii::$app->user->id); ?>
			<?= $form->field($model, 'loc_id', [])->dropDownList(ArrayHelper::map($user->provider->locations, 'loc_id', 'locationName'), ['prompt'=>'Izaberite jednu od sačuvanih lokacija', 'class'=>'input-lg']) ?>
			<div class="form-group">
	            <div class="col-md-offset-3 col-md-9" style="">	                
	                <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
	                <div class="center" style="margin:30px 0 20px">
	                    <?= Html::a('<i class="fa fa-plus-circle"></i> Odredite novu lokaciju', null, ['class'=>'btn btn-default btn-lg shadow new_loc_pres', 'style'=>'width:100%;']) ?>
	                </div>
	            </div>
	        </div>
	
    <?php } ?>
    <?= yii\helpers\Html::activeHiddenInput($location, 'control', ['id'=>'checkLocationTypePres']) ?>
    <?= yii\helpers\Html::activeHiddenInput($location, 'userControl', ['id'=>'checkUserTypePres']) ?>
    <div class="enter_location fadeIn animated" style="<?= (Yii::$app->user->isGuest) ? '' : 'display:none;' ?>">
	    <?= $form->field($location, 'name', [
		    	'addon' => ['prepend' => ['content'=>'<i class="fa fa-map-marker"></i>']],
				'feedbackIcon' => [
			        'success' => 'ok',
			        'error' => 'exclamation-sign',
			        'successOptions' => ['class'=>'text-primary'],
			        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
			    ],
		    ])->input([], ['id'=>'presentation-location']) ?>

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
	    
		<input type="hidden" id="control_input_lat" value="<?= (isset($user)) ? $user->location->lat : 44.786568 ?>">
		<input type="hidden" id="control_input_lng" value="<?= (isset($user)) ? $user->location->lng : 20.44892159999995 ?>">
	</div>
	<div class="form-group kv-fieldset-inline">
        <?= Html::activeLabel($model, 'loc_within', [
            //'label'=>'Broj korisnika', 
            'class'=>'col-sm-3 control-label'
        ]); ?>
        <div class="col-sm-4" style="padding-right:0">
            <?= $form->field($model, 'loc_within', [
				    	'addon' => ['prepend' => ['content'=>'<i class="fa fa-crosshairs"></i>']],
						'feedbackIcon' => [
					        'success' => 'ok',
					        'error' => 'exclamation-sign',
					        'successOptions' => ['class'=>'text-primary'],
					        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
					    ],
				    ])->input('number', ['class'=>'input-lg', 'step'=>10, 'min'=>0])->label(false) ?>
        </div>
    </div>			
<?php } ?>
</div>