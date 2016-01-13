<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="industry_6box_container_back b">
	<div class="industry_6box_slider white" style="">	
		<div class="featured" style="margin: 0 auto; text-align:center;">
			<table class="" style="margin-bottom: 30px;">
				<tr>
					<td class="control zoomInLeft animated">
						<h1><?= Html::a('<i class="fa fa-percent"></i>&nbsp;Uštedite.', '#', array()); ?></h1>
						<p>Promotivne usluge i najave događaja po niskim cenama. <a href="<?= Url::to('/info') ?>">Saznaj više.</a></p>
					</td>
					
					<td class="control zoomInDown animated">
						<h1><?= Html::a('<i class="fa fa-trophy"></i>&nbsp;Osvojite.', '#', array()); ?></h1>
						<p>Dajte svoje najbolje ponude na korisničke zahteve za usluge koje pružate i osvojite klijente. <a href="<?= Url::to('/info') ?>">Saznaj više.</a></p>
					</td>
					<td class="control zoomInRight animated">
						<h1><?= Html::a('<i class="fa fa-info-circle"></i>&nbsp;Saznajte.', '#', array()); ?></h1>
						<p>Budite prvi koji će znati o novim dešavanjima, popustima i akcijama. <a href="<?= Url::to('/info') ?>">Saznaj više.</a></p>
					</td>
				</tr>
			</table>
			<?= Html::a('Market Home', Url::to('/market'), array('style'=>'color:white;')); ?>			
		</div>
	</div>
</div><!-- <div class="row-fluid industry"> -->
