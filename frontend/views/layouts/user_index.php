<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\widgets\Card;
use frontend\widgets\Tabs;
use frontend\widgets\PageTitle;
use frontend\widgets\Stats;
?>
<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<div class="grid-container">    
    <div class="grid-row">
        <div class="grid-left">
            <?php /* WIDGET: CARD */ ?>
                <?php $user = \frontend\models\User::findOne(Yii::$app->user->id); ?>
                <?= Card::widget([
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
            <div class="grid-row" style="">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>  
            <?php /* WIDGET: TABS */ ?>
                <?= Tabs::widget([
                    'tabs'=>[
                        ['url'=>Url::to('/index'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Index'), 'active'=>'provider/services'],
                        ['url'=>Url::to('/contact-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Contact'), 'active'=>''],
                        ['url'=>Url::to('/about-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'About'), 'active'=>''],
                        ['url'=>Url::to('/users'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Users'), 'active'=>''],
                    ],
                ]); ?>    
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData'=>$this->pageTitle,
                ]); ?>
            <?= $this->render('partial/quick-forms.php') ?>  
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