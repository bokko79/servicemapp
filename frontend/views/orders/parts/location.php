<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Lokacija za izvršenje usluga.';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $model->getNoLocation() ?></span>&nbsp;
        <i class="fa fa-map-marker fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Gde?'); ?>
    </label>
    <i class="fa fa-chevron-<?= ($service->location!=1 && $service->location!=3) ? 'right' : 'down' ?> chevron"></i>
</div>

<div class="wrapper <?= ($service->location!=1 && $service->location!=3) ? 'notshown' : '' ?> body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php 
	if($service->location==1 or $service->location==3){
		if(!Yii::$app->user->isGuest) { 
			$user = \common\models\User::findOne(Yii::$app->user->id); ?>
			<?= $form->field($model, 'loc_id', [])->dropDownList(ArrayHelper::map($user->locations, 'id', 'location_name'), ['prompt'=>'Izaberite jednu od sačuvanih lokacija', 'class'=>'input-lg']) ?>
			<div class="form-group">
	            <div class="col-md-offset-3 col-md-9" style="">	                
	                <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
	                <div class="center" style="margin:30px 0 20px">
	                    <?= Html::a('<i class="fa fa-plus-circle"></i> Odredite novu lokaciju', null, ['class'=>'btn btn-default new_loc']) ?>
	                </div>
	            </div>
	        </div>
	
    <?php } ?>
    <?= yii\helpers\Html::activeHiddenInput($location, 'control', ['id'=>'checkLocation']) ?>
    <?= yii\helpers\Html::activeHiddenInput($location, 'userControl', ['id'=>'checkUserType']) ?>
    <div class="enter_location fadeIn animated" style="<?= (Yii::$app->user->isGuest) ? '' : 'display:none;' ?>">
	    <?= $form->field($location, 'name', [
		    	'addon' => ['prepend' => ['content'=>'<i class="fa fa-map-marker"></i>']],
				'feedbackIcon' => [
			        'success' => 'ok',
			        'error' => 'exclamation-sign',
			        'successOptions' => ['class'=>'text-primary'],
			        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
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
	    
		<input type="hidden" id="control_input_lat" value="<?= (isset($user)) ? $user->location->lat : 44.786568 ?>">
		<input type="hidden" id="control_input_lng" value="<?= (isset($user)) ? $user->location->lng : 20.44892159999995 ?>">
	</div>
<?php } ?>
<?php if($service->location==2 or $service->location==4): ?>
    <?= $form->field($model, 'loc_id2')->textInput(['maxlength' => true]) ?>
<?php endif; ?>
    


</div>