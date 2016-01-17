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
                <?= Card::widget([
                    'cardData' => $this->cardData, // Card Picture
                ]);
            ?>

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
            <?php // Details Widget ?>
        </div>

        <div class="grid-center" style="">
            <div class="grid-row" style="margin-top:-20px;">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>  
             <?php /* WIDGET: TABS */ ?>
                <?= Tabs::widget([
                    'tabs'=>$this->tabs,
                ]); ?>    
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData'=>$this->pageTitle,
                ]); ?>          
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php /* WIDGET: STATS */ ?>
                <?= Stats::widget([
                    'boxData'=>$this->stats,
                ]); ?>
            <?php // Feed ?>
            <?php // News/Ads ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>