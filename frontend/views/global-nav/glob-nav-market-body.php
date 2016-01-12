<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\Activities;
use frontend\widgets\ActivityBox;
?>
<!-- MY EVENTS -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Moj market</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (Activities::find()->limit(5)->all() as $key=>$activity) { 		
		echo ActivityBox::widget([
				'boxData'=>[],
			]);
	} // foreach ($sektor as $key=>$sek) ?>	
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/market'), array('class'=>'btn btn-default')); ?></div>
<!-- LATEST -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Najnovije promene na marketu</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>

</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/market'), array('class'=>'btn btn-default')); ?></div>
<!-- FOLLOWED -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Dešavanja koja pratite</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>

</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/market'), array('class'=>'btn btn-default')); ?></div>
<!-- VIEWED -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Pregledane stavke sa marketa</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>

</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/market'), array('class'=>'btn btn-default')); ?></div>



