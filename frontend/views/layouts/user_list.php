<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Stats;
use frontend\widgets\ProfileSubNav;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>
<div class="profile_head_stick fadeInDown animated">
    <div class="profile_head_container grid-container" style="">
        <?php /* WIDGET: PROFILE HEAD NAV */ ?>
        <?= ProfileSubNav::widget([
            'profileSubNavData'=>$this->profileSubNavData,
        ]) ?>
    </div>
</div>
<div class="subnav-fixed">
    <?= $this->render('partial/subnav/user_profile.php') ?>
</div>
<div class="grid-container" style="margin-top:70px;">    

    <div class="grid-row">
        <div class="grid-leftacross">
            <?php // Title Widget ?>
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php /* WIDGET: STATS */ ?>
                <?= Stats::widget([
                    'boxData'=>$this->stats,
                ]); ?>
            <?= $this->render('partial/news-feed.php') ?>
            <?= $this->render('partial/news.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>