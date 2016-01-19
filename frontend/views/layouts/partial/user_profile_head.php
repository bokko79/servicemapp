<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Card;
use frontend\widgets\Tabs;
use frontend\widgets\ProfileTitle;
use frontend\widgets\Stats;
use frontend\widgets\ProfileSubNav;
use yii\helpers\Html;
use yii\helpers\Url;
?>	
<div class="profile_head">
	<!-- COVER PHOTO -->
	<div class="cover_user_profile"></div>
	<!-- HEADER -->
	<div class="grid-container">
		<div class="grid-row">
			<div class="grid-left">
				<?php /* WIDGET: CARD */ ?>
				<?= Card::widget([
					'cardData' => $this->cardData, // Card Picture
					'scroller' => false,
				]) ?>
			</div>

			<div class="grid-center" style="height:215px;">				
				<?php /* WIDGET: TABS */ ?>
				<?= Tabs::widget([
					'tabs' => $this->tabs,
				]) ?>

				<?php /* WIDGET: PROFILETITLE */ ?>
				<?= ProfileTitle::widget([
					'titleData' => $this->profileTitle, // Card Picture
				]) ?>
			</div>
		
			<div class="grid-right">
				<?php /* WIDGET: STATS */ ?>
				<?= Stats::widget([
					'boxData'=>$this->stats,
				]) ?>
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<?= Html::a('<i class="fa fa-cog"></i>', Url::to('/'.Yii::$app->user->username.'/setup'), ['class'=>'btn btn-default']); ?>
					<?= Html::a('<i class="fa fa-bell"></i>', Url::to('/'.Yii::$app->user->username.'/notifications-setup'), ['class'=>'btn btn-default']); ?>
					<?= Html::a('<i class="fa fa-dot-circle-o"></i>', Url::to('/'.Yii::$app->user->username.'/follow-services'), ['class'=>'btn btn-default']); ?>
					<?= Html::a('<i class="fa fa-user"></i>', Url::to('/membership'), ['class'=>'btn btn-default']); ?>
				</div>
			</div>
		</div>			
	</div>
</div>

<div class="profile_head_stick fadeInDown animated">
	<div class="profile_head_container grid-container" style="">
		<?php /* WIDGET: PROFILE HEAD NAV */ ?>
		<?= ProfileSubNav::widget([
			'profileSubNavData'=>$this->profileSubNavData,
		]) ?>
	</div>
</div>
	