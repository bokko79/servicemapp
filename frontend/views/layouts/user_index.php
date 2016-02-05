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
<?php $user = \frontend\models\User::findOne(Yii::$app->user->id); ?>

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
    <?= $this->render('partial/subnav/user_profile.php') ?>
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
            <div class="card_container record-200 card-tile" id="card_container" style="float:none; clear:both;">
                <a href="<?= Url::to('/services') ?>">                   
                    <div class="primary-context right">
                        <div class="head dim"><i class="fa fa-user"></i></div>
                    </div>
                    <div class="secondary-context cont">
                        <p>test: @username</p>
                    </div> 
                </a>
            </div>
            <div class="card_container record-200 card-tile" id="card_container" style="float:none; clear:both;">
                <a href="<?= Url::to('/services') ?>">                   
                    <div class="primary-context right">
                        <div class="head dim"><i class="fa fa-map-marker"></i></div>
                    </div>
                    <div class="secondary-context cont">
                        <p>test: @username</p>
                    </div>            
                    <div class="action-area right">
                        <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
                    </div>
                </a>
            </div>
            
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