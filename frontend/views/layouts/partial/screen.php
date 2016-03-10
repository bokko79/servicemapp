<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
$session = Yii::$app->session;
?>
<div class="container" style="">
	<div class="content" style="">
	<?php if($session->get("state") && !$getService): ?>
		<h3 style="margin:0; text-align:center"><?= ($session->get("state")=='order') ? 'Izaberite uslugu koju želite da poručite' : 'Izaberite uslugu koju želite da ponudite' ?></h3>
		<hr>
	<?php endif; ?>
		<div class="service_autocomplete_search" style="">
			<?php $form = kartik\widgets\ActiveForm::begin([
				'action' => ['/services'],
	        	'method' => 'get',
			]); ?>
				<?= $form->field(new \frontend\models\CsServicesSearch, 'name', [				
					'options' => ['class'=>((!$getService) ? 'form-group-lg' : '')],
					'addon' => [
						//'prepend' => ['content'=>'Usluge'],
						'append' => [
				            'content' => Html::button('<i class="fa fa-search"></i>', ['class'=>'btn btn-default '.((!$getService) ? 'btn-lg' : '')]), 
				            'asButton' => true
				        ],
					]
				])->input('text', ['placeholder' => 'Pretražite usluge pomoću ključih reči...'])->label(false) ?>
			<?php ActiveForm::end(); ?>
		</div>
		<div class="links">
			Pretražite usluge pomoću: 
			<?= Html::a('Uslužnih delatnosti', null, ['class'=>((!$getService) ? 'industries-six-boxes-link' : 'industries-six-boxes-link-mini')]); ?>
			<?= Html::a('Predmeta usluga', null, ['class'=>'objects-six-boxes-link']); ?>
		</div>		
	</div>
</div>