<?php

use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model frontend\models\UserLocations */

$this->title = Yii::t('app', 'Create User Locations');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Locations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$this->pageTitle = [
    'icon' => 'map-signs',     
    'title' => Html::encode($this->title),
    'description' => $pageDescription,
    'search' => null,
];
?>
<div class="user-locations-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
