<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

$countDown = \russ666\widgets\Countdown::widget([
    'datetime' => $model->validity,
    'format' => '%-D<span class=\"fs_11\">d</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> <span class=\"fs_11\">%S</span>',
    'events' => [
        //'finish' => 'function(){location.reload()}',
    ],
]);
?> 
<div class="card_container record-full list-item" id="card_container<?= $model->id ?>" style="float:none;">
    <table class="embed-container">
        <tr>        
            <td class="header-context padding-bottom-0 gray">                
                <div class="avatar center gray-color">
                    <i class="fa fa-shopping-cart fa-3x"></i>    
                </div>
                <div class="title">
                    <div class="head second gray-color"><?= Html::a(sprintf("%'09d\n", $model->id), Url::to('/order/'.$model->id), ['class'=>'']); ?></div>
                    <div class="subhead">                 
                        <?= $model->activity->user->location->city.', '.$model->activity->user->location->country ?> <span class="divider"></span> <i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->activity->time]); ?>
                         
                    </div>
                </div>
                <?= Html::a(Yii::t('app', '<i class="fa fa-bookmark"></i>'), Url::to(), ['class'=>'btn btn-default btn-sm']); ?>
            </td>
            <td>
                <?php /* service */ ?>
                <?php $orderServicesCount = count($model->orderServices); ?>
                <?php foreach ($model->orderServices as $orderService): ?>
                <table class="main-context"> 
                    <tr>
                        <td class="body-area">
                            <div class="primary-context">   
                                <div class="head"><?= $orderService->service->name ?></div>
                                <div class="subhead">
                                    <div class="label label-success fs_11 margin-right-15"><i class="fa fa-building"></i> Izdavanje nekretnina</div>
                                    <?= ($orderService->qty) ? '<span class="margin-right-15"><i class="fa fa-signal fa-rotate-270 margin-right-5"></i>'.$orderService->qty.' m<sup>2</sup></span>' : null ?>
                                    <?= ($orderService->consumer) ? '<span class="margin-right-15"><i class="fa fa-user"></i> '.$orderService->consumer.'</span>' : null ?>
                                </div>
                            </div>
                            <div class="secondary-context cont">
                                <?= ($orderService->note) ? '<p><b><i class="fa fa-sticky-note"></i> Note:</b> '.$orderService->note.'</p>' : null ?>
                            </div>
                        </td>            
                    </tr>                        
                </table>             
                <?php endforeach; ?>
            </td>
            <td>
                bids
            </td>
            <td>
                <span class="label label-default"><i class="fa fa-bookmark"></i> Aukcijska porudžbina</span>
                <?= $countDown ?>
            </td>
            <td>
                <?php /* time/loc */ ?>
                <div class="secondary-context">
                    
                    <?= Html::a(Yii::t('app', 'Ponudi'), Url::to(), ['class'=>'btn btn-success btn-sm']); ?> 
                </div>
            </td>
        </tr>
    </table>
</div>