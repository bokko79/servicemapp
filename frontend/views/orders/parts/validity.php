<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\datecontrol\DateControl;

$message = 'Do kada Vam pružaoci usluga mogu slati ponude za ovu porudžbinu? Slanjem porudžbine, Vi otvarate aukciju u kojoj mogu da učestvuju svi pružaoci usluga na taj način što će Vam slati svoje ponude za izvršenje Vaše tražene usluge.';
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
	<?= $this->render('../_hint.php', ['message'=>$message]) ?>
	<div class="form-group">
	    <?= Html::activeLabel($model, 'validity', ['label'=>'Rok za slanje ponuda', 'class'=>'col-sm-3 control-label']) ?>
	    <div class="col-sm-5">
	        <?= $form->field($model, 'validity', [
	        				'showLabels'=>false,
	        				'feedbackIcon' => [
	                            'success' => 'ok',
	                            'error' => 'exclamation-sign',
	                            'successOptions' => ['class'=>'text-primary'],
	                            'errorOptions' => ['class'=>'text-primary']
	                        ],
		    			])->widget(DateControl::classname(), [
                            'language' => 'sr-Ln',
                            'type' => 'datetime',
                            'options'=> [
                                'type'=>2,
                                'size' => 'lg',
                                'pickerButton'=>['title'=>'Izaberite datum i vreme'],
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