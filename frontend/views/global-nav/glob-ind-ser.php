<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\CsSectors;
?>
<p class="paragraph" style="text-align:center; margin:0 0 20px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>

<?php foreach (CsSectors::find()->all() as $key=>$sek) { ?>
	<div id="sektor<?= $key+1 ?>" class="fadeInDown animated col-sm-2" <?= ($key==0) ? 'style="margin-left:0;"' : ''; ?>>
		<div class="popup" style="background: linear-gradient(to bottom, <?= Yii::$app->operator->hex2rgba($sek->color, 0.1) ?>, <?= Yii::$app->operator->hex2rgba($sek->color, 0.9) ?>, <?= Yii::$app->operator->hex2rgba($sek->color, 1) ?>)">
			<span class="icon"><i class="<?= $sek->icon ?>"></i></span>
			<span class="text"><?= $sek->tName; ?></span>
		</div>
	</div>
<?php } // foreach ($sektor as $key=>$sek) ?>
