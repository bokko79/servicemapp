<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\widgets\Cardee;
use frontend\widgets\Tabs;
use frontend\widgets\PageTitle;
use frontend\widgets\Stats;
use frontend\widgets\ProfileSubNav;
?>
<?php $user = $this->params['user']; ?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>
<div class="profile_head_stick fadeInDown animated">
    <div class="profile_head_container grid-container" style="">
        <?php /* WIDGET: PROFILE HEAD NAV */ ?>
        <?= ProfileSubNav::widget([
            'profileSubNavData'=>$this->profileSubNavData,
        ]) ?>
    </div>
</div>
<div class="subnav-fixed">
    <?= $this->render('partial/subnav/user_profile.php', ['user'=>$user]) ?>
</div>
<div class="grid-container" style="margin-top:70px;">    
    <div class="grid-row">
        <div class="grid-left">
            <?php /* WIDGET: CARD */ ?>
                <?= Cardee::widget([
                    'cardData' => [
                        'pic' => null,        
                        'head' => ($user->fullname) ? $user->fullname : $user->username,
                        'subhead' => ($user->is_provider==1) ? 'provider' : 'user',
                    ], // Card Picture
                ]);
            ?>
            <?php // Details Widget ?>
            <?= $this->render('partial/user_details.php', ['user'=>$user]) ?>
        </div>

        <div class="grid-center" style="">   
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