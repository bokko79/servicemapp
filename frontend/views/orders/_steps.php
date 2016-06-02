<?php

use yii\helpers\Html;
use yii\helpers\Url;

$link_2 = null;
$link_3 = null;



if (Yii::$app->controller->action->id=='add') {
	$activity2 = 'active';
	$activity3 = 'next';

} elseif (Yii::$app->controller->action->id=='create') {
	$activity2 = 'passed';
	$activity3 = 'active';		
}	
?>

<table class="shopping_steps">
	<tr>
		<!-- FIRST STEP: ind/select => SERVICES, BIRANJE DELATNOSTI -->			
		<td class="first step passed">
			<a href="<?= Url::to('/services') ?>" class="show_services">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_check"><i class="fa fa-check animated fadeIn"></i></span>	
							<span class="icon_back"><i class="fa fa-arrow-circle-left animated fadeIn"></i></span>
						</td>
						<td class="content">
							<table>
								<tr>
									<td class="main passed">										
										<?= Yii::t('app', 'Izabrali ste...') ?>									
									</td>
									<td class="main hover">										
										<?= Yii::t('app', 'Izaberite novu uslugu') ?>									
									</td>
								</tr>
								<tr>
									<td class="sub passed">
										<?= c($service->tNameAkk); ?>
									</td>
									<td class="sub hover">
										<?= Yii::t('app', 'Vratite se i izaberite drugu uslugu') ?>
									</td>
								</tr>
							</table>									
						</td>
					</tr>
				</table>
			</a>			
			<div class="arrow">
			</div>

		</td><!-- <td class="first step" -->
	
		<td class="scond step <?= $activity2 ?>">	
			<a href="<?= Url::to($link_2) ?>">
				<table>
					<tr>
						<td class="icon">
							<span class="icon_now">2</span>
							<span class="icon_check"><i class="fa fa-check animated fadeIn"></i></span>	
							<span class="icon_back"><i class="fa fa-arrow-circle-left animated fadeIn"></i></span>
						</td>
						<td class="content">
							<table>
								<tr>
									<td class="main active">										
										<?= Yii::t('app', '...sada opisujete...') ?>									
									</td>
									<td class="main passed">										
										<?= Yii::t('app', 'Opisali ste...') ?>									
									</td>
									<td class="main hover">										
										<?= Yii::t('app', 'Podesite opisanu uslugu') ?>									
									</td>
								</tr>
								<tr>
									<td class="sub active">
										<?= c($service->tNameAkk); ?>
									</td>
									<td class="sub passed">
										<?= c($service->tNameAkk); ?>
									</td>
									<td class="sub hover">
										<?= Yii::t('app', 'Vratite se i ponovo opišite uslugu') ?>
									</td>
								</tr>
							</table>									
						</td>
					</tr>
				</table>
			</a>				
		</td>
		<td class="third step <?= $activity3 ?>">
			<table>
				<tr>
					<td class="icon">
						<span class="icon_now">3</span>
						<span class="icon_later">3</span>
						<span class="icon_end">3</span>
					</td>
					<td class="content">
						<table>
							<tr>
								<td class="main next">										
										<?= Yii::t('app', 'Poručite') ?>									
									</td>
								<td class="main active">										
									<?= Yii::t('app', '...sada poručujete.') ?>									
								</td>
							</tr>
							<tr>
								<td class="sub active">
									<?= Yii::t('app', 'Unesite detalje porudžbine i pošaljite.') ?>
								</td>
								<td class="sub next">
									<?= Yii::t('app', 'Unesite detalje porudžbine i pošaljite.') ?>
								</td>
							</tr>
						</table>									
					</td>
				</tr>
			</table>
		</td>			
	</tr>
</table>
