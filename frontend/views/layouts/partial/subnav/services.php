<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<ul class="">
	<li class="header">Akcije</li>
	<li><?= Html::a('Naručite uslugu', Url::to(['/services', 's'=>'order']), []) ?></li>
	<li><?= Html::a('Ponudite uslugu', Url::to(['/services', 's'=>'present']), []) ?></li>
	<li class="divider"></li>
	<li class="header">Filteri</li>
	<li><?= Html::a('<i class="fa fa-bookmark"></i> Obeležene usluge', Url::to(['/services', 'filter'=>'bookmark']), []) ?></li>
	<li><?= Html::a('<i class="fa fa-history"></i> Usluge koje ste poručivali', Url::to(['/services', 'filter'=>'ordered']), []) ?></li>
	<li><?= Html::a('<i class="fa fa-eye"></i> Pregledane usluge', Url::to(['/services', 'filter'=>'visited']), []) ?></li>
	<li><?= Html::a('<i class="fa fa-star"></i> Popularne usluge', Url::to(['/services', 'filter'=>'popular']), []) ?></li>	
</ul>