<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\widgets\Alert;
use kartik\widgets\ActiveForm;
use frontend\widgets\Tabs;
use kartik\tabs\TabsX;

$this->title = 'Vaše poslovanje';

$this->stats = [
    ['title'=>'Zahtevi', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Promocije', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];
$order_content = $this->render('_search_orders.php', ['model'=>$searchModel]);
$order_content .= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemView' => 'activity/_orders',
                    'summary' => false,
                ]);
/* items */
$orders = [
        'label'=>'<i class="fa fa-file-text-o"></i> '.Yii::t('app', 'Porudžbine'),
        'content'=>	$order_content,
        'active'=>true,
    ];
$arrangements = [
        'label'=>'<i class="fa fa-tag"></i> '.Yii::t('app', 'Aranžmani'),
        'content'=>null,
    ];
$bids = [
        'label'=>'<i class="fa fa-cube"></i> '.Yii::t('app', 'Ponude'),
        'content'=>null,        
    ];
$presentations = [
        'label'=>'<i class="fa fa-tag"></i> '.Yii::t('app', 'Prezentacije'),
        'content'=>null,
    ];
$promotions = [
        'label'=>'<i class="fa fa-tag"></i> '.Yii::t('app', 'Promocije'),
        'content'=>null,
    ];
$items = [ $orders, $arrangements, $bids, $presentations, $promotions ];
?>

<h1><?= Html::encode($this->title) ?></h1>

drafts<br>
feedback<br>

<div class="margin-top-20">
    <?= TabsX::widget([
        'items' => $items,
        'position'=>TabsX::POS_ABOVE,
        'encodeLabels'=>false,
        'containerOptions' => ['class'=>'product-nav-tabs']
    ]) ?> 
</div>