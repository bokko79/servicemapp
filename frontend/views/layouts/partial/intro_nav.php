<?php

use yii\helpers\Html;
use yii\helpers\Url;
use \frontend\models\User;
use yii\bootstrap\Modal;
?>
<!-- Top menu -->
<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!--<a class="navbar-brand" href="#">Servicemapp - Landing Page</a>-->
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="top-navbar-1">
			<ul class="nav navbar-nav navbar-right">
				<li><a class="scroll-link" href="#features">Šta je Servicemapp</a></li>
				<li><a class="scroll-link" href="#how-it-works">Kako radi</a></li>
				<li><a class="scroll-link" href="#pricing">Članarina</a></li>
				<li><a class="scroll-link" href="#about-us">O nama</a></li>
				<!--<li><a class="scroll-link" href="#pricing">Kontakt</a></li>
				<li><a class="scroll-link" href="#testimonials">Statistika</a></li>-->
				<li><a class="login_form" data-toggle="modal" href="#uac-modal">Login</a></li>
				<li><a class="scroll-link search_form" href="#search"><i class="fa fa-search"></i> Pretraga</a></li>
			</ul>
		</div>
	</div>
</nav>