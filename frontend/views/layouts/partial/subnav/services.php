<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<ul class="">
	<li class="header">Filteri</li>
	<li><?= Html::a('<i class="fa fa-bookmark"></i> Obeležene usluge', Url::to(), []) ?></li>
	<li><?= Html::a('<i class="fa fa-shopping-cart"></i> Usluge koje ste poručivali', Url::to(), []) ?></li>
	<li><?= Html::a('<i class="fa fa-eye"></i> Pregledane usluge', Url::to(), []) ?></li>
	<li><?= Html::a('<i class="fa fa-star"></i> Popularne usluge', Url::to(), []) ?></li>
	<li class="divider"></li>
	<li class="header">Kategorije</li>
	<li><?= Html::a('Uslužne delatnosti', Url::to(), []) ?></li>
</ul>