<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
$session = Yii::$app->session;

$state = $session->get("state");
?>

<div class="container" style="">
	<div class="content" style="">
	<?php if($state!='' && $renderIndex): ?>
		<h3 style="margin:0; text-align:center"><?= ($state=='order') ? 'Izaberite uslugu koju želite da poručite' : 'Izaberite uslugu koju želite da ponudite' ?></h3>
		<hr>
	<?php endif; ?>
		<?= $this->render('autocomplete.php', ['renderIndex'=>$renderIndex]) ?>
		<div class="links">
			Pretražite usluge: 
			<?= Html::a('Uslužne delatnosti', null, ['class'=>($renderIndex ? 'industries-six-boxes-link' : 'industries-six-boxes-link-mini')]); ?> | 
			<?= Html::a('Predmeti usluga', null, ['class'=>'objects-six-boxes-link']); ?>
		</div>		
	</div>
</div>