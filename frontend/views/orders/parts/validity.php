<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
$formatter = \Yii::$app->formatter;
$time7 = Yii::$app->formatter->asDate(date('Y-m-d H:i:s', strtotime('+7 days')), "php:d-M-Y H:i");
$model->validity = $time7;
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $no ?></span>&nbsp;
        <i class="fa fa-hourglass-1 fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Rok za slanje ponuda'); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
	<p class="hint-text">Do kada Vam pružaoci usluga mogu slati ponude za ovu porudžbinu? Slanjem porudžbine, Vi otvarate aukciju u kojoj mogu da učestvuju svi pružaoci usluga na taj način što će Vam slati svoje ponude za izvršenje Vaše tražene usluge.</p>  
	<div class="form-group">
	    <?= Html::activeLabel($model, 'validity', ['label'=>'Rok za slanje ponuda', 'class'=>'col-sm-3 control-label']) ?>
	    <div class="col-sm-5">
	        <?= $form->field($model, 'validity', [
	        				'showLabels'=>false,
		    			])->widget(DateTimePicker::classname(), [
							'options' => ['class'=>'input-lg'],
		                    'language' => 'sr-Ln',
		                    'size' => 'lg',
							'pluginOptions' => [                        
								'autoclose' => true,
								'todayHighlight' => true,
								//'todayBtn' => true,
								'format' => 'd-M-yyyy h:ii',						
							]
						]) ?>
		</div>
	</div>
</div>