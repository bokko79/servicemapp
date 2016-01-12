<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Provider;
use frontend\widgets\ProviderBox;
?>
<div class="featured cards">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Pružaoci usluga koje ste nedavno pregledali</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (Provider::find()->where('id>0')->limit(5)->all() as $key=>$provider) {					
		echo ProviderBox::widget([
				'boxData'=>[],
			]);
	} // foreach ($sektor as $key=>$sek) ?>	
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/providers'), array('class'=>'btn btn-default')); ?></div>

<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Popularni pružaoci usluga</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (Provider::find()->where('id>0')->limit(5)->all() as $key=>$provider) {					
		echo ProviderBox::widget([
				'boxData'=>[],
			]);
	} // foreach ($sektor as $key=>$sek) ?>	
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/providers'), array('class'=>'btn btn-default')); ?></div>


<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Pružaoci usluga koje ste preporučili</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (Provider::find()->where('id>0')->limit(5)->all() as $key=>$provider) {					
		echo ProviderBox::widget([
				'boxData'=>[],
			]);
	} // foreach ($sektor as $key=>$sek) ?>	
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/providers'), array('class'=>'btn btn-default')); ?></div>
