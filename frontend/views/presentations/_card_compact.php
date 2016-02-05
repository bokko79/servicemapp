<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
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
            <div class="head second gray-color"><?= Html::a('Prezentacija usluge #'. sprintf("%'09d\n", $model->id), Url::to('/presentation/'.$model->id), ['class'=>'']); ?></div>
            <div class="subhead">  
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
                    <div class="head">Dostava pizza</div>
                    <div class="subhead">
                        <div class="label label-success fs_11 margin-right-15"><i class="fa fa-building"></i> Izdavanje nekretnina</div>
                    </div>
                </div>
                <div class="secondary-context cont">
                    
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
</div>
<div class="secondary-context cont avatar-padded action">
    <?= Html::a('<i class="fa fa-barcode"></i>&nbsp;12.999 EUR', Url::to(), ['class'=>'btn btn-link']); ?>
    <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Kupi'), Url::to(), ['class'=>'btn btn-danger']); ?>    
</div>