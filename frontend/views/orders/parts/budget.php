<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use frontend\models\CsCurrencies;

?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-money fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Budžet'); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
    <div class="form-group kv-fieldset-inline">
	    <?= Html::activeLabel($model, 'budget', [
	        'label'=>'Moj budžet za ovu porudžbinu', 
	        'class'=>'col-sm-3 control-label'
	    ]); ?>
	    <div class="col-sm-2" style="padding-right:0">
	    	<?= $form->field($model, 'budget_operator',[
		            'showLabels'=>false
		        ])->dropDownList(['exact'=>'tačno', 'approx'=>'oko', 'min'=>'najmanje', 'max'=>'najviše'], ['class'=>'input-lg']) ?>
	    </div>
	    <div class="col-sm-3" style="padding-right:0">
	        <?= $form->field($model, 'budget',[
	        		'addon' => [
	        			'prepend' => ['content'=>'<i class="fa fa-money"></i>'],
	        			'groupOptions' => ['class'=>'input-group-lg']],
					'feedbackIcon' => [
				        'success' => 'ok',
				        'error' => 'exclamation-sign',
				        'successOptions' => ['class'=>'text-primary'],
				        'errorOptions' => ['class'=>'text-primary']
				    ],
					'hintType' => ActiveField::HINT_SPECIAL,
					'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		            'showLabels'=>false
		        ])->input('number', ['min'=>0, 'placeholder'=>'To Date', 'class'=>'input-lg']); ?>
	    </div>	    
	    <div class="col-sm-2" style="padding-right:0">
	        <?= $form->field($model, 'currency_id',[
	            	'showLabels'=>false
	        	])->dropDownList(ArrayHelper::map(CsCurrencies::find()->all(), 'id', 'code'), ['class'=>'input-lg']) ?>
	    </div>
	</div>
</div>