<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\models\CsSectors;
?>
<ul class="global_nav">
	<li <?php /*echo $active_del; */?> class="active"><?= Html::a(Yii::t('app', 'Services').'&nbsp;&nbsp;<i class="fa fa fa-caret-down"></i>', /*$this->createUrl($delredirect)*/'#',array('id'=>'glob_hover_service', 'onclick'=>'return false', 'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Index of Service industries'))); ?>		
		<div class="category fadeInDown animated quick services">
			<?= $this->render('global-nav/services.php') ?>
		</div>
	</li>
	<li <?php /*echo $active_req; */?>><?= Html::a('Market&nbsp;&nbsp;<i class="fa fa fa-caret-down"></i>', /*$this->createUrl('/market')*/'#',array('id'=>'glob_hover_market', 'onclick'=>'return false', 'style'=>/*((Request::model()->regular()->count()>0) ? '' : 'color:#aaa')*/'', 'data-toggle'=>'tooltip', 'title'=>/*((Request::model()->regular()->count()>0) ? Yii::t('app', 'Service Market: Index of Service Requests') : Yii::t('app', 'We have no active Service Requests in our database at the moment.'))*/'')); ?>

		<div class="category fadeInDown animated quick market">
			<?= $this->render('global-nav/services.php') ?>
		</div>
	</li>	
	<li <?php /*echo $active_pro; */?>><?= Html::a(Yii::t('app', 'Providers').'&nbsp;&nbsp;<i class="fa fa fa-caret-down "></i>', /*$this->createUrl('/providers')*/'#',array('id'=>'glob_hover_provider', 'onclick'=>'return false', 'style'=>/*((Provider::model()->count()>0) ? '' : 'color:#aaa')*/'', 'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Index of Service Providers'))); ?>

		<div class="category fadeInDown animated quick providers">
			<?= $this->render('global-nav/services.php') ?>
		</div>
	</li>
	<li class="search_icon" style="float:right;"><a href="#" onclick="return false"><i class="fa fa-search"></i></a></li>
</ul>