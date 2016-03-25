<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use frontend\models\CsCurrencies;
use kartik\switchinput\SwitchInput;

$message = 'Odredite cenu za uslugu koju pružate.';
//$model->fixed_price = 0;
?>
<div class="wrapper headline" style="" id="price">
    <label class="head">
        <span class="badge"><?= $model->noPrice ?></span>&nbsp;
        <i class="fa fa-dollar fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Cena...') ?>
    </label>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections07">
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group kv-fieldset-inline">
	    <?= Html::activeLabel($model, 'price', [
	        'label'=>'Cena usluge', 
	        'class'=>'col-sm-3 control-label'
	    ]); ?>
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
		        ])->input('number', ['placeholder'=>'Iznos', 'class'=>'input-lg']); ?>
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
	<input type="hidden" id="user_provision_value" value="<?= Yii::$app->user->isGuest ? 19 : Yii::$app->user->role ?>">
	<p class="hint col-sm-offset-3 margin-bottom-0 calculated_provision_price" style="display:none"><b><i class="fa fa-exclamation-triangle"></i> Važna napomena:</b> Na osnovu Vašeg članstva na servicemapp.com, provizija na naše usluge su <span class="provision"></span>.
	Saznajte više <?= Html::a('ovde', Url::to(), []) ?>.</p>
	<?php if(!$model->checkIfConsumer()): 
		//$model->consumer_price = 0; ?>
	<?= $form->field($model, 'consumer_price', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Pribor i oprema', ],
                ])->widget(SwitchInput::classname(), [
                    'containerOptions'=>['style'=>'margin-left:0;'],
                    'pluginOptions' => [
                        'onText' => 'Da',
                        'onColor' => 'info',
                        'offText' => 'Ne',
                        'size' => 'large',
                        'inlineLabel' => false,         
                    ]
                ])->hint('Da li je cena koju ste naveli iznad po osobi ili ukupna cena?') ?>
	<?php endif; ?>
	<?= $form->field($model, 'fixed_price', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Pribor i oprema', ],
                ])->widget(SwitchInput::classname(), [
                    'containerOptions'=>['style'=>'margin-left:0;'],
                    'pluginOptions' => [
                        'onText' => 'Da',
                        'onColor' => 'info',
                        'offText' => 'Ne',
                        'size' => 'large',
                        'inlineLabel' => false,         
                    ]
                ])->hint('Da li je cena fiksna ili je podložna promeni prilikom aukcije/dogovora sa potencijalnim klijentom?') ?>
	<h6 class="col-sm-offset-1 margin-top-20 gray-color">Korekcije cene i popusti</h6>
	<p class="hint-text col-sm-offset-1 margin-bottom-20">Podesite cenu izvršenja ove usluge, ukoliko ona zavisi od naručene količine ili broja korisnika.</p>
	<?php if($service->amount!=0): ?>
	<?= $form->field($model, 'qtyPriceConst', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Pribor i oprema', ],
                ])->widget(SwitchInput::classname(), [
                    'containerOptions'=>['style'=>'margin-left:0;'],
                    'pluginOptions' => [
                        'onText' => 'Da',
                        'onColor' => 'info',
                        'offText' => 'Ne',
                        'size' => 'large',
                        'inlineLabel' => false,         
                    ],
                ])->hint('Da li vaša cena zavisi od naručene količine za izvršenje usluge?') ?>

    <div class="quantity_constraints animated fadeIn" style="display:none;">
    	<div class="form-group kv-fieldset-inline">
		    <?= Html::activeLabel($model, 'qtyConstMin', [
		        'label'=>'Za porudžbine MANJE od', 
		        'class'=>'col-sm-3 control-label'
		    ]); ?>		    
		    <div class="col-sm-2" style="padding-right:0">
		        <?= $form->field($model, 'qtyMin',[
		        		'addon' => [
		        			'append' => ['content'=>$service->unit->oznaka],
		        			'groupOptions' => ['class'=>'input-group']],
						'hintType' => ActiveField::HINT_SPECIAL,
						'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			            'showLabels'=>false
			        ])->input('number', ['class'=>'']); ?>
		    </div>
		    <div class="col-sm-5" style="padding:0">
		        <?= $form->field($model, 'qtyMin_price',[
		        		'addon' => [
		        			'prepend' => ['content'=>'<i class="fa fa-money"></i>'],
		        			'append' => ['content'=>'<span class="currperunit"></span>'],
		        			'groupOptions' => ['class'=>'input-group']],
						'hintType' => ActiveField::HINT_SPECIAL,
						'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			            
			        ])->label('cena je')->input('number', ['min'=>0, 'placeholder'=>'Iznos', 'class'=>'']); ?>
		    </div>
		</div>
		<div class="form-group kv-fieldset-inline">
		    <?= Html::activeLabel($model, 'qtyConstMax', [
		        'label'=>'Za porudžbine VEĆE od', 
		        'class'=>'col-sm-3 control-label'
		    ]); ?>		    
		    <div class="col-sm-2" style="padding-right:0">
		        <?= $form->field($model, 'qtyMax',[
		        		'addon' => [
		        			'append' => ['content'=>$service->unit->oznaka],
		        			'groupOptions' => ['class'=>'input-group']],
						'hintType' => ActiveField::HINT_SPECIAL,
						'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			            'showLabels'=>false
			        ])->input('number', ['class'=>'']); ?>
		    </div>
		    <div class="col-sm-5" style="padding:0">
		        <?= $form->field($model, 'qtyMax_percent',[
		        		'addon' => [
		        			'append' => ['content'=>'<i class="fa fa-percent"></i>'],
		        			'groupOptions' => ['class'=>'input-group']],
						'hintType' => ActiveField::HINT_SPECIAL,
						'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],			            
			        ])->label('popust je')->input('number', ['min'=>0, 'max'=>100, 'placeholder'=>'Popust']); ?>
		    </div>
		</div>
    </div>
    <?php endif; ?>
    <?php if($service->consumer!=0): ?>
    <?= $form->field($model, 'consumerPriceConst', [
                'hintType' => ActiveField::HINT_SPECIAL,
                'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Pribor i oprema', ],
                ])->widget(SwitchInput::classname(), [
                    'containerOptions'=>['style'=>'margin-left:0;'],
                    'pluginOptions' => [
                        'onText' => 'Da',
                        'onColor' => 'info',
                        'offText' => 'Ne',
                        'size' => 'large',
                        'inlineLabel' => false,         
                    ]
                ])->hint('Da li vaša cena zavisi od broja korisnika?') ?>

    <div class="consumer_constraints animated fadeIn" style="display:none">
    	<div class="form-group kv-fieldset-inline">
		    <?= Html::activeLabel($model, 'consumerConstMin', [
		        'label'=>'Za manje od', 
		        'class'=>'col-sm-3 control-label'
		    ]); ?>		    
		    <div class="col-sm-2" style="padding-right:0">
		        <?= $form->field($model, 'consumerMin',[
		        		'addon' => [
		        			'append' => ['content'=>'<i class="fa fa-user"></i>'],
		        			'groupOptions' => ['class'=>'input-group']],
						'hintType' => ActiveField::HINT_SPECIAL,
						'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			            'showLabels'=>false
			        ])->input('number', ['class'=>'']); ?>
		    </div>
		    <div class="col-sm-5" style="padding:0">
		        <?= $form->field($model, 'consumerMin_price',[
		        		'addon' => [
		        			'prepend' => ['content'=>'<i class="fa fa-money"></i>'],
		        			'append' => ['content'=>'<span class="currperunit"></span>'],
		        			'groupOptions' => ['class'=>'input-group']],
						'hintType' => ActiveField::HINT_SPECIAL,
						'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			            
			        ])->label('cena je')->input('number', ['min'=>0, 'placeholder'=>'Iznos', 'class'=>'']); ?>
		    </div>
		</div>
		<div class="form-group kv-fieldset-inline">
		    <?= Html::activeLabel($model, 'consumerConstMax', [
		        'label'=>'Za više od', 
		        'class'=>'col-sm-3 control-label'
		    ]); ?>		    
		    <div class="col-sm-2" style="padding-right:0">
		        <?= $form->field($model, 'consumerMax',[
		        		'addon' => [
		        			'append' => ['content'=>'<i class="fa fa-user"></i>'],
		        			'groupOptions' => ['class'=>'input-group']],
						'hintType' => ActiveField::HINT_SPECIAL,
						'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
			            'showLabels'=>false
			        ])->input('number', ['class'=>'']); ?>
		    </div>
		    <div class="col-sm-5" style="padding:0">
		        <?= $form->field($model, 'consumerMax_percent',[
		        		'addon' => [
		        			'append' => ['content'=>'<i class="fa fa-percent"></i>'],
		        			'groupOptions' => ['class'=>'input-group']],
						'hintType' => ActiveField::HINT_SPECIAL,
						'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],			            
			        ])->label('popust je')->input('number', ['min'=>0, 'max'=>100, 'placeholder'=>'Popust']); ?>
		    </div>
		</div>
    </div>
	<?php endif; ?>
<?= $this->render('_submitButton.php') ?>
</div>