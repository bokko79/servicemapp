<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\widgets\Stats;
?>

<?php $this->beginContent('@app/views/layouts/html/html_simple.php'); ?>
<div class="subnav-fixed">
    <ul class="">
        <li class="title"><?= Html::a('Sve aktivnosti', Url::to('/market'), ['class'=>'', 'onclick'=>'']) ?></li>
        <li><?= Html::a('Porudžbine', Url::to('/market'), ['class'=>'', 'onclick'=>'']) ?></li>
        <li><?= Html::a('Ponude usluga', Url::to(), []) ?></li>
        <li><?= Html::a('Promocije usluga', Url::to(), []) ?></li>
    </ul>
</div>
<?= $this->render('//orders/_summary.php', ['model'=>$this->params['model']]) ?>       

<?php
// ORDER DETAILS
    // order
    // auction
    // industry
    // ORDERED SERVICE
        // title
        // amount
        // consumers
        // note
        // media
        // specifications
        // issues
        // methods
    // location
    // time
    // frequency
    // budget
    // support
    // turn_key
    // tools
    // controls
// BIDS
// SIMILAR ORDERS
// EXPLORE
?>
<div class="grid-container margin-top-20">
    <div class="grid-row">
        <div class="grid-leftacross ">
			<?= $content ?>
		</div>                
        <div class="grid-right">            
            <?= $this->render('//layouts/partial/news.php') ?>
            <?= $this->render('//layouts/partial/footer.php') ?>
        </div>
    </div>
</div>
<?php
// BIDS
// SIMILAR ORDERS
// EXPLORE
?>

			<?= $this->render('../global-nav/glob-nav-services-body.php') ?>

<?php $this->endContent(); // HTML ?>