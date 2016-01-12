<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
use frontend\widgets\Card;
use frontend\widgets\Tabs;
use frontend\widgets\ProfileTitle;
use frontend\widgets\Stats;
?>
<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<div class="grid-container">
    <div class="grid-row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
    <div class="grid-row">
        <div class="grid-left">
            <?php /* WIDGET: CARD */ ?>
                <?= Card::widget([
                    'cardData' => $this->cardData, // Card Picture
                ]);
            ?>
            <?php // Details Widget ?>
        </div>

        <div class="grid-center" style="">  
            <?php // Tabs Widget ?>
            <?php // Title Widget ?>          
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