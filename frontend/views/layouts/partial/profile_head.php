<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Cardee;
use frontend\widgets\Tabs;
use frontend\widgets\ProfileTitle;
use frontend\widgets\Stats;
?>	
<div class="profile_head">
	<!-- COVER PHOTO -->
	<div class="cover_user_profile"></div>
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

			<div class="grid-center" style="height:215px;">
				
				<?php /* WIDGET: TABS */ ?>
				<?= Tabs::widget([
					'tabs' => $this->tabs,
				]);
				?>

				<?php /* WIDGET: PROFILETITLE */ ?>
				<?= ProfileTitle::widget([
					'titleData' => $this->profileTitle, // Card Picture
				]);
				?>
			</div>
		
			<div class="grid-right media_right_sidebar">
					<?php /* WIDGET: STATS */ ?>
					<?= Stats::widget([
						'boxData'=>$this->stats,
					]); ?>
			</div>
		</div>			
	</div>
</div>

<div class="profile_head_stick fadeInDown animated">
	<div class="profile_head_container" style="">

		<?php /* WIDGET: PROFILE HEAD NAV */ ?>
		<?php
		/*$this->widget('zii.widgets.CProfileHeadNav', array(
			'headNavData'=>$this->profileHeadNav,
			));*/
			?>

	</div>
</div>
	