<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\widgets\Stats;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>
<div class="product-head">
	<?php if($imgs = $this->params['presentation']->images): ?>
    <div class="media-area cover-product" style="background: url('../images/presentations/full/<?= $imgs[0]->image->ime ?>') no-repeat center fixed; background-size: cover;">
        <div class="backscreen"></div>
        <?php // $this->params['presentation']->coverPhotos() ?>        
    </div>
    <?php endif; ?>
    <div class="grid-container">
		<div class="grid-row overflow-hidden">
			<div class="grid-leftacross in-media">
				<?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class'=>'breadcrumb transparent wide'],
                ]) ?>
			</div>
			<div class="grid-right right" style="padding-top: 10px;">
				<?= $this->render('partial/share.php') ?>				
			</div>
		</div>
		<div class="grid-row overflow-hidden"  style="margin-top:<?= $imgs ? '201px' : '20px' ?>; position:relative; z-index:2">
			<?= $this->render('partial/product_head.php', ['model'=>$this->params['presentation']]) ?>
		</div>		
    </div>
</div>

<div class="grid-container">
    <div class="grid-row">
        <div class="grid-leftacross margin-top-20">
			<?= $content ?>
		</div>                
        <div class="grid-right">
            <?= $this->render('//layouts/partial/news-feed.php') ?>
            <?= $this->render('//layouts/partial/news.php') ?>
            <?= $this->render('//layouts/partial/footer.php') ?>
        </div>
    </div>
</div>
<div class="product-head">
    <div class="grid-container margin-bottom-20 border-bottom">
		<div class="grid-row">
			<?php // $this->render('../global-nav/glob-nav-services-body.php') ?>
		</div>
	</div>
</div>
<?php $this->endContent(); // HTML ?>