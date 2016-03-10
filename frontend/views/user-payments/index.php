<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserPaymentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Moji načini plaćanja');
$this->params['breadcrumbs'][] = $this->title;
$this->params['user'] = $user;
$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$pageDescription .= '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Kada izaberete Vaš predmet usluge, na ovoj stranici se nalazi spisak svih izabranih predmeta. Klikom na naslov svakog njih možete ih dodatno podešavati i tako olakšati i ubrzati kupovinu ili naručivanje usluga.').'</p>';
$this->pageTitle = [
    'icon' => 'credit-card',     
    'title' => Html::encode($this->title).Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Dodaj nov način plaćanja'), Url::to('/new-payment'), ['class' => 'btn btn-success btn-sm float-right']),
    'description' => $pageDescription,
    'search' => $searchModel,
];
$this->stats = [
    ['title'=>'Zahtevi', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Promocije', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];
?>
<div class="list-container">

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'summary' => false,   
    ]) ?>

</div>
