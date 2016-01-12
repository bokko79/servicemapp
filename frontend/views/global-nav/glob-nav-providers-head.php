<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="industry_6box_container_back c">
	<div class="industry_6box_slider" style="">

	
		<div class="featured" style="margin: 0 auto;">
			<table class="">
			<tr>
				<td class="control fadeInLeft animated">
					<h1><?= Html::a('<i class="fa fa-comments"></i>&nbsp;Preporučite.', '#', array()); ?></h1>
					<p>Preporučite pružaoce usluga drugima i pratite njihovo poslovanje. <a href="<?= Url::to('/info') ?>">Saznaj više.</a></p>
				</td>
				
				<td class="control fadeInDown animated">
					<h1><?= Html::a('<i class="fa fa-shopping-basket"></i>&nbsp;Naručite.', '#', array()); ?></h1>
					<p>Naručite usluge direktno od profesionalaca i uštedite u novcu i vremenu. <a href="<?= Url::to('/info') ?>">Saznaj više.</a></p>
				</td>
				<td class="control fadeInRight animated">
					<h1><?= Html::a('<i class="fa fa-check"></i>&nbsp;Ocenite.', '#', array()); ?></h1>
					<p>Ocenite poslovanje pružalaca usluga koje poznajete i olakšajte drugima izbor. <a href="<?= Url::to('/info') ?>">Saznaj više.</a></p>
				</td>
			</tr>
		</table>
			
		</div>	

	</div>

</div><!-- <div class="row-fluid industry"> -->	

<div class="featured" style="margin: 0 auto; text-align:center;">
	<h2 style="margin: 20px 0 0; ">Izaberite pružaoce usluga</h2>
	<hr>
	<?= Html::a('Index pružalaca usluga', Url::to('/providers'), array()); ?>

	<div class="service_autocomplete_search">

	</div>
</div>
