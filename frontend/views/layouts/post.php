<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">
    <div class="grid-row" style="margin-bottom:20px;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>

    <div class="grid-row">
        <div class="grid-leftacross">
            <?php // Title Widget ?>
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Menu ?>
            <?php // News/Ads ?>

            <div class="card_container teaser-270 grid-item fadeInUp animated" id="card_container" style="float:none;">
                <a href="<?= Url::to('/services') ?>">
                    <div class="media-area">                
                        <div class="image">
                            <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
                        </div>
                    </div>
                    <div class="primary-context">
                        <div class="head">Heading</div>
                        <div class="subhead">Lorem ipsum</div>
                    </div>
                    <div class="secondary-context cont">
                        <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                        <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                        <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.</p>
                    </div>
                    <div class="action-area">
                        <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
                    </div>
                </a>
            </div>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>