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

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Market'), 'url' => ['/market']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->stats = [
    ['title'=>'Posete', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Komentari', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];
?>
<?= $this->render('_card', [
        'model' => $model,
    ]) ?>

<h1>
    <?= Html::encode('Ponude') ?>
    <span class="float-right fs_12 bold">
        sortiraj po 
        <?= Html::dropDownList('sort', null, [
                                        'value1' => 'time ascending',
                                        'value2' => 'time descending',
                                    ], []) ?>
    </span>
</h1>
    <div class="card_container record-full fadeIn animated" id="card_container" style="float:none;">
        <div class="bids-area animated fadeIn">
            <?php foreach($model->bids as $bid): ?>
                <?= $this->render('/bids/_card', [
                    'model' => $bid,
                ]) ?>
            <?php endforeach; ?>
        </div>
    </div>

<h1><?= Html::encode('Komentari') ?></h1>
    <div class="card_container record-full fadeIn animated" id="card_container" style="float:none;">
        <div class="comments-area fadeIn animated">
            <?php foreach($model->activity->comments as $comment): ?>
            <?= $this->render('/activities/_comment', [
                'comment' => $comment,
                'class' => '',
            ]) ?>
            <?php endforeach; ?>                  
        </div>
        <div class="secondary-context avatar-padded fadeIn animated">
            <?php $form = kartik\widgets\ActiveForm::begin([
                'id' => 'form-horizontal',
                'type' => ActiveForm::TYPE_INLINE,
            ]); ?>

            <?= $form->field($model, 'validity', [
                    'addon' => [
                        'append' => [
                            'content' => Html::button('Kometar', ['class'=>'btn btn-primary']), 
                            'asButton' => true
                        ]
                    ],
                    'inputOptions' => ['style' => 'width:100%;'],
                    'options' => ['style' => 'width:100%;'],
                ]) ?>
            <?php ActiveForm::end(); ?>         
        </div> 
    </div>