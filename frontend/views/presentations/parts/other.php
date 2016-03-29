<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Podesite prezentaciju.';
?>
<div class="wrapper headline" style="" id="other">
    <label class="head">
        <span class="badge"><?= $model->noOther ?></span>&nbsp;
        <i class="fa fa-cogs fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Ostala podešavanja') ?>
    </label>
    	<?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper notshown body fadeIn animated" style="border-top:none;" id="sections14">
    <?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <div class="form-group kv-fieldset-inline">
	    <?= Html::activeLabel($model, 'duration', [
	        'label'=>'Uobičajeno trajanje izvršenja usluge', 
	        'class'=>'col-sm-3 control-label'
	    ]); ?>
	    <div class="col-sm-2" style="padding-right:0">
	        <?= $form->field($model, 'duration_operator',[
	                'showLabels'=>false
	            ])->dropDownList(['exact'=>'tačno', 'approx'=>'oko', 'min'=>'najmanje', 'max'=>'najviše'], ['class'=>'input-lg']) ?>
	    </div>
	    <div class="col-sm-3" style="padding-right:0">
	        <?= $form->field($model, 'duration',[
	        		'addon' => [
	        			'prepend' => ['content'=>'<i class="fa fa-clock-o"></i>'],
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
		        ])->input('number', ['step'=>1, 'min'=>0, 'placeholder'=>'Trajanje', 'class'=>'input-lg']); ?>
	    </div>	
	    <div class="col-sm-2" style="padding-right:0">
	        <?= $form->field($model, 'duration_unit',[
	            	'showLabels'=>false
	        	])->dropDownList([ 26 => 'minut(a)', 26 => 'sat(i)', 26 => 'dan(a)', 27 => 'sedmica/e', 28 => 'meseci', 29 => 'godina', ], ['class'=>'input-lg']) ?>
	    </div>
	</div>
	<div class="form-group kv-fieldset-inline">
	    <?= Html::activeLabel($model, 'delivery_delay', [
	        'label'=>'Kašnjenje ispostave', 
	        'class'=>'col-sm-3 control-label'
	    ]); ?>
	    <div class="col-sm-3" style="padding-right:0">
	        <?= $form->field($model, 'delivery_delay',[
	        		'addon' => [
	        			'prepend' => ['content'=>'<i class="fa fa-clock-o"></i>'],
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
		        ])->input('number', ['step'=>1, 'min'=>0, 'placeholder'=>'Trajanje', 'class'=>'input-lg']); ?>
	    </div>	
	    <div class="col-sm-2" style="padding-right:0">
	        <?= $form->field($model, 'delivery_delay_unit',[
	            	'showLabels'=>false
	        	])->dropDownList([ 26 => 'minut(a)', 26 => 'sat(i)', 26 => 'dan(a)', 27 => 'sedmica/e', 28 => 'meseci', 29 => 'godina', ], ['class'=>'input-lg']) ?>
	    </div>
	</div>
<?= $this->render('_submitButton.php') ?>
</div>