<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MsgThreadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inbox');
$this->params['breadcrumbs'][] = $this->title;

$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista mojih sačuvanih predmeta usluga i njihove karakteristike. Klikom na dugme desno "dodaj/izbaci predmet" pređite na stranicu za izbor i izaberite predmet.').'</p>';
$pageDescription .= '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Kada izaberete Vaš predmet usluge, na ovoj stranici se nalazi spisak svih izabranih predmeta. Klikom na naslov svakog njih možete ih dodatno podešavati i tako olakšati i ubrzati kupovinu ili naručivanje usluga.').'</p>';
$this->pageTitle = [
    'icon' => 'cube',     
    'title' => Html::encode($this->title).Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Nova poruka'), ['create'], ['class' => 'btn btn-success btn-sm float-right']),
    'description' => $pageDescription,
    'search' => null,
];

$this->stats = [
    ['title'=>'Zahtevi', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Promocije', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];
?>
<div class="msg-thread-index">

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'summary' => false,
    ]) ?>

</div>
