<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

$countDown = \russ666\widgets\Countdown::widget([
    'datetime' => $model->validity,
    'format' => '%-D<span class=\"fs_11\">d</span> %H<span class=\"fs_11\">h</span>',
    'events' => [
        //'finish' => 'function(){location.reload()}',
    ],
]);
?> 
<div class="embed-container">
    <?php /* if ($model->activity->activity!='order' && $model->activity->activity!='promotion' && $model->activity->activity!='proservice' && $model->activity->activity!='agreement'): */ ?>
    <div class="header-context">                
        <div class="avatar center gray-color">
            <?= Html::img('@web/images/cards/default_avatar.jpg') ?>
        </div>
        <div class="title">
            <div class="head lower"><?= ($model->activity->user->fullname) ? $model->activity->user->fullname : $model->activity->user->username ?></div>
            <div class="subhead">                 
                <?= $model->activity->user->location->city.', '.$model->activity->user->location->country ?> <span class="divider"></span> <i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->activity->time]); ?>
            </div> 
        </div>
        <div class="subaction">
        </div>
    </div>
    <div class="header-context padding-bottom-0 gray">                
        <div class="avatar center gray-color">
            <i class="fa fa-certificate fa-3x"></i>    
        </div>
        <div class="title">
            <div class="head second gray-color"><?= Html::a('Promocija usluge #'. sprintf("%'09d\n", $model->id), Url::to('/promotion/'.$model->id), ['class'=>'']); ?></div>
            <div class="subhead">                 
                <?= $countDown ?>
            </div> 
        </div>
        <div class="action right">
                <?= Html::a(Yii::t('app', '<i class="fa fa-bookmark"></i>'), Url::to(), ['class'=>'btn btn-default btn-sm']); ?>
                <?= Html::a(Yii::t('app', 'Kupi'), Url::to(), ['class'=>'btn btn-warning btn-sm']); ?>                
        </div>
    </div>
    <table class="main-context"> 
        <tr>
            <td class="body-area avatar-padded">
                <div class="primary-context">
                    <div class="head"><?= $model->title ?></div>
                    <div class="subhead">
                        <?= $model->subtitle ?>
                    </div>
                </div>
                <div class="secondary-context cont">
                    <?= ($model->promo_text) ? '<p><b><i class="fa fa-sticky-note"></i> Note:</b> '.$model->promo_text.'</p>' : null ?>
                </div>
            </td>
            <td class="media-area hidden">
                <div >                
                    <div class="image">
                        <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>
                    </div>
                </div> 
            </td>
        </tr>                        
    </table>
    <?php /* time/loc */ ?>
    <div class="secondary-context cont avatar-padded">
        <table class="widget">
            <tr>
                <td class="widget-title" style="">počinje:</td>
                <td class="widget-title" style="">izvršenje usluge se završava:</td>
            </tr>
            <tr>
                <td><?= Yii::$app->formatter->asDateTime($model->active_from, 'php:D, d.M ') ?><?= Yii::$app->formatter->asDateTime($model->active_from, 'php:@H:i') ?>
                    </td>                  
                <td class="">
                    <?= Yii::$app->formatter->asDateTime($model->validity, 'php:D, d.M ') ?><?= Yii::$app->formatter->asDateTime($model->validity, 'php:@H:i') ?>
                </td>
            </tr>
            <tr>
                <td class="subline"><i class="fa fa-map-marker fa-lg"></i> Šekspirova 7, <?= $model->activity->user->location->city ?>, SRB</td>
                <td class="subline"><?= $model->activity->user->location->city ?>, Srbija <i class="fa fa-map"></i></td>
            </tr>
        </table>
    </div>
</div>
<div class="secondary-context cont avatar-padded action">
    <?= Html::a('<i class="fa fa-barcode"></i>&nbsp;12.999 EUR', Url::to(), ['class'=>'btn btn-link']); ?>
    <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Kupi'), Url::to(), ['class'=>'btn btn-danger']); ?>    
</div>