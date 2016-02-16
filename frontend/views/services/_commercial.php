<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\CsServices;
?>
<?php if(!Yii::$app->user->isGuest): ?>
<!-- VIEWED SERVICES -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Pregledane usluge</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=632 OR industry_id=681')->limit(4)->all() as $key=>$service) { ?>
		<div class="card_container record-sm grid-item fadeInUp animated" id="card_container" style="margin:0 11px;">
	        <a href="<?= Url::to('/services') ?>">
	            <div class="media-area">                
	                <div class="image">
	                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
	                </div>
	                <div class="primary-context in-media">
	                    <div class="head"><?= $service->name ?></div>
	                </div>
	            </div>
	            <div class="primary-context">
	                <div class="subhead"><?= $service->industry->name ?></div>
	            </div>
	            <div class="secondary-context">
	                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
	                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
	                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
	                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
	                    ex ea commodo consequat.</p>
	            </div>
	            <div class="action-area right">
	                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
	            </div>
	        </a>
	    </div>
	<?php } // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>
<?php endif; ?>
<?php if(!Yii::$app->user->isGuest): ?>
<!-- ORDERED SERVICES -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Usluge koje ste poručivali</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=632 OR industry_id=681')->limit(4)->all() as $key=>$service) { ?>
		<div class="card_container record-sm grid-item fadeInUp animated" id="card_container" style="margin:0 11px;">
	        <a href="<?= Url::to('/services') ?>">
	            <div class="media-area">                
	                <div class="image">
	                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
	                </div>
	                <div class="primary-context in-media">
	                    <div class="head"><?= $service->name ?></div>
	                </div>
	            </div>
	            <div class="primary-context">
	                <div class="subhead"><?= $service->industry->name ?></div>
	            </div>
	            <div class="secondary-context">
	                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
	                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
	                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
	                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
	                    ex ea commodo consequat.</p>
	            </div>
	            <div class="action-area right">
	                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
	            </div>
	        </a>
	    </div>
	<?php } // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>	
<?php endif; ?>  
<?php if(!Yii::$app->user->isGuest): ?> 		
<!-- FOLLOWED SERVICES -->
<div class="featured">
	<h2 style="text-align:center; margin:30px 0 10px 0;">Usluge koje ste obeležili</h2>
	<hr>
	<p class="paragraph" style="text-align:center; margin:0 0 10px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=13 OR industry_id=681')->limit(4)->all() as $key=>$service) { ?>
		<div class="card_container record-sm grid-item fadeInUp animated" id="card_container" style="margin:0 11px;">
	        <a href="<?= Url::to('/services') ?>">
	            <div class="media-area">                
	                <div class="image">
	                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
	                </div>
	                <div class="primary-context in-media">
	                    <div class="head"><?= $service->name ?></div>
	                </div>
	            </div>
	            <div class="primary-context">
	                <div class="subhead"><?= $service->industry->name ?></div>
	            </div>
	            <div class="secondary-context">
	                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
	                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
	                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
	                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
	                    ex ea commodo consequat.</p>
	            </div>
	            <div class="action-area right">
	                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
	            </div>
	        </a>
	    </div>
	<?php } // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>
<?php endif; ?>
<?php if(!Yii::$app->user->isGuest): ?>	 
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
<hr>
<div class="featured">
	<h1 style="text-align:left; margin:30px 0 10px 0;">Preporučene usluge</h1>
	<p class="paragraph" style="margin:0 0 20px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>
	<?php foreach (CsServices::find()->where('industry_id=101 OR industry_id=681')->limit(4)->all() as $key=>$service) { ?>
		<div class="card_container record-sm grid-item fadeInUp animated" id="card_container" style="margin:0 11px;">
	        <a href="<?= Url::to('/services') ?>">
	            <div class="media-area">                
	                <div class="image">
	                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
	                </div>
	                <div class="primary-context in-media">
	                    <div class="head"><?= $service->name ?></div>
	                </div>
	            </div>
	            <div class="primary-context">
	                <div class="subhead"><?= $service->industry->name ?></div>
	            </div>
	            <div class="secondary-context">
	                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
	                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
	                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
	                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
	                    ex ea commodo consequat.</p>
	            </div>
	            <div class="action-area right">
	                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
	            </div>
	        </a>
	    </div>
	<?php } // foreach ($sektor as $key=>$sek) ?>
</div>
<div class="show_more"><?= Html::a('POKAŽI JOŠ', Url::to('/services'), array('class'=>'btn btn-default')); ?></div>

