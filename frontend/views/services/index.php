<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = Yii::t('app', 'Index usluga');
$this->params['breadcrumbs'][] = $this->title;
$this->params['getService'] = $getService;
$this->params['industry'] = $industry;

$this->cardData = [
    'pic' => ($industry) ? 'industries/'.$industry->id : null, 
];

$this->profileTitle = [
    'icon'          => ($industry) ? $industry->icon : null,
    'title'         => ($industry) ? Yii::$app->operator->sentenceCase($industry->tName) : null, 
    'description'   => ($industry) ? $industry->t[0]->description : null,
];

$this->stats = [
    ['title'=>'Porudžbine', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Provajderi', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Promocije', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];
?>

<div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }' style="margin-top:40px;">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_card',
        'summary' => '',
    ]) ?>
</div>
