<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
?>
<?php
// current user koji gleda zahtev
    if (!Yii::$app->user->isGuest)
    {    	
		$free = ($role->id==5 || $role->id==6) ? Yii::t('app', 'Current plan') : '';
		
    	
    	$button_silver = ($role->id<7) ? Html::a(Yii::t('app', 'Upgrade').' <i class="fa fa-arrows-right"></i>', array('/post/membership', 'checkout'=>'silver', 'from'=>'membership'), array('class'=>'btn btn-success upgrade')) : '';
    	$button_gold = ($role->id<9) ? Html::a(Yii::t('app', 'Upgrade').' <i class="fa fa-arrows-right"></i>',array('/post/membership', 'checkout'=>'gold', 'from'=>'membership'), array('class'=>'btn btn-success upgrade')) : '';
		$button_premium = ($role->id<11) ? Html::a(Yii::t('app', 'Upgrade').' <i class="fa fa-arrows-right"></i>', array('/post/membership', 'checkout'=>'premium', 'from'=>'membership'), array('class'=>'btn btn-success upgrade')) : '';

		$style_free = ($role->id==5 || $role->id==6) ? 'style="background: #fff !important; color: #4D575F !important;"' : '';
		$style_silver = ($role->id==7 || $role->id==8) ? 'style="background: #fff !important; color: #4D575F !important;"' : '';
		$style_gold = ($role->id==9 || $role->id==10) ? 'style="background: #fff !important; color: #4D575F !important;"' : '';
		$style_premium = ($role->id==11 || $role->id==12) ? 'style="background: #00aa00 !important; color:#fff;"': '';

		$style_free_head = ($role->id==5 || $role->id==6) ? 'style="background: #7b8791 !important; color: #fff !important; font-weight:900;"' : 'style="background: #4d575f !important; color: #fff !important; font-weight:900;"';
		$style_silver_head = ($role->id==7 || $role->id==8) ? 'style="background: #7b8791 !important; color: #fff !important; font-weight:900;"' : 'style="background: #4d575f !important; color: #fff !important; font-weight:900;"';
		$style_gold_head = ($role->id==9 || $role->id==10) ? 'style="background: #7b8791 !important; color: #fff !important; font-weight:900;"' : 'style="background: #4d575f !important; color: #fff !important; font-weight:900;"';
		$style_premium_head = ($role->id==11 || $role->id==12) ? 'style="background: #7b8791 !important; color:#fff; font-weight:900;"': 'style="background: #4d575f !important; color: #fff !important; font-weight:900;"';
	      
    } else {
      $style_free = "";
      $style_silver = "";
      $style_gold = "";
      $style_premium = "";
      $style_free_head = 'style="background: #4d575f !important; color: #fff !important; font-weight:900;"';
      $style_silver_head = 'style="background: #4d575f !important; color: #fff !important; font-weight:900;"';
      $style_gold_head = 'style="background: #4d575f !important; color: #fff !important; font-weight:900;"';
      $style_premium_head = 'style="background: #4d575f !important; color: #fff !important; font-weight:900;"';
    } // if (!Yii::$app->user->isGuest)
	

?>
<!-- TITLE -->
	<span class="title_holder_home" style="margin-bottom: 0px;"> 
		<h2><i class="fa fa-tasks"></i>&nbsp;<?php echo Yii::t('app', 'Servicemapp Membership'); ?></h2>
		<p><?php echo Yii::t('app', 'The table of available memberships plans and their abilities on Servicemapp.'); ?></p>
	</span>


<table class="membership table-striped table-hover table-bordered">
	<tr>
		<td class="head_td" style="font-size:30px;"><?php echo Yii::t('app', 'Servicemapp Membership'); ?></td>
		<td class="head_td" <?php echo $style_free; ?>>
			<div class="fs_16" style="margin-bottom:10px;">FREE</div>
			<div class="fs_30"><?php echo Yii::t('app', '0'); ?></div>
			<div class="fs_12" style="color: #ccc; font-weight:700;"><?php echo Yii::t('app','EUR').'/'.Yii::t('app','monthly'); ?></div>
		</td>		
		<td class="head_td" <?php echo $style_silver; ?>>
			<div class="fs_16" style="margin-bottom:10px;">SILVER</div>
			<div class="fs_30"><?php echo Yii::t('app', '9.99'); ?></div>
			<div class="fs_12" style="color: #ccc; font-weight:700;"><?php echo Yii::t('app','EUR').'/'.Yii::t('app','monthly'); ?></div>
		</td>
		<td class="head_td" <?php echo $style_gold; ?>>
			<div class="fs_16" style="margin-bottom:10px;">GOLD</div>
			<div class="fs_30"><?php echo Yii::t('app', '24.99'); ?></div>
			<div class="fs_12" style="color: #ccc; font-weight:700;"><?php echo Yii::t('app','EUR').'/'.Yii::t('app','monthly'); ?></div>
		</td>
		<td class="head_td" <?php echo $style_premium; ?>>
			<div class="fs_16" style="margin-bottom:10px;">PREMIUM</div>
			<div class="fs_30"><?php echo Yii::t('app', '59.99'); ?></div>
			<div class="fs_12" style="color: #ccc; font-weight:700;"><?php echo Yii::t('app','EUR').'/'.Yii::t('app','monthly'); ?></div>
		</td>
	</tr>
	<?php 
	if (!Yii::$app->user->isGuest) { ?>
	<tr>
		<td><?php echo Yii::t('app', 'Upgrade your plan'); ?></td>
		<td <?php echo $style_free; ?>><?php echo $free; ?></td>
		<td <?php echo $style_silver; ?>><?php echo ($role->id==7 || $role->id==8) ?  Yii::t('app', 'Current plan') : $button_silver; ?></td>
		<td <?php echo $style_gold; ?>><?php echo ($role->id==9 || $role->id==10) ?  Yii::t('app', 'Current plan') : $button_gold; ?></td>
		<td <?php echo $style_premium; ?>><?php echo ($role->id==11 || $role->id==12) ?  Yii::t('app', 'Current plan') : $button_premium; ?></td>		
	</tr>
	<?php } ?>
	<tr>
		<td style="background: #4d575f; color: #fff; font-size:16px; font-weight:900;"><?php echo Yii::t('app', 'For Users'); ?></td>
		<td <?php echo $style_free_head; ?>>FREE</td>
		<td <?php echo $style_silver_head; ?>>SILVER</td>
		<td <?php echo $style_gold_head; ?>>GOLD</td>
		<td <?php echo $style_premium_head; ?>>PREMIUM</td>		
	</tr>
		
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Browse/View Requests'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>		
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Browse/View Providers'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Browse/View Deals'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Browse/View Services'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Send/Receive Messages'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Send Normal Requests'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Subscribe on Deals'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>		
	
	
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Send Sealed Requests'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Send Featured Requests'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Send Fulltime Requests'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Send Assisted Requests'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>

	<tr>
		<td style="background: #4d575f; color: #fff; font-size:16px; font-weight:900;"><?php echo Yii::t('app', 'For Providers'); ?></td>
		<td <?php echo $style_free_head; ?>>FREE PRO</td>
		<td <?php echo $style_silver_head; ?>>SILVER PRO</td>
		<td <?php echo $style_gold_head; ?>>GOLD PRO</td>
		<td <?php echo $style_premium_head; ?>>PREMIUM PRO</td>
	</tr>
	
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Send Normal Bids'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Create Normal Deals'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>	
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Create Featured Deals'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'See Full Request Details'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Featured on Industry Home Page'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>	
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Send Featured Bids'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Send Sealed Bids'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>

	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Contact Request Sender'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Featured Deals on Industry Home Page'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-check green"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Banners on Industry Home Page'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_gold; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_premium; ?>><i class="fa fa-check green"></i></td>
	</tr>
	<tr>
		<td class="heading_td"><?php echo Yii::t('app', 'Monthly Reports'); ?></td>
		<td <?php echo $style_free; ?>><i class="fa fa-times red"></i></td>
		<td <?php echo $style_silver; ?>><?php echo Yii::t('app', 'Standard'); ?></td>
		<td <?php echo $style_gold; ?>><?php echo Yii::t('app', 'Advanced'); ?></td>
		<td <?php echo $style_premium; ?>><?php echo Yii::t('app', 'Full'); ?></td>
	</tr>
		
</table>