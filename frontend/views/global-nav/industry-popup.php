<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="featured">
	<h2 style="text-align:center;margin:20px 0 0;"><i class="<?php echo $sek->icon; ?>"></i>&nbsp;<?= c($sek->tName); ?></h2>	
	<hr>
	<div class="popup">	                 
		<ul class="column4" style="display:inline-flex;">
		<?php foreach ($sek->categories as $cat) {
			echo '<li class="kat" style="background: linear-gradient(to bottom, '.Yii::$app->operator->hex2rgba($sek->color, 1).', '.Yii::$app->operator->hex2rgba($sek->color, 0.9).', '.Yii::$app->operator->hex2rgba($sek->color, 0.7).')">'.$cat->tName.'</li>';
			echo '<ul>';
			// sve delatnosti
			foreach ($cat->industries as $del) {
				echo '<li>';
					echo '<a href="'.Url::to(['/services', 'i'=>$del->id]).'">'.c($del->tName).'</a>';
				echo '</li>';			
			} // foreach ($kat->delatnost as $del)

			echo '</ul>';
		} // foreach ($sektor[0]->kategorijes as $kat) ?>

		</ul>
	</div>
</div>