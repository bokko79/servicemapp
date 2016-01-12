<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
?>
<footer id="footer">

	<div class="contact" style="margin:0;">
	
		<?= Html::a('<i class="fa fa-facebook fa-lg"></i>', 'https://www.facebook.com/servicemapp', ['class'=>'btn btn-link', 'target'=>'_blank']) ?>
        <?= Html::a('<i class="fa fa-twitter fa-lg"></i>', 'https://twitter.com/servicemappSRB', ['class'=>'btn btn-link', 'style'=>'padding: 0 10px;', 'target'=>'_blank']) ?>
        <?= Html::a('<i class="fa fa-google-plus fa-lg"></i>', 'https://plus.google.com/111378181200148646566/', ['class'=>'btn btn-link', 'target'=>'_blank'])  ?>					

	</div>

	<ul class="">
		<li><?= Html::a('Services', ['/index'], ['class'=>'', 'target'=>'_blank']) ?></li>
		<li><?= Html::a('Market', ['/index'], ['class'=>'', 'target'=>'_blank']) ?></li>
		<li><?= Html::a('Providers', ['/index'], ['class'=>'', 'target'=>'_blank']) ?></li>
		<li><?= Html::a('Info', ['/index'], ['class'=>'', 'target'=>'_blank']) ?></li>
		<li><?= Html::a('Kontakt', ['/site/contact-us'], ['class'=>'', 'target'=>'_blank']) ?></li>
	</ul>
	<?= Html::img(Yii::$app->homeUrl.'images/logo/logo46.png', ['alt'=>'Servicemapp Logo', 'width'=>80]) ?>
	<br>
	Copyright &copy; <?php echo date('Y'); ?> by Masterplan ARC.
	<br>
	<?php echo Yii::t('app', 'All Rights Reserved.'); ?>
	
</footer><!-- footer -->