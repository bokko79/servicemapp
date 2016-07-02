<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use common\models\CsSectors;
?>
<div class="six_boxes_container_industries fadeInDown animated" style="display:none;">
	<span class="turn_off_glob" onclick="close_six_boxes();"><i class="fa fa-times"></i></span>
	<div class="industry_6box_container">
		<div class="industry_6box row-fluid">
			<p class="paragraph" style="text-align:center; margin:0 0 20px 0; color:#aaa; font-size:11px;"><?= Yii::t('app', 'Choose category by clicking on the colored boxes and then select one of the service industry from the list below.') ?></p>

			<?php foreach (CsSectors::find()->all() as $key=>$sek) { ?>
				<div id="sektor<?= $key+1 ?>" class="fadeInDown animated col-sm-2" <?= ($key==0) ? 'style="margin-left:0;"' : ''; ?>>
					<div class="popup" style="background: linear-gradient(to bottom, <?= Yii::$app->operator->hex2rgba($sek->color, 0.1) ?>, <?= Yii::$app->operator->hex2rgba($sek->color, 0.9) ?>, <?= Yii::$app->operator->hex2rgba($sek->color, 1) ?>)">
						<span class="icon"><i class="<?= $sek->icon ?>"></i></span>
						<span class="text"><?= $sek->tName; ?></span>
					</div>
				</div>
			<?php } // foreach ($sektor as $key=>$sek) ?>
		</div>	
	</div>

	<?php foreach (CsSectors::find()->all() as $key=>$sek) { ?>
		<div class="row-fluid subindustry<?php echo $key+1; ?>"></div>
	<?php } ?>

	<div class="subindustry0"></div>
</div>