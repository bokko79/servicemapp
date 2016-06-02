<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
$session = Yii::$app->session;

$state = $session->get("state");
$logo_url = Html::img(Yii::$app->homeUrl.'images/logo/logo3.png', ['alt'=>'Servicemapp Logo', 'class'=>'', 'style' => 'opacity:.3; 
  -webkit-filter: drop-shadow(1px 1px 1px #666) grayscale(100%);', 'width'=>42]);
?>

<div class="container" style="">
	<div class="content" style="">
	<?= $renderIndex ? '<div class="center">'.Html::a($logo_url, '/', ['class' => '']).'</div>' : null ?>
	<?php if($state!='' && $renderIndex): ?>
		<h3 style="margin:15px 0 0; text-align:center"><?= ($state=='order') ? 'Izaberite uslugu koju želite da poručite' : 'Izaberite uslugu koju želite da ponudite' ?></h3>
		<hr>
	<?php endif; ?>
		<?= $this->render('autocomplete.php', ['renderIndex'=>$renderIndex]) ?>
		<div class="links">
			<?= Html::a('Uslužne delatnosti', null, ['class'=>($renderIndex ? 'industries-six-boxes-link' : 'industries-six-boxes-link-mini')]); ?> | 
			<?= Html::a('Predmeti i proizvodi', null, ['class'=>'objects-six-boxes-link']); ?>
		</div>		
	</div>
</div>