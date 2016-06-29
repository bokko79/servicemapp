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
										<?= Yii::t('app', 'Choose a service within an industry you are in.') ?>
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
							<span class="icon_now"><i class="fa fa-flag-o animated fadeIn"></i></span>
						</td>
						<td class="content">
							<table>
								<tr>
									<td class="main">										
										<?= Yii::t('app', 'Predstavite') ?>									
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
						<span class="icon_now"><i class="fa fa-usd animated fadeIn"></i></span>
						<span class="icon_later"><i class="fa fa-usd animated fadeIn"></i></span>
						<span class="icon_end"><i class="fa fa-usd animated fadeIn"></i></span>
					</td>
					<td class="content">
						<table>
							<tr>
								<td class="main">										
									<?= Yii::t('app', 'Zaradite') ?>									
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
