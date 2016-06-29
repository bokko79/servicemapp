<?php

use yii\helpers\Html;
use yii\helpers\Url;

$link_2 = null;
$link_3 = null;
$activity2 = 'active';
$activity3 = 'next';


?>

<table class="shopping_steps">
	<tr>
		<!-- FIRST STEP: ind/select => SERVICES, BIRANJE DELATNOSTI -->			
		<td class="first step">
			<a href="<?= Url::to('/presentation/'.$model->id.'/industry') ?>" class="show_services">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_now"><i class="fa fa-industry animated fadeIn"></i></span>
							<span class="icon_later"><i class="fa fa-industry animated fadeIn"></i></span>
							<span class="icon_end"><i class="fa fa-industry animated fadeIn"></i></span>
						</td>
					</tr>
					<tr>
						<td class="content">										
							<?= Yii::t('app', 'Delatnost') ?>									
						</td>
					</tr>
				</table>
			</a>			
			<div class="arrow">
			</div>

		</td><!-- <td class="first step" -->
	
		<td class="first step">	
			<a href="<?= Url::to('/presentation/'.$model->id.'/action') ?>">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_now"><i class="fa fa-flag-o animated fadeIn"></i></span>
							<span class="icon_later"><i class="fa fa-flag-o animated fadeIn"></i></span>
							<span class="icon_end"><i class="fa fa-flag-o animated fadeIn"></i></span>
						</td>
					</tr>
					<tr>
						<td class="content">										
							<?= Yii::t('app', 'Akcija') ?>									
						</td>
					</tr>
				</table>
			</a>				
		</td>
		<td class="first step">
			<a href="<?= Url::to('/presentation/'.$model->id.'/object') ?>">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_now"><i class="fa fa-cube animated fadeIn"></i></span>
							<span class="icon_later"><i class="fa fa-cube animated fadeIn"></i></span>
							<span class="icon_end"><i class="fa fa-cube animated fadeIn"></i></span>
						</td>
					</tr>
					<tr>
						<td class="content">										
							<?= Yii::t('app', 'Predmet') ?> <?= ($model->presentationObjectProperties) ? '<i class="fa fa-check animated fadeIn"></i>' : '*' ?>									
						</td>
					</tr>
				</table>
			</a>
		</td>
		<td class="first step">
			<a href="<?= Url::to('/presentation/'.$model->id.'/title') ?>">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_now"><i class="fa fa-pencil animated fadeIn"></i></span>
							<span class="icon_later"><i class="fa fa-pencil animated fadeIn"></i></span>
							<span class="icon_end"><i class="fa fa-pencil animated fadeIn"></i></span>
						</td>
					</tr>
					<tr>
						<td class="content">										
							<?= Yii::t('app', 'Naslov') ?>									
						</td>
					</tr>
				</table>
			</a>
		</td>
		<td class="first step">
			<a href="<?= Url::to('/presentation/'.$model->id.'/location') ?>">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_now"><i class="fa fa-map-marker animated fadeIn"></i></span>
							<span class="icon_later"><i class="fa fa-map-marker animated fadeIn"></i></span>
							<span class="icon_end"><i class="fa fa-map-marker animated fadeIn"></i></span>
						</td>
					</tr>
					<tr>
						<td class="content">										
							<?= Yii::t('app', 'Lokacija') ?>									
						</td>
					</tr>
				</table>
			</a>
		</td>
		<td class="first step">
			<a href="<?= Url::to('/presentation/'.$model->id.'/time') ?>">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_now"><i class="fa fa-clock-o animated fadeIn"></i></span>
							<span class="icon_later"><i class="fa fa-clock-o animated fadeIn"></i></span>
							<span class="icon_end"><i class="fa fa-clock-o animated fadeIn"></i></span>
						</td>
					</tr>
					<tr>
						<td class="content">										
							<?= Yii::t('app', 'Vreme') ?>									
						</td>
					</tr>
				</table>
			</a>
		</td>
		<td class="first step">
			<a href="<?= Url::to('/presentation/'.$model->id.'/pricing') ?>">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_now"><i class="fa fa-usd animated fadeIn"></i></span>
							<span class="icon_later"><i class="fa fa-usd animated fadeIn"></i></span>
							<span class="icon_end"><i class="fa fa-usd animated fadeIn"></i></span>
						</td>
					</tr>
					<tr>
						<td class="content">										
							<?= Yii::t('app', 'Cena') ?>									
						</td>
					</tr>
				</table>
			</a>
		</td>
		<td class="first step">
			<a href="<?= Url::to('/presentation/'.$model->id.'/general') ?>">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_now"><i class="fa fa-cogs animated fadeIn"></i></span>
							<span class="icon_later"><i class="fa fa-cogs animated fadeIn"></i></span>
							<span class="icon_end"><i class="fa fa-cogs animated fadeIn"></i></span>
						</td>
					</tr>
					<tr>
						<td class="content">										
							<?= Yii::t('app', 'Ostalo') ?>									
						</td>
					</tr>
				</table>
			</a>
		</td>
	</tr>
</table>
