<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ListView;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $model frontend\models\CsIndustries */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Industries'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['renderIndex'] = false;
$this->params['industry'] = $model;

$this->cardData = [
    'pic' => ($model) ? 'industries/'.$model->id : null, 
];

$this->profileTitle = [
    'icon'          => ($model) ? $model->icon : null,
    'title'         => ($model) ? c($model->tName) : null, 
    'description'   => ($model) ? $model->t[0]->description : null,
];

$this->stats = [
    ['title'=>'Porudžbine', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Provajderi', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Promocije', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];

$items = [];
/* items */
$services = count($model->services)>0 ? [
        'label'=>'<i class="fa fa-dot-circle-o"></i> Usluge '.count($model->services),
        'content'=>'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:40px;">'.
        ListView::widget([
            'dataProvider' => $dataProvider_services,
            'itemView' => '_card',
            'summary' => '',
        ]) .
        '</div>'] : null;
$presentations = count($model->presentations)>0 ? [
        'label'=>'<i class="fa fa-tag"></i> Ponude '.count($model->presentations),
        'content'=>'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:40px;">'.
        ListView::widget([
            'dataProvider' => $dataProvider_presentations,
            'itemView' => '_card',
            'summary' => '',
        ]) .
        '</div>',
        'active'=>false,
    ] : null;
$providers = count($model->providers)>0 ? [
        'label'=>'<i class="fa fa-flag"></i> Pružaoci usluga '.count($model->providers),
        'content'=>'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:40px;">'.
        ListView::widget([
            'dataProvider' => $dataProvider_providers,
            'itemView' => '_card',
            'summary' => '',
        ]) .
        '</div>',
        'active'=>false,
    ] : null;
$promotions = count($model->promotions)>0 ? [
        'label'=>'<i class="fa fa-cube"></i> Promocije usluga '.count($model->promotions),
        'content'=>'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:40px;">'.
        ListView::widget([
            'dataProvider' => $dataProvider_promotions,
            'itemView' => '_card',
            'summary' => '',
        ]) .
        '</div>',
        'active'=>false,
    ] : null;
$orders = count($model->orders)>0 ? [
        'label'=>'<i class="fa fa-cube"></i> Promocije usluga '.count($model->orders),
        'content'=>'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:40px;">'.
        ListView::widget([
            'dataProvider' => $dataProvider_orders,
            'itemView' => '_card',
            'summary' => '',
        ]) .
        '</div>',
        'active'=>false,
    ] : null;

$comments = 1==1 ? [
        'label'=>'<i class="fa fa-comments"></i> Forum',
        'content'=>null,
        'active'=>false,
    ] : null;

    if($services) $items[] = $services;
    if($presentations) $items[] = $presentations;
    if($providers) $items[] = $providers;
    if($promotions) $items[] = $promotions;
    if($orders) $items[] = $orders;
    if($comments) $items[] = $comments;

$this->params['items'] = $items;
?>
<?= TabsX::widget([
        'items' => $items,
        'position'=>TabsX::POS_ABOVE,
        'encodeLabels'=>false,
        'containerOptions' => ['class'=>'tab_track']
    ]) ?>