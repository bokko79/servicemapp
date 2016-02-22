<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

/* items */
$industry = [
        'label'=>'<i class="fa fa-tag"></i> Izdavanje nekretnina: Veštine',
        'content'=>'<span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                            <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                            <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat.</p>',
    ];
$action = [
        'label'=>'<i class="fa fa-tag"></i> Izdavanje: Opcije',
        'content'=>'<span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                            <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                            <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat.</p>',
    ];
$object = [
        'label'=>'<i class="fa fa-cube"></i> Apartman: Karakteristike',
        'content'=>'<table class="table table-striped">
                    <tr>
                        <td>Površina</td>
                        <td>65 m<sup>2</sup></td>
                    </tr>
                    <tr>
                        <td>Broj soba</td>
                        <td>3</sup></td>
                    </tr>
                    <tr>
                        <td>Broj kupatila</td>
                        <td>1</td>
                    </tr>
                    </table>',
        'active'=>true,
    ];
$issue = [
        'label'=>'<i class="fa fa-tag"></i> Apartman: Problemi',
        'content'=>'<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat.</p>',
    ];
$additional = [
        'label'=>'<i class="fa fa-tag"></i> Ostali detalji',
        'content'=>'<span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                            <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                            <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>',
    ];
$items = [ $industry, $action, $object, $issue, $additional ];

/* maps */
$coord = new LatLng(['lat' => $model->user->userDetails->loc->lat, 'lng' => $model->user->userDetails->loc->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    
]);

$map->width = '100%';
$map->height = '420';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);


// Add marker to the map
$map->addOverlay($marker);
$map->appendScript("google.maps.event.addDomListener(mapShowTrigger, 'click', function() {
        $(this).closest('.hidden-content-container').find('div.hidden-content').toggleClass('hidden');
        initialize();
    });");
?>
<div class="card_container record-full" id="card_container" style="float:none;"> 
    <?php /* creator and product details */ ?>                   
    <div class="header-context gray">                
        <div class="avatar">
            <?= Html::img('@web/images/cards/default_avatar.jpg') ?>    
        </div>
        <div class="title">
            <div class="head second"><?= ($model->user->fullname) ? $model->user->fullname : $model->user->username ?></div>
            <div class="subhead"><?= $model->user->userDetails->loc->city ?></div> 
        </div>
        <div class="subaction right">                        
            <i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?>
        </div>
        
    </div>           
    <hr class="no-margin">
    <div class="header-context">
        <div class="avatar center gray-color">
            <i class="fa fa-shopping-cart fa-3x"></i>        
        </div>
        <div class="title">
            <div class="head second gray-color">Porudžbina br. #<?= sprintf("%'09d\n", $model->id) ?></div>
            <span class="label label-primary margin-right-10"><i class="fa fa-bookmark"></i> <?= $model->activity->type ?></span> 
                
        </div> 
        <div class="right fs_30">                        
            <i class="fa fa-refresh fa-spin"></i> 
            <?= \russ666\widgets\Countdown::widget([
                    'datetime' => $model->validity,
                    'format' => '%d<span class=\"fs_11\">d</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> %S<span class=\"fs_11\">s</span>',
                    'events' => [
                        //'finish' => 'function(){location.reload()}',
                    ],
                ]) ?>
                <?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger btn-xs no-margin']); ?>
        </div>                
    </div>           
    <hr class="no-margin">
    <?php /* service */ ?>
    <?php $orderServicesCount = count($model->orderServices); ?>
    <?php foreach ($model->orderServices as $orderService): ?>
    <div class="hidden-content-container hovering" style="position:relative;">
        <div class="header-context head">              
            <div class="avatar">
                <?= Html::img('@web/images/cards/'.$orderService->service->avatar.'.jpg') ?>          
            </div>
            <div class="title">
                <div class="head" style="color:#2196F3; font-weight:300;"><?= $orderService->service->name ?><span class="margin-left-10 fs_11"><?= Html::a('<i class="fa fa-external-link"></i>', Url::to(''), []) ?></span></div>
                <div class="subhead">
                    <div class="label label-success fs_11 margin-right-15"><i class="fa fa-building"></i> Izdavanje nekretnina</div>
                    <?= ($orderService->amount) ? '<span class="margin-right-15"><i class="fa fa-signal fa-rotate-270 margin-right-5"></i>'.$orderService->amount.'</span>' : null ?>
                    <?= ($orderService->consumer) ? '<span class="margin-right-15"><i class="fa fa-user"></i> '.$orderService->consumer.'</span>' : null ?>
                </div>                                   
            </div>

            <?= Html::a('<i class="fa '.(($orderServicesCount>1) ? 'fa-chevron-right' : 'fa-chevron-down').'"></i>', null, ['class'=>'btn btn-link float-right show-more']); ?>

        </div>
        <div class="secondary-context avatar-padded <?= ($orderServicesCount>1) ? 'hidden' : '' ?> hidden-content fadeIn animated">
            <?= ($orderService->note) ? '<p><b><i class="fa fa-sticky-note"></i> Note:</b> '.$orderService->note.'</p>' : null ?>                
        </div>
        <div class="secondary-context cont avatar-padded <?= ($orderServicesCount>1) ? 'hidden' : '' ?> hidden-content fadeIn animated">
            <?= TabsX::widget([
                'items' => $items,
                'position'=>TabsX::POS_ABOVE,
                'encodeLabels'=>false,
                'containerOptions' => ['class'=>'product-nav-tabs']
            ]) ?>                          
        </div>
        <?php if($orderService->images): ?>
        <div class="media-area <?= ($orderServicesCount>1) ? 'hidden' : '' ?> hidden-content">
            <?php foreach ($orderService->images as $media): ?>
                <?= Html::img('@web/images/cards/'.$media.'.jpg') ?>
            <?php endforeach; ?>
        </div>
        <?php endif; ?> 
        <hr class="no-margin">                 
    </div>
    <?php endforeach; ?>

    
              
    <?php /* time/loc */ ?>
    <div class="header-context">  
        <div class="avatar center gray-color">
            <i class="fa fa-calendar fa-3x"></i>    
        </div>
        <div class="title">
            <div class="subhead"><?= Yii::t('app', 'vreme') ?></div> 
            <div class="head second"><?= $model->delivery_starts ?></div>                           
        </div>
    </div>
    <?php /* time/loc */ ?>
    <div class="hidden-content-container">
        <div class="header-context">                    
            <div class="avatar center gray-color">
                <i class="fa fa-map-marker fa-3x"></i>    
            </div>
            <div class="title">
                <div class="subhead"><?= Yii::t('app', 'delivery location') ?></div> 
                <div class="head second"><?= $model->loc->city ?></div>                           
            </div>
            <?= Html::a('<i class="fa fa-chevron-right"></i>', null, ['class'=>'btn btn-link float-right show-more', 'id'=>'mapShowTrigger']); ?>
        </div>
        <div class="media-screen hidden hidden-content no-margin" id="map_container">                   
            <?= $map->display() ?>
        </div>
    </div>
    


     <?php /* price/action */ ?>
    <div class="secondary-context" style="height:84px;">
        <div class="float-left" style="">
            <div class="avatar center gray-color">
                <i class="fa fa-barcode fa-3x"></i>    
            </div>
            <div class="title">
                <div class="subhead"><?= Yii::t('app', 'cena') ?></div> 
                <div class="head black no-padding"><?= Yii::$app->formatter->asCurrency(12750, 'EUR') ?></div>
                <span class="strikethrough"><?= Yii::$app->formatter->asCurrency(13499.99, 'EUR') ?></span> <span class="label label-warning">popust 25%</span>
            </div>
        </div>
        <div class="float-right action-area no-margin no-padding" style="">
            <div class="head second padding-bottom-5 right gray-color">
                <?= \russ666\widgets\Countdown::widget([
                    'datetime' => $model->validity,
                    'format' => '%d<span class=\"fs_11\">'.Yii::t('app', 'd').'</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> %S<span class=\"fs_11\">s</span>',
                    'events' => [
                        //'finish' => 'function(){location.reload()}',
                    ],
                ]) ?>
            </div>
            <?= Html::a('<i class="fa fa-eye"></i>&nbsp;'.Yii::t('app', 'Prati'), Url::to(), ['class'=>'btn btn-link']); ?>
            <?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger no-margin']); ?>
                    
        </div>                     
    </div>                                                             
</div>