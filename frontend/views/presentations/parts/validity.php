<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\widgets\DatePicker;
use kartik\datecontrol\DateControl;

$data = ['yes'=>'<i class="fa fa-calendar-check-o"></i> Trajno', 'limited'=>'<i class="fa fa-calendar"></i> Određeni datumi', 'no'=>'<i class="fa fa-calendar-times-o"></i> Ne važi'];
$model->validity = 'yes';
$message = 'Kada pružate ovu uslugu. Ukoliko imate određeno radno vreme u okviru kojeg pružate ovu uslugu, podesite ga naknadno na svom profilu: Početna > Profil > Podešavanja.';
?>
<div class="wrapper headline" style="" id="validity">
    <label class="head">
        <span class="badge"><?= $model->noValidity ?></span>&nbsp;
        <i class="fa fa-calendar fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Kada važi ova ponuda') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections11">
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group">
		<?= $form->field($model, 'validity')->radioButtonGroup($data, ['class'=>'btn-group', 'itemOptions' => ['labelOptions' => ['class' => 'btn btn-info']]]) ?>
    </div>
    <div class="enter_dates fadeIn animated" style="margin-top:30px; display:none;">
	    <div class="form-group kv-fieldset-inline">
	        <?= Html::activeLabel($model, 'valid_from', ['label'=>'Usluga dostupna od', 'class'=>'col-sm-3 control-label']) ?>
	        <div class="col-sm-5">
	            <?= $form->field($model, 'valid_from', [
	            		'enableAjaxValidation' => false,
	                    'showLabels' => false,
	                    'feedbackIcon' => [
	                        'success' => 'ok',
	                        'error' => 'exclamation-sign',
	                        'successOptions' => ['class'=>'text-primary'],
	                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
	                    ],
	                ])->widget(DateControl::classname(), [
	                        'language' => 'rs-latin',
	                        'type' => 'date',
	                        'options'=> [
	                            'type'=>2,
	                            'size' => 'lg',
	                            'pickerButton'=>['title'=>'Izaberite datum'],
	                            'removeButton'=>['title'=>'Poništite'],
	                            'pluginOptions' => [                        
	                                'autoclose' => true,
	                                'todayHighlight' => true,
	                                'startDate'=>date('Y-m-d H:i:s'),                      
	                            ],
	                        ],                                
	                ]) ?>
	        </div>
	    </div>
	    <div class="form-group kv-fieldset-inline">
	        <?= Html::activeLabel($model, 'valid_through', ['label'=>'Usluga dostupna do', 'class'=>'col-sm-3 control-label']) ?>
	        <div class="col-sm-5">
	            <?= $form->field($model, 'valid_through', [
	                    'showLabels' => false,
	                    'feedbackIcon' => [
	                        'success' => 'ok',
	                        'error' => 'exclamation-sign',
	                        'successOptions' => ['class'=>'text-primary'],
	                        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
	                    ],
	                ])->widget(DateControl::classname(), [
	                        'language' => 'rs-latin',
	                        'type' => 'date',
	                        'options'=> [
	                            'type'=>2,
	                            'size' => 'lg',
	                            'pickerButton'=>['title'=>'Izaberite datum'],
	                            'removeButton'=>['title'=>'Poništite'],
	                            'pluginOptions' => [                        
	                                'autoclose' => true,
	                                'todayHighlight' => true,
	                                'startDate'=>date('Y-m-d H:i:s'),                      
	                            ],
	                        ],                                
	                ]) ?>
	        </div>
	    </div>
	</div>
<?= $this->render('_submitButton.php') ?>
</div>