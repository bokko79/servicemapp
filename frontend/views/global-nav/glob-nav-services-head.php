<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use frontend\models\CsServices;
use kartik\widgets\Typeahead;
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
	<h2 style=" margin: 20px 0 0; ">Izaberite usluge</h2>
	<hr>
	<?= Html::a('Index usluga', Url::to('/services'), array()); ?>
	
	<div class="service_autocomplete_search" style="width:60%;; margin:0 auto;">
	<?php $form = kartik\widgets\ActiveForm::begin([

    ]); 
	$url = \yii\helpers\Url::to(['/auto/list-services']); ?>
    <?= $form->field(new CsServices, 'name')->widget(Select2::classname(), [
    		'data' => ArrayHelper::map(CsServices::find()->all(), 'id', 'name'),
		    'options' => ['placeholder' => 'Search for a service ...'],
		    'pluginLoading' => false,
		    'pluginOptions' => [
		        'allowClear' => true,
		        'minimumInputLength' => 3,
		        'ajax' => [
		            'url' => $url,
		            'dataType' => 'json',
		            'data' => new JsExpression('function(params) { return {q:params.term}; }')
		        ],
		    ],
		    'addon' => [
		        'prepend' => [
		            'content' => 'Services'
		        ],
		        'append' => [
		            'content' => Html::button('<i class="fa fa-map-marker"></i>', [
		                'class' => 'btn btn-primary', 
		            ]),
		            'asButton' => true
		        ]
		    ],
		]); ?>

	<?php ActiveForm::end(); ?>

	</div>
</div>
