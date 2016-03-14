<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use frontend\models\CsCurrencies;

$message = 'Odredite cenu za uslugu koju pružate.';
$model->fixed_price = 0;
?>
<div class="wrapper headline" style="" id="price">
    <label class="head">
        <span class="badge"><?= $model->noPrice ?></span>&nbsp;
        <i class="fa fa-credit-card fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Cena...') ?>
    </label>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections09">
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group kv-fieldset-inline">
	    <?= Html::activeLabel($model, 'price', [
	        'label'=>'Cena usluge', 
	        'class'=>'col-sm-3 control-label'
	    ]); ?>
	    <?php /*
	    <div class="col-sm-2" style="padding-right:0">
	    	<=? $form->field($model, 'price_operator',[
		            'showLabels'=>false
		        ])->dropDownList(['exact'=>'tačno', 'approx'=>'oko', 'min'=>'najmanje', 'max'=>'najviše'], ['class'=>'input-lg']) ?>
	    </div> */ ?>
	    <div class="col-sm-3" style="padding-right:0">
	        <?= $form->field($model, 'price',[
	        		'addon' => [
	        			'prepend' => ['content'=>'<i class="fa fa-money"></i>'],
	        			'groupOptions' => ['class'=>'input-group-lg']],
					'feedbackIcon' => [
				        'success' => 'ok',
				        'error' => 'exclamation-sign',
				        'successOptions' => ['class'=>'text-primary'],
				        'errorOptions' => ['class'=>'text-primary', 'style'=>'top: 6px;']
				    ],
					'hintType' => ActiveField::HINT_SPECIAL,
					'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		            'showLabels'=>false
		        ])->input('number', ['min'=>0, 'step'=>10, 'placeholder'=>'Iznos', 'class'=>'input-lg']); ?>
	    </div>	    
	    <div class="col-sm-2" style="padding-right:0">
	        <?= $form->field($model, 'currency_id',[
	            	'showLabels'=>false
	        	])->dropDownList(ArrayHelper::map(CsCurrencies::find()->all(), 'id', 'code'), ['class'=>'input-lg']) ?>
	    </div>
	    <div class="col-sm-2" style="padding-right:0">
	        <?= $form->field($model, 'price_per',[
	            	'showLabels'=>false
	        	])->dropDownList(['total'=>'ukupno', 'per_unit'=>'/'.$service->unit->oznaka], ['class'=>'input-lg']) ?>
	    </div>
	</div>
	<?php if(!$model->checkIfConsumer()): 
		$model->consumer_price = 0; ?>
	<?= $form->field($model, 'consumer_price', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioButtonGroup([0=>'Ukupna cena', 1=>'Cena po osobi'], [
							    'class' => 'btn-group btn-group-justified',
							    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default btn-sm']]
							]) ?>
	<?php endif; ?>
	<?= $form->field($model, 'fixed_price', [
		'hintType' => ActiveField::HINT_SPECIAL,
		'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
	    ])->radioButtonGroup([0=>'Fiksna cena', 1=>'Cena podložna promeni'], [
							    'class' => 'btn-group btn-group-justified',
							    'itemOptions' => ['labelOptions' => ['class' => 'btn btn-default btn-sm']]
							]) ?>
</div>