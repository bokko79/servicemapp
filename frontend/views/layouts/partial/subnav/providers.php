<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<ul class="">
	<li><?= Html::a('Preporučeni', Url::to(), []) ?></li>
	<li><?= Html::a('Pregledani', Url::to(), []) ?></li>
	<li><?= Html::a('Popularni', Url::to(), []) ?></li>
</ul>