<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;    	
?>
<ul class="global_nav">
	<li class="<?= (Url::current()=='/services') ? 'active' : null ?>">
		<?= Html::a(Yii::t('app', 'Usluge'), Url::to('/services'), ['class'=>'careted', 'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Index of Service industries')]) ?>
		<?= Html::a('<i class="fa fa-caret-down"></i>', null, ['id'=>'glob_hover_service', 'class'=>'button']) ?>		
		<div class="category fadeInDown animated quick services">
			<?= $this->render('global-nav/services.php') ?>
		</div>
		<div class="subnav">
			<?= $this->render('subnav/services.php') ?>	
		</div>	
	</li>
	<li class="<?= (Url::current()=='/market') ? 'active' : null ?>">
		<?= Html::a('Market', Url::to('/market'), ['class'=>'careted','style'=>'', 'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Service Market: Index of Service Requests')]); ?>
		<?= Html::a('<i class="fa fa-caret-down"></i>', null, ['id'=>'glob_hover_market', 'class'=>'button']) ?>

		<div class="category fadeInDown animated quick market">
			<?= $this->render('global-nav/services.php') ?>
		</div>
		<div class="subnav">
			<?= $this->render('subnav/market.php') ?>
		</div>
	</li>	
	<li class="<?= (Url::current()=='/providers') ? 'active' : null ?>">
		<?= Html::a(Yii::t('app', 'Provajderi'), Url::to('/providers'), ['class'=>'careted']); ?>
		<?= Html::a('<i class="fa fa-caret-down"></i>', null, ['id'=>'glob_hover_provider', 'class'=>'button']) ?>

		<div class="category fadeInDown animated quick providers">
			<?= $this->render('global-nav/services.php') ?>
		</div>
		<div class="subnav">
			<?= $this->render('subnav/providers.php') ?>
		</div>
	</li>
	<li class="<?= (Url::current()=='/infio') ? 'active' : null ?>">
		<?= Html::a(Yii::t('app', 'Info'), Url::to('/info'), ['class'=>'careted']); ?>
		<div class="subnav">
			<?= $this->render('subnav/info.php') ?>
		</div>
	</li>
	<li class="search_icon" style="float:right;">
		<a href="#" onclick="return false" class="careted"><i class="fa fa-search"></i></a>
		<div class="subnav-fixed search">
			<?= $this->render('subnav/search.php') ?>
		</div>
	</li>
</ul>