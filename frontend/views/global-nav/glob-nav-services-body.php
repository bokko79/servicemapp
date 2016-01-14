<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\CsServices;
use frontend\widgets\ServiceBox;
?>
<!-- VIEWED SERVICES -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Pregledane usluge</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=632 OR industry_id=681')->limit(6)->all() as $key=>$service) {
		echo ServiceBox::widget([

				'serviceId' => $service->id,
				'containerType' => 'teaser-200',
			    'containerOptions' => 'margin:0 37px;',
			    'link' => '/s/'.mb_strtolower(str_replace(' ', '-', $service->csServicesTranslations[0]->name)),
			    'image' => [
			    	'source'=>'info_docs'.($key+1).'.jpg',
			    	'style'=>''
			    ],
			    'name' => $service->csServicesTranslations[0]->name,
			    'subhead' => $service->industry->name,
			    'stats' => [
			    	'orders'=> 346,
			    	'providers' => 71,
			    	'promotions' => 102,
			    ],
			    'price' => [
			    	'amount'=> 450,
			    	'currencyCode' => 'RSD',
			    	'unit' => 'm',
			    ],
			    'actionButton' => '',
			]);
	} // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>
<!-- ORDERED SERVICES -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Usluge koje ste poručivali</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=632 OR industry_id=681')->limit(5)->all() as $key=>$service) {
		echo ServiceBox::widget([
				'serviceId' => $service->id,
			    'containerOptions' => null,
			    'link' => '/s/'.mb_strtolower(str_replace(' ', '-', $service->csServicesTranslations[0]->name)),
			    'image' => [
			    	'source'=>'info_docs'.($key+1).'.jpg',
			    	'style'=>'height:150px;'
			    ],
			    'name' => $service->csServicesTranslations[0]->name,
			    'description' => $service->csServicesTranslations[0]->name,
			    'stats' => [
			    	'orders'=> 346,
			    	'providers' => 71,
			    	'promotions' => 102,
			    ],
			    'price' => [
			    	'amount'=> 450,
			    	'currencyCode' => 'RSD',
			    	'unit' => 'm',
			    ],
			    'actionButton' => '',
			]);
	} // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>	   		
<!-- FOLLOWED SERVICES -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Usluge koje pratite</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=632 OR industry_id=681')->limit(5)->all() as $key=>$service) {
		echo ServiceBox::widget([
				'serviceId' => $service->id,
			    'containerOptions' => null,
			    'link' => '/s/'.mb_strtolower(str_replace(' ', '-', $service->csServicesTranslations[0]->name)),
			    'image' => [
			    	'source'=>'info_docs'.($key+1).'.jpg',
			    	'style'=>'height:150px;'
			    ],
			    'name' => $service->csServicesTranslations[0]->name,
			    'description' => $service->csServicesTranslations[0]->name,
			    'stats' => [
			    	'orders'=> 346,
			    	'providers' => 71,
			    	'promotions' => 102,
			    ],
			    'price' => [
			    	'amount'=> 450,
			    	'currencyCode' => 'RSD',
			    	'unit' => 'm',
			    ],
			    'actionButton' => '',
			]);
	} // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>	 
<!-- PROVIDED SERVICES -->
<?php /*if(Yii::app()->user->isProvider()): ?>
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Usluge koje pružam</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>

</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>
<?php endif; */?>
<!-- POPULAR SERVICES -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Popularne usluge</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=632 OR industry_id=681')->limit(5)->all() as $key=>$service) {
		echo ServiceBox::widget([
				'serviceId' => $service->id,
			    'containerOptions' => null,
			    'link' => '/s/'.mb_strtolower(str_replace(' ', '-', $service->csServicesTranslations[0]->name)),
			    'image' => [
			    	'source'=>'info_docs'.($key+1).'.jpg',
			    	'style'=>'height:150px;'
			    ],
			    'name' => $service->csServicesTranslations[0]->name,
			    'description' => $service->csServicesTranslations[0]->name,
			    'stats' => [
			    	'orders'=> 346,
			    	'providers' => 71,
			    	'promotions' => 102,
			    ],
			    'price' => [
			    	'amount'=> 450,
			    	'currencyCode' => 'RSD',
			    	'unit' => 'm',
			    ],
			    'actionButton' => '',
			]);
	} // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>

