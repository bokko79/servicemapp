<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\ProductHead;
use frontend\widgets\Card;
use frontend\widgets\OrderBox;
use kartik\widgets\ActiveForm;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$this->title = Yii::t('app', 'Porudžbina usluga') . ' #'. sprintf("%'07d\n", $model->id);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Market'). ': '. Yii::t('app', 'Porudžbine').'', 'url' => ['/market', ['filter'=>'orders']]];
$this->params['breadcrumbs'][] = $this->title;
$this->params['model'] = $model;

$this->stats = [
    ['title'=>'Posete', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Komentari', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];
?>
<?php 
// SUMMARY
    // title
    // industry
    // time
    // media
    // controls
    // status
    // stats
    // main required details
        // amount
        // consumer
        // required specifications
        // issue
        // location
        // time
// ORDER DETAILS
    // order
    // auction
    // industry
    // ORDERED SERVICE
        // title
        // amount
        // consumers
        // note
        // media
        // specifications
        // issues
        // methods
    // location
    // time
    // frequency
    // budget
    // support
    // turn_key
    // tools
    // controls
// BIDS
// SIMILAR ORDERS
// EXPLORE
?>
    <?= $this->render('viewParts/_card', [
        'model' => $model,
        'orderServices' => $model->orderServices,
    ]) ?>
    <?= $this->render('viewParts/_location', [
        'model' => $model,
    ]) ?>
    <?= $this->render('viewParts/_time', [
        'model' => $model,
    ]) ?>
    <?= $this->render('viewParts/_other', [
        'model' => $model,
    ]) ?>

<h2 class="product-section-heading">
    <?= Html::encode('Ponude') ?>
    <span class="float-right fs_12 bold">
        sortiraj po 
        <?= Html::dropDownList('sort', null, [
                                        'value1' => 'time ascending',
                                        'value2' => 'time descending',
                                    ], []) ?>
    </span>
</h2>
<hr>
<div class="card_container record-full fadeIn animated" id="card_container" style="float:none;">
    <div class="bids-area animated fadeIn">
        <?php foreach($model->bids as $bid): ?>
            <?= $this->render('/bids/_card', [
                'model' => $bid,
            ]) ?>
        <?php endforeach; ?>
    </div>
</div>