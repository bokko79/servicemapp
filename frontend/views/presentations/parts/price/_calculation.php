<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>

<input type="hidden" id="user_provision_value" value="<?= Yii::$app->user->isGuest ? 19 : Yii::$app->user->getRole() ?>">
<div class="hint calculated_provision_price margin-bottom-20" style="<?= $model->price ? '' : 'display:none' ?>">
	<div class="col-sm-3 right"><b><i class="fa fa-exclamation-triangle"></i> Važna napomena:</b></div>
	<div class="col-sm-9 margin-bottom-20">			 
		Na osnovu Vašeg članstva na servicemapp.com i unetog iznosa cene izvršenja usluge <?= $service->tName ?>:<br>
		<ul class="disc padding-left-20">
			<li class="padding-left-20">provizija na naše usluge su <b><span class="provision"></span>%</b></li>
			<li class="padding-left-20">Vaša eventualna zarada je <b><span class="earnings"></span></b></li>
		</ul>
		Saznajte više <?= Html::a('ovde', Url::to(), []) ?>.
	</div>
</div>