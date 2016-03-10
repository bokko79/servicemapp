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
									<td class="main">										
										<?= Yii::t('app', 'Izaberite') ?>									
									</td>
								</tr>
								<tr>
									<td class="sub">
										<?= Yii::t('app', 'Choose a service you need done within an industry.') ?>
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
									<td class="main">										
										<?= Yii::t('app', 'Opišite') ?>									
									</td>
								</tr>
								<tr>
									<td class="sub">
										<?= c($service->tName); ?>
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
								<td class="main">										
									<?= Yii::t('app', 'Poručite') ?>									
								</td>
							</tr>
							<tr>
								<td class="sub">
									<?= Yii::t('app', 'Enter where and when you need it and send request to the providers.') ?>
								</td>
							</tr>
						</table>									
					</td>
				</tr>
			</table>
		</td>			
	</tr>
</table>
