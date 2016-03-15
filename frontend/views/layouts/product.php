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
	<?php if($this->params['presentation']->images): ?>
    <div class="media-area" style="position:absolute; left: 0; right: 0;">
    	<?php foreach ($this->params['presentation']->images as $media):
    		$media_items[] = [
    			'img' => '../images/presentations/full/'.$media->image->ime,
				'thumb' => '../images/presentations/thumbs/'.$media->image->ime,
				'full' => '../images/presentations/full/'.$media->image->ime, // Separate image for the fullscreen mode.
    			'fit' => 'cover',
    		]; ?>
        <?php endforeach; ?>
    <?= \metalguardian\fotorama\Fotorama::widget(
            [
                'options' => [
                    'loop' => true,
                    'hash' => true,
                    'allowfullscreen' => 'native',
                    'width' => '100%',
                    'height' => '360',
                    'maxheight' => '100%',
                    'minwidth'=> '1380',
                    'ratio' => 1920/360,
                    'nav' => false,
                    'fit' => 'none',
                ],
                'items' => $media_items,
                //'tagName' => 'span',
                'useHtmlData' => false,
                'htmlOptions' => [
                    'style'=>'text-align:center; margin:0 auto;',
                    'class'=>'full-width-cover'
                ],
            ]
        ) ?>        
    </div>

    <?php endif; ?>
    <div class="grid-container">
		<div class="grid-row overflow-hidden border-bottom">
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
		<div class="grid-row overflow-hidden"  style="margin-top:200px;">
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