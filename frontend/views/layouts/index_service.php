<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>
<div class="subnav-fixed">
    <ul class="">
        <li><?= Html::a('Sve usluge', Url::to('/services'), ['class'=>'', 'onclick'=>'']) ?></li>
        <li><?= Html::a('Obeležene', Url::to(), []) ?></li>
        <li><?= Html::a('Poručene', Url::to(), []) ?></li>
        <li><?= Html::a('Pregledane', Url::to(), []) ?></li>
        <li class="float-right button">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <?= Html::a('Naruči uslugu', null, ['class'=>'btn btn-default control order-service']); ?>
                <?= Html::a('Promoviši uslugu', null, ['class'=>'btn btn-default control promote-service']); ?>
                <?= Html::a('Najavi događaj', null, ['class'=>'btn btn-default control announce-event']); ?>
            </div>
        </li> 
    </ul>
</div>

<div class="grid-container" style="margin-top:70px;">
    <div class="grid-row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
</div>
<?php // $this->render('partial/service_head.php') ?>
<div class="grid-container">    
    <div class="grid-row">
        <div class="grid-full">           
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>