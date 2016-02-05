<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
?>
<div class="industry_6box_container_back a">
	<div class="industry_6box_slider" style="">	
		<div class="featured" style="margin: 0 auto;">
			<table class="">
				<tr>
					<td class="control zoomInLeft animated">
						<h1><?= Html::a('<i class="fa fa-shopping-basket"></i>&nbsp;Naručite.', '#', array()); ?></h1>
						<p>Naručivanje usluga od registrovanih, profesionalnih pružalaca usluga. <a href="<?= Url::to('/info') ?>">Saznaj više.</a></p>
					</td>
					
					<td class="control zoomInDown animated">
						<h1><?= Html::a('<i class="fa fa-hand-spock-o"></i>&nbsp;Pružajte.', '#', array()); ?></h1>
						<p>Opišite usluge koje pružate, osvojite nove klijente i zaradite. <a href="<?= Url::to('/info') ?>">Saznaj više.</a></p>
					</td>
					<td class="control zoomInRight animated">
						<h1><?= Html::a('<i class="fa fa-bullhorn"></i>&nbsp;Promovišite.', '#', array()); ?></h1>
						<p>Unapredite poslovanje neodoljivim popustima i pogodnostima na usluge koje pružate. <a href="<?= Url::to('/info') ?>">Saznaj više.</a></p>
					</td>
				</tr>
			</table>			
		</div>
	</div>
</div><!-- <div class="row-fluid industry"> -->	

<div class="featured" style="margin: 0 auto; text-align:center;">
	<h2 style="margin: 20px 0 0; ">Izaberite usluge</h2>
	<hr>
	<?= Html::a('Index usluga', Url::to('/services'), array()); ?>
	
	<div class="service_autocomplete_search" style="width:60%;; margin:30px auto 0;">
		<?php $form = kartik\widgets\ActiveForm::begin([
			'action' => ['/services'],
        	'method' => 'get',
		]); ?>
			<?= $form->field(new \frontend\models\CsServicesSearch, 'name', [				
				'options' => ['placeholder' => 'Pretražite usluge pomoću ključih reči...',],
				'addon' => [
					'prepend' => ['content'=>'Usluge'],
					'append' => [
			            'content' => Html::button('Traži', ['class'=>'btn btn-primary']), 
			            'asButton' => true
			        ],
				]
			])->label(false) ?>
		<?php ActiveForm::end(); ?>
	</div>
</div>
