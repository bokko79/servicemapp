<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Cardee;
use frontend\widgets\Tabs;
use frontend\widgets\ProfileTitle;
use frontend\widgets\Stats;
?>	
<div class="profile_head">
	<!-- HEADER -->
	<div class="grid-container">
		<div class="grid-row">
			<div class="grid-left">
				<?php /* WIDGET: CARD */ ?>
				<?= Cardee::widget([
					'cardData' => $this->cardData, // Card Picture
					'scroller' => false,
				]);
				?>
			</div>

			<div class="grid-center index_services" style="height:240px;position:relative;">
				<?php /* WIDGET: PROFILETITLE */ ?>
				<?= ProfileTitle::widget([
					'titleData' => $this->profileTitle, // Card Picture
				]);
				?>
			</div>
		
			<div class="grid-right">
				<?php /* WIDGET: STATS */ ?>
				<?= Stats::widget([
					'boxData'=>$this->stats,
				]); ?>
			</div>
		</div>					
	</div>
</div>
	