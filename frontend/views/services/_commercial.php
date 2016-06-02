<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\CsServices;
use frontend\models\Presentations;
?>
<!-- PRESENTATIONS -->
<hr style="margin-top:0">
<div class="featured">
	<h2 style="text-align:left; margin:30px 0 10px 0;"><i class="fa fa-flag-o"></i> Ponude usluge
	<?= Html::a('POKAŽI JOŠ', Url::to('/presentations'), array('class'=>'btn btn-default uppercase bold float-right')); ?>
	</h2>
	<p class="paragraph fs_11 gray_color margin-bottom-20"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }' style="margin-top:40px;">
	<?php foreach (Presentations::find()->limit(4)->orderBy('id DESC')->all() as $key=>$model) { ?>
		<?= $this->render('//presentations/_card.php', ['model'=>$model]) ?>
	<?php } // foreach ($sektor as $key=>$sek) ?>
	</div>
</div>

<?php if(!Yii::$app->user->isGuest): ?>
<!-- VIEWED SERVICES -->
<hr style="margin-top:0">
<div class="featured">
	<h2 style="text-align:left; margin:30px 0 10px 0;"><i class="fa fa-flag-o"></i> Pregledane usluge</h2>
	<p class="paragraph fs_11 gray_color margin-bottom-20"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }' style="margin-top:40px;">
	<?php foreach (CsServices::find()->where('industry_id=631 OR industry_id=681')->limit(4)->all() as $key=>$service) { ?>
		<?= $this->render('_card_comm.php', ['model'=>$service]) ?>
	<?php } // foreach ($sektor as $key=>$sek) ?>
	</div>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>
<!-- ORDERED SERVICES -->
<hr>
<div class="featured">
	<h2 style="text-align:left; margin:30px 0 10px 0;"><i class="fa fa-shopping-cart"></i> Usluge koje ste poručivali</h2>
	<p class="paragraph fs_11 gray_color margin-bottom-20"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=631 OR industry_id=681')->limit(4)->all() as $key=>$service) { ?>
		<?= $this->render('_card_comm.php', ['model'=>$service]) ?>
	<?php } // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>	
<!-- FOLLOWED SERVICES -->
<hr>
<div class="featured">
	<h2 style="text-align:left; margin:30px 0 10px 0;"><i class="fa fa-bookmark-o"></i> Usluge koje ste obeležili</h2>	
	<p class="paragraph fs_11 gray_color margin-bottom-20"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=631 OR industry_id=681')->limit(4)->all() as $key=>$service) { ?>
		<?= $this->render('_card_comm.php', ['model'=>$service]) ?>
	<?php } // foreach ($sektor as $key=>$sek) ?>
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
<?php endif; ?>
<!-- POPULAR SERVICES -->
<hr style="margin-top:0">
<div class="featured">
	<h2 style="text-align:left; margin:30px 0 10px 0;"><i class="fa fa-thumbs-o-up"></i> Preporučene usluge</h2>
	<p class="paragraph fs_11 gray_color margin-bottom-20"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=631 OR industry_id=681')->limit(4)->all() as $key=>$service) { ?>
		<?= $this->render('_card_comm.php', ['model'=>$service]) ?>
	<?php } // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>

