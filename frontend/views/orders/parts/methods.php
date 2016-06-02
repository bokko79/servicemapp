<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\switchinput\SwitchInput;

$action = $service->action;

$message = Yii::t('app', 'Kakve opcije {action} Vam trebaju?', ['action'=>$service->tNameGen]);
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $model->noMethods ?></span>&nbsp;
        <i class="fa fa-magic fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Opcije {action}', ['action'=>$service->tNameGen]) ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
<?php foreach($model_methods as $model_method) {
		$method = $model_method->serviceMethod;
		$property = $model_method->property;
		$serviceMethod = $method->serviceMethod($service->id);
		echo ($serviceMethod and $serviceMethod->readOnly==0) ? $this->render('method/'.$property->formType($object_ownership).'.php', ['form'=>$form, 'key'=>$property->id, 'model_method'=>$model_method, 'method'=>$method, 'property'=>$property, 'service'=>$service]) : null;
	}
	if($service->shipping==1){ 
		$model->shipping = 1; ?>
		<?= $form->field($model, 'shipping', [
			'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		    ])->widget(SwitchInput::classname(), [
		    	'value'=>true,
		    	'containerOptions'=>['style'=>'margin-left:0;'],
			    'pluginOptions' => [
			        'onText' => 'Da',
			        'onColor' => 'info',
			        'offText' => 'Ne',
			        'size' => 'large',
			        'inlineLabel' => false,	        
			    ]
		    ])->label('Dostava na adresu?')->hint('Ukoliko želite da opisani '.$service->object->tName.' bude i isporučen na Vašu željenu adresu, izaberite ovu opciju.') ?>
<?php } 
	if($service->installation==1){ 
		$model->installation = 1; ?>
		<?= $form->field($model, 'installation', [
			'hintType' => ActiveField::HINT_SPECIAL,
			'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
		    ])->widget(SwitchInput::classname(), [
		    	'value'=>true,
		    	'containerOptions'=>['style'=>'margin-left:0;'],
			    'pluginOptions' => [
			        'onText' => 'Da',
			        'onColor' => 'info',
			        'offText' => 'Ne',
			        'size' => 'large',
			        'inlineLabel' => false,	        
			    ]
		    ])->label('Ugradnja?')->hint('Ukoliko želite da Vam pružalac usluge/prodavac opisani '.$service->object->tName.' i ugradi, montira odnosno instalira, izaberite ovu opciju.') ?>
<?php }?>    
</div>