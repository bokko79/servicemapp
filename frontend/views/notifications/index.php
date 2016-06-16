<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'My notifications');
$this->params['breadcrumbs'][] = $this->title;

$this->params['user'] = $user;

$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$pageDescription .= '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Kada izaberete Vaš predmet usluge, na ovoj stranici se nalazi spisak svih izabranih predmeta. Klikom na naslov svakog njih možete ih dodatno podešavati i tako olakšati i ubrzati kupovinu ili naručivanje usluga.').'</p>';
$this->pageTitle = [
    'icon' => 'bell',     
    'title' => Html::encode($this->title).Html::a('<i class="fa fa-wrench"></i>&nbsp;'.Yii::t('app', 'Podesi obaveštenja'), Url::to('/'.$user->username.'/notifications-setup'), ['class' => 'btn btn-success btn-sm float-right']),
    'description' => null,
    'search' => null,
];

$this->cardData = [
    'pic' => null,        
    'head' => ($user->fullname) ? $user->fullname : $user->username,
    'subhead' => ($user->is_provider==1) ? 'provider' : 'user',   
];

$this->stats = [
    ['title'=>'Zahtevi', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Promocije', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];

// <!-- TABS -->
$this->tabs = [
    ['url'=>Url::to('/index'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Index'), 'active'=>'provider/services'],
    ['url'=>Url::to('/contact-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Contact'), 'active'=>''],
    ['url'=>Url::to('/about-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'About'), 'active'=>''],
    ['url'=>Url::to('/users'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Users'), 'active'=>''],
];
?>

<div class="list-container">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'summary' => false,
    ]) ?>
</div>