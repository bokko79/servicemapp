<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<ul class="global_nav">
	<li <?php /*echo $active_del; */?> class="active"><?= Html::a(Yii::t('app', 'Services').'&nbsp;&nbsp;<i class="fa fa fa-caret-down"></i>', /*$this->createUrl($delredirect)*/'#',array('id'=>'glob_hover_service', 'onclick'=>'return false', 'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Index of Service industries'))); ?>		
		<div class="category fadeIn animated quick services">
			<span class="turn_off_glob" onclick="close_category();"><i class="fa fa-times"></i></span>
			<!-- CART -->
				<div class="cart">
					<?php 
							// EXT-011 HOME/INDUSTRIES
							/*include (Yii::getPathOfAlias( 'ext.widgets.header.global_nav._industry_submenu').'.php');*/ ?>
				</div>
		</div>
		<!--<div class="caret_cont"><div class="caret"></div></div>-->
	</li>
	<li <?php /*echo $active_req; */?>><?= Html::a('Market&nbsp;&nbsp;<i class="fa fa fa-caret-down"></i>', /*$this->createUrl('/market')*/'#',array('id'=>'glob_hover_request', 'onclick'=>'return false', 'style'=>/*((Request::model()->regular()->count()>0) ? '' : 'color:#aaa')*/'', 'data-toggle'=>'tooltip', 'title'=>/*((Request::model()->regular()->count()>0) ? Yii::t('app', 'Service Market: Index of Service Requests') : Yii::t('app', 'We have no active Service Requests in our database at the moment.'))*/'')); ?>

		<div class="category fadeIn animated quick market">
			<span class="turn_off_glob" onclick="close_category();"><i class="fa fa-times"></i></span>
			<!-- CART -->
				<div class="cart">
					<?php 
							// EXT-011 HOME/INDUSTRIES
							/*include (Yii::getPathOfAlias( 'ext.widgets.header.global_nav._industry_submenu').'.php'); */?>
				</div>
		</div>
	</li>	
	<li <?php /*echo $active_pro; */?>><?= Html::a(Yii::t('app', 'Providers').'&nbsp;&nbsp;<i class="fa fa fa-caret-down "></i>', /*$this->createUrl('/providers')*/'#',array('id'=>'glob_hover_provider', 'onclick'=>'return false', 'style'=>/*((Provider::model()->count()>0) ? '' : 'color:#aaa')*/'', 'data-toggle'=>'tooltip', 'title'=>Yii::t('app', 'Index of Service Providers'))); ?>

		<div class="category fadeIn animated quick providers">
			<span class="turn_off_glob" onclick="close_category();"><i class="fa fa-times"></i></span>
			<!-- CART -->
				<div class="cart">
					<?php 
							// EXT-011 HOME/INDUSTRIES
							/*include (Yii::getPathOfAlias( 'ext.widgets.header.global_nav._industry_submenu').'.php');*/ ?>
				</div>
		</div>
	</li>
	<li class="search_icon" style="float:right;"><a href="#" onclick="return false"><i class="fa fa-search"></i></a></li>
</ul><!-- <ul class="nav nav-pills myTab">  -->