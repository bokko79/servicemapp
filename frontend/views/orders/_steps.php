<?php

use yii\helpers\Html;
use yii\helpers\Url;

$link_1 = 'choose-service';
$link_2 = null;
$link_3 = null;

$activity1 = 'passed';
$activity2 = 'active';
$activity3 = 'next';

if (Yii::$app->controller->getRoute()=='order/choose')
{
	$link_1 = null;
	$activity1 = 'active';
	$activity2 = 'next';

} elseif (Yii::$app->controller->getRoute()=='order/add') {


} elseif (Yii::$app->controller->getRoute()=='order/create') {
	$activity2 = 'passed';
	$activity3 = 'active';		
}	
?>

<table class="shopping_steps">
	<tr>
		<!-- FIRST STEP: ind/select => SERVICES, BIRANJE DELATNOSTI -->			
		<td class="first step <?= $activity1; ?>">
			<a href="<?= Url::to($link_1) ?>" class="show_services">
				<table>
					<tr>
						<td class="wrap <?= $activity1 ?>">
							<table>
								<tr>
									<td>
									<?php
										if (Yii::$app->controller->getRoute()=='order/add')
										{
											echo '<span class="icon_check" style="color:#00aff0"><i class="fa fa-dot-circle-o fa-2x"></i></span>';

										} elseif (Yii::$app->controller->getRoute()=='order/choose') {

											echo  '<span class="icon_now"><i class="fa fa-tag fa-2x"></i></span>'; 

										}  else {
											echo  '<span class="icon_now"><i class="fa fa-tag fa-2x"></i></span>';
											echo  '<span class="icon_check"><i class="fa fa-check fa-2x"></i></span>'; 

										} ?>
											
										<span class="icon_back"><i class="fa fa-arrow-circle-left fa-2x"></i></span>
										<?= Yii::t('app', 'Choose Object & Service') ?>

										<p class="hitn animated fadeIn"><?php echo (Yii::$app->controller->getRoute()=='order/choose') ? Yii::t('app', 'Choose a service you need done within an industry.') : Yii::t('app', 'Choose your service object and then the service you want done.'); ?></p>
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
						<td class="wrap <?= $activity2 ?>">
							<table>
								<tr>
									<td>
										<span class="icon_later"><i class="fa fa-edit fa-2x"></i></span>								
										<span class="icon_now"><i class="fa fa-edit fa-2x"></i></span>
										<span class="icon_check"><i class="fa fa-check fa-2x"></i></span>
										<span class="icon_back"><i class="fa fa-arrow-circle-left fa-2x"></i></span>

										<?= Yii::t('app', 'Describe what you need') ?>
										<p class="hitn animated fadeIn"><?= Yii::t('app', 'Explain what, why and how much you need.') ?></p>
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
					<td class="wrap <?= $activity3 ?>">
							<table>
								<tr>
									<td>
										<span class="icon_now"><i class="fa fa-globe fa-2x"></i></span>
										<span class="icon_later"><i class="fa fa-globe fa-2x"></i></span>
										<span class="icon_end"><i class="fa fa-globe fa-2x"></i></span>

										<?= Yii::t('app', 'Finish & Send Request') ?>
										<p class="hitn animated fadeIn"><?= Yii::t('app', 'Enter where and when you need it and send request to the providers.') ?></p>											
									</td>
								</tr>
							</table>
					</td>
				</tr>
			</table>
		</td>			
	</tr>
</table>
