<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\widgets\TimePicker;
use kartik\datecontrol\DateControl;
use kartik\switchinput\SwitchInput;

$data = ['nonstop'=>'Non-stop', 'opening_hours'=>'U toku radnog vremena'];
if($service->service_type==9 or $service->service_type==10 or $service->service_type==11)$data['timetable'] = '<i class="fa fa-calendar-check-o"></i> Raspored';
$daysOfWeek = [1=>'Pon', 2=>'Uto', 3=>'Sre', 4=>'Čet', 5=>'Pet', 6=>'Sub', 7=>'Ned'];
$model->time_availability = 'nonstop';
$message = 'Kada pružate ovu uslugu. Ukoliko imate određeno radno vreme u okviru kojeg pružate ovu uslugu, podesite ga naknadno na svom profilu: Početna > Profil > Podešavanja.';
//echo '<pre>';
//print_r($provider_openingHours); die();
?>
<div class="wrapper headline" style="" id="availability">
    <label class="head">
        <span class="badge"><?= $model->noAvailability ?></span>&nbsp;
        <i class="fa fa-clock-o fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Kada ste dostupni') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections10">
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group">
		<?= $form->field($model, 'time_availability')->radioButtonGroup($data, ['class'=>'btn-group', 'itemOptions' => ['labelOptions' => ['class' => 'btn btn-info']]]) ?>
    </div>
<?php if($service->service_type==9 or $service->service_type==10 or $service->service_type==11): ?>
    <div class="enter_timetable fadeIn animated" style="margin-top:30px; display:none;">
	    <div class="form-group kv-fieldset-inline">
	        <?= Html::activeLabel($model_timetable, 'term', ['label'=>'Termin', 'class'=>'col-sm-3 control-label']) ?>
	        <div class="col-sm-2" style="padding-right:0">
	        <?= $form->field($model_timetable, 'day_of_week',[
	            	'showLabels'=>false
	        	])->dropDownList($daysOfWeek, ['class'=>'']) ?>
	        </div>
	        <div class="col-sm-2">
	            <?= $form->field($model_timetable, 'time_start', [
	            		'enableAjaxValidation' => false,
	                    'showLabels' => false,
	                ])->widget(DateControl::classname(), [
	                        'language' => 'rs-latin',
	                        'type' => 'time',
	                        'options'=> [
	                            'pluginOptions' => [                        
	                                'autoclose' => true,                    
	                            ],
	                        ],                                
	                ]) ?>
	        </div>
	        <div class="col-sm-3">
	            <?= $form->field($model_timetable, 'time_end', [
	            		'enableAjaxValidation' => false,
	                ])->widget(DateControl::classname(), [
	                        'language' => 'rs-latin',
	                        'type' => 'time',
	                        'options'=> [
	                            'pluginOptions' => [                        
	                                'autoclose' => true,
	                            ],
	                        ],                                
	                ]) ?>
	        </div>
	        <div class="col-sm-1">
	            
	        </div>
	    </div>	
	    <div class="form-group">
	    	<label class="control-label col-md-3" for="presentations-name">Termin</label>
		    <div class="col-sm-9">
			    <div class="input_timetable_syn_wrap" style="margin-bottom:10px;">
					<span class="add_timetable_syn_button center overflow-hidden"><?= Html::a('<i class="fa fa-plus-circle"></i> Dodaj novi termin', null, ['class'=>'btn btn-info shadow', 'style'=>'margin:10px 0']) ?></span>
				</div>
			</div>
	    </div>    
	</div>
<?php endif; ?>
	<div class="enter_openingHours fadeIn animated" style="margin-top:30px; display:none;">
	<?php if($user and $user->provider and $user->provider->openingHours): ?>
		<div class="col-sm-offset-3">
			<?// $this->render('//provider/_openingHours.php', ['provider_openingHours'=>$user->provider->openingHours,]) ?>	
		</div>	
		<div style="display:none">
	<?php endif; ?>
		<?// $this->render('//provider/_openingHoursForm.php', ['form'=>$form, 'provider_openingHours'=>$provider_openingHours,]) ?>
	<?php if($user and $user->provider and $user->provider->openingHours): ?>
		</div>
	<?php endif; ?>
	</div>
<?= $this->render('_submitButton.php') ?>
</div>