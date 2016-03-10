<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = 'Izveštaj stanja';
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => [$model->username.'/home']];
$this->params['breadcrumbs'][] = ['label' => 'Finansije', 'url' => [$model->username.'/finances']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['user'] = $model;
$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$this->pageTitle = [
    'icon' => 'calculator',     
    'title' => Html::encode($this->title),
    'description' => $pageDescription,
    'h' => 2,
];
?>
kredit 0.00 EUR<br>
dobici i gubici<br>
statistika<br>
prihodi<br>
troškovi<br>
stanje<br>