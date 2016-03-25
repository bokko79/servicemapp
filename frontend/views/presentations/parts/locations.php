<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\field\FieldRange;

$message = 'Vaše sedište i područje na kojem vršite '.$service->tName.'.';
?>
<div class="wrapper headline" style="" id="locations">
    <label class="head">
        <span class="badge"><?= $model->noLocation ?></span>&nbsp;
        <i class="fa fa-map-marker fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Lokacija i pokrivenost'); ?>
    </label>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections06">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php 
	if($proLocations = $model->hasProviderLocations()) { ?>		
		<?php // $form->field($model, 'loc_id', [])->dropDownList(ArrayHelper::map($proLocations, 'loc_id', 'locationName'), ['prompt'=>'Izaberite jednu od Vaših sačuvanih lokacija', 'class'=>'input-lg']) ?>
        <div class="form-group kv-fieldset-inline">
		    <?= Html::activeLabel($model, 'price', [
		        'label'=>count($proLocations)>1 ? 'Vaša sedišta' : 'Vaše sedište', 
		        'class'=>'col-sm-3 control-label'
		    ]); ?>
		    <div class="col-sm-5" style="padding-right:0">
			<?php foreach ($proLocations as $proLocation): ?>
        		<?php $model->location_hq = $proLocation->locationName; ?>	            	
		        <?= $form->field($model, 'location_hq', [
		        	'showLabels' =>false,
					'hintType' => ActiveField::HINT_SPECIAL,
					'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
				    ])->staticInput([])->hint('Možete detaljno podešavati lokacije Vaših sedišta u <code>Podešavanja > Lokacije</code>.') ?>
			<?php endforeach; ?>
		    </div>
		    <div class="right margin-bottom-20 margin-right-20" style="padding-right:0">
		    	<?= Html::a('<i class="fa fa-cog"></i> Podesite Vaše sedište', null, ['class'=>'btn btn-info btn-sm shadow new_loc_pres', 'style'=>'']) ?>
		    </div> 
		</div>		
<?php } ?>    
    <div class="enter_location fadeIn animated" style="<?= (!$model->hasProviderLocations()) ? '' : 'display:none;' ?> margin-top:0">
	<?php if($service->location==2): ?>
		<div class="form-group kv-fieldset-inline">
		    <?= Html::activeLabel($model, 'location_from', [
		        'label'=>'Start-destinacija', 
		        'class'=>'col-sm-3 control-label'
		    ]); ?>
		    <div class="col-sm-4" style="padding-right:0">
		        <?= $form->field($model, 'location_from', [
			    	'addon' => [
			    		'prepend' => ['content'=>'<i class="fa fa-map-marker"></i>'],		    		
			    	],
					'feedbackIcon' => [
				        'success' => 'ok',
				        'error' => 'exclamation-sign',
				        'successOptions' => ['class'=>'text-primary'],
				        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
				    ],
				    'showLabels'=>false
			    ])->input([], ['id'=>'presentation-location', 'placeholder'=>'Unesite startnu lokaciju']) ?>
		    </div>
		    <div class="float-left" style="padding:0 0 0 10px;">
		    	<?= Html::a('do', null, ['class'=>'btn btn-info']) ?>
		    </div>
		    <div class="col-sm-4" style="padding-right:0">
		        <?= $form->field($model, 'location_to', [
			    	'addon' => [
			    		'prepend' => ['content'=>'<i class="fa fa-map-marker"></i>'],		    		
			    	],
					'feedbackIcon' => [
				        'success' => 'ok',
				        'error' => 'exclamation-sign',
				        'successOptions' => ['class'=>'text-primary'],
				        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
				    ],
				    'showLabels'=>false
			    ])->input([], ['id'=>'presentation-location2', 'placeholder'=>'Unesite destinaciju']) ?>
		    </div> 
		</div>	
	<?php else: ?>	
		<?php $model->location_input = $model->hasProviderLocations() ? $model->hasProviderLocations()[0]->loc->location_name : null; ?>
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
		    ])->input([], ['id'=>'presentation-location']) ?>	
	<?php endif; ?>		
		<div class="col-md-3">
			<p class="hint right">Ovde ide tekst, koji služi kao objašnjenje za unos lokacije korisnika. Povlačenje markera, bla bla bla.</p>
		</div>
	    <div id="my_map" class="col-md-9" style="height:360px; margin-bottom:20px;"></div>
	    <div id="output" class="col-md-9 col-md-offset-3" style=""></div>
	</div>	
	
	<?php if($service->service_type!=5 or $service->location!=5): ?>
		<div class="location_operational_plaza fadeIn animated" style="display:<?= $model->hasProviderLocations() ? '' : 'none' ?>;">
		<?php $model->coverage = $service->coverage; ?>
		<?= $form->field($model, 'coverage', [
			'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		    ])->radioList($model->locationOperatingModels())->hint('Pokrivenost') ?>
		</div>
	<?php endif; ?>
<?= $this->render('_submitButton.php') ?>
</div>
<?= $this->render('_hiddenLocation.php', ['form'=>$form, 'location'=>$location, 'model' => $model]) ?>