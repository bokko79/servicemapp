<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<ul class="global_nav">
	<li class="<?= (Yii::$app->controller->id=='services' && Yii::$app->controller->action->id=='index') ? 'active' : null ?>">
		<?= Html::a(Yii::t('app', 'Usluge'), Url::to(['/services', 'st'=>'gl']), ['class'=>'careted', 'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Index of Service industries')]) ?>
		<?= Html::a('<i class="fa fa-caret-down"></i>', null, ['id'=>'', 'class'=>'button']) ?>		
		<div class="category fadeInDown animated quick services">
			<?= $this->render('global-nav/services.php') ?>
		</div>
		<div class="subnav">
			<?= $this->render('subnav/services.php') ?>	
		</div>	
	</li>
	<li class="<?= (Url::current()=='/market' || (Yii::$app->controller->id=='orders' && Yii::$app->controller->action->id=='view')) ? 'active' : null ?>">
		<?= Html::a('Market', Url::to('/market'), ['class'=>'careted','style'=>'', 'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Service Market: Index of Service Requests')]); ?>
		<?php // Html::a('<i class="fa fa-caret-down"></i>', null, ['id'=>'glob_hover_market', 'class'=>'button']) ?>

		<div class="category fadeInDown animated quick market">
			<?= $this->render('global-nav/services.php') ?>
		</div>
		<div class="subnav">
			<?= $this->render('subnav/market.php') ?>
		</div>
	</li>	
	<li class="<?= (Url::current()=='/providers') ? 'active' : null ?>">
		<?= Html::a(Yii::t('app', 'Provajderi'), Url::to('/providers'), ['class'=>'careted']); ?>
		<?php // Html::a('<i class="fa fa-caret-down"></i>', null, ['id'=>'glob_hover_provider', 'class'=>'button']) ?>

		<div class="category fadeInDown animated quick providers">
			<?= $this->render('global-nav/services.php') ?>
		</div>
		<div class="subnav">
			<?= $this->render('subnav/providers.php') ?>
		</div>
	</li>
	<li class="<?= (Url::current()=='/info') ? 'active' : null ?>">
		<?= Html::a(Yii::t('app', 'Info'), Url::to('/info'), ['class'=>'careted']); ?>
		<div class="subnav">
			<?= $this->render('subnav/info.php') ?>
		</div>
	</li>
	<?php if(Yii::$app->controller->id!='services' or Yii::$app->controller->action->id!='index'): ?>
	<li class="search_icon" style="float:right;">
		<a href="#" id="glob_hover_service111" class="careted animated slideInDown center" style="width:60px;"><i class="fa fa-search fa-lg"></i></a>
		<div class="subnav-fixed search animated fadeIn">
			<div class="container">
				<div class="content">
					<?= $this->render('autocomplete.php', ['renderIndex'=>false]) ?>					
				</div>				
			</div>
		</div>
		<?php /*<div class="category fadeInDown animated quick services">
			<?= $this->render('global-nav/services.php') ?>
		</div> */ ?>
	</li>
	<a href="#" style="position:fixed; right:20px; top:70px; display:none;" class="close_search" onclick="close_search();"><i class="fa fa-times white"></i></a>
	<?php endif; ?>
</ul>