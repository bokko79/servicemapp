<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<ul class="">
    <li class=""><?= Html::a('<i class="fa fa-arrow-left-circle"></i> Nazad', null, ['class'=>'btn btn-default']); ?></li>
    <li class="float-right button">
        <div class="btn-group btn-group-sm" role="group" aria-label="...">
            <?= Html::a(Yii::t('app', '<i class="fa fa-sliders"></i> Detaljna pretraga'), null, ['class' => 'btn btn-default more-filters']) ?>
        </div>
    </li> 
</ul>