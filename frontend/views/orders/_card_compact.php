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
<div class="embed-container">
    <?php /* if ($model->activity->activity!='order' && $model->activity->activity!='promotion' && $model->activity->activity!='proservice' && $model->activity->activity!='agreement'): */ ?>
    
    <div class="header-context padding-bottom-0 gray">                
        <div class="avatar center gray-color">
            <i class="fa fa-shopping-cart fa-3x"></i>    
        </div>
        <div class="title">
            <div class="head second gray-color"><?= Html::a('Porudžbina #'. sprintf("%'09d\n", $model->id), Url::to('/order/'.$model->id), ['class'=>'']); ?></div>
            <div class="subhead">                 
                <?= $model->activity->user->location->city.', '.$model->activity->user->location->country ?> <span class="divider"></span> <i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->activity->time]); ?>
                <span class="label label-default"><i class="fa fa-bookmark"></i> Aukcijska porudžbina</span> <?= $countDown ?>
            </div>
        </div>
        <div class="action right">
            <?= Html::a(Yii::t('app', '<i class="fa fa-bookmark"></i>'), Url::to(), ['class'=>'btn btn-default btn-sm']); ?>
            <?= Html::a(Yii::t('app', 'Ponudi'), Url::to(), ['class'=>'btn btn-success btn-sm']); ?>    
        </div>
    </div>
    <?php /* time/loc */ ?>
    <div class="secondary-context gray cont avatar-padded hidden fadeInDown animated ">
        <table class="widget">
            <tr>
                <td class="widget-title" style="">porudžbina poslata</td>
                <td class="widget-title right" style="">aukcija traje još max</td>
            </tr>
            <tr>
                <td class=""><?= Yii::$app->formatter->asDateTime($model->activity->time, 'php:D, d.M ') ?><?= Yii::$app->formatter->asDateTime($model->activity->time, 'php:@H:i') ?>
                    </td>
                <td class="headline major right">
                    <span class="label label-info"></span>
                </td>
            </tr>
            <tr class="strikeout">
                <td class="line"><i class="fa fa-circle fa-lg"></i></td>
                <td class="line right"><i class="fa fa-gavel fa-lg"></i></td>
            </tr>
            <tr>
                <td class="subline"><?= $model->loc->city ?></td>
                <td class="subline action"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <div class="progress">
                      <div class="progress-bar" role="progressbar" aria-valuenow="<?= $model->validityPercentage() ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $model->validityPercentage() ?>%;">
                        
                      </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <?php /* service */ ?>
    <?php $orderServicesCount = count($model->orderServices); ?>
    <?php foreach ($model->orderServices as $orderService): ?>
    <table class="main-context"> 
        <tr>
            <td class="body-area avatar-padded">
                <div class="primary-context">
                    <div class="gray-color fs_10">
                       Poručena usluga #1
                    </div>
                    <div class="head"><?= $orderService->service->name ?><span class="margin-left-10"><?= Html::a('<i class="fa fa-external-link"></i>', Url::to(''), ['class'=>'fs_12']) ?></span></div>
                    <div class="subhead">
                        <div class="label label-success fs_11 margin-right-15"><i class="fa fa-building"></i> Izdavanje nekretnina</div>
                        <?= ($orderService->amount) ? '<span class="margin-right-15"><i class="fa fa-signal fa-rotate-270 margin-right-5"></i>'.$orderService->amount.' m<sup>2</sup></span>' : null ?>
                        <?= ($orderService->consumer) ? '<span class="margin-right-15"><i class="fa fa-user"></i> '.$orderService->consumer.'</span>' : null ?>
                    </div>
                </div>
                <div class="secondary-context cont">
                    <?= ($orderService->note) ? '<p><b><i class="fa fa-sticky-note"></i> Note:</b> '.$orderService->note.'</p>' : null ?>
                </div>
            </td>
            <td class="media-area">
                <div >                
                    <div class="image">
                        <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>
                    </div>
                </div> 
            </td>
        </tr>                        
    </table>
    <div class="media-area hidden">
        <div>                
            <div class="image">
                <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>
            </div>
        </div> 
    </div> 
    <div class="secondary-context hidden">
        <?= ($orderService->note) ? '<p><b><i class="fa fa-sticky-note"></i> Note:</b> '.$orderService->note.'</p>' : null ?>
    </div>              
    <?php endforeach; ?>
    <?php /* time/loc */ ?>
    <div class="secondary-context cont avatar-padded">
        <table class="widget">
            <tr>
                <td class="widget-title" style="">izvršenje da počne:</td>
                <td class="widget-title" style="">izvršenje da se završi:</td>
            </tr>
            <tr>
                <td><?= Yii::$app->formatter->asDateTime($model->delivery_starts, 'php:D, d.M ') ?><?= Yii::$app->formatter->asDateTime($model->delivery_starts, 'php:@H:i') ?>
                    </td>                  
                <td class="">
                    <?= Yii::$app->formatter->asDateTime($model->delivery_ends, 'php:D, d.M ') ?><?= Yii::$app->formatter->asDateTime($model->delivery_ends, 'php:@H:i') ?>
                </td>
            </tr>
            <tr>
                <td class="subline"><i class="fa fa-map-marker fa-lg"></i> Šekspirova 7, <?= $model->loc->city ?>, SRB</td>
                <td class="subline"><?= $model->loc->city ?>, Srbija <i class="fa fa-map"></i></td>
            </tr>
        </table>
    </div>
</div>
<div class="secondary-context gray avatar-padded">
        <?= Html::a('<i class="fa fa-gavel"></i> 12', Url::to(), ['class'=>'btn btn-primary']); ?>
        <?= Html::a('<i class="fa fa-bookmark"></i> 65', Url::to(), ['class'=>'btn btn-default']); ?>        
        <?= Html::a('<i class="fa fa-envelope-o"></i>', Url::to(), ['class'=>'btn btn-default']); ?>        
</div>