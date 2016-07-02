<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\widgets\BoxService;
use frontend\widgets\ActivityBox;
use frontend\widgets\BoxOrder;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\DateTimePicker;
use kartik\widgets\StarRating;
use kartik\widgets\Alert;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;
use common\models\CsSectors;
use yii\web\Session;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['user'] = $model;

$this->cardData = [
    'pic' => 'default_avatar', 
];

$this->profileSubNavData = [
    'pic' => 'default_avatar',
    'title' => $model->fullname ? $model->fullname : $model->username,
    'username' => $model->username,
    'loc' => $model->location->city,        
];

$this->profileTitle = [
    'icon'          => '',
    'title'         => ($model->fullname!=null) ? $model->fullname : $model->username,
    'description'   => '',
];

$this->stats = [
    ['title'=>'Zahtevi', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Promocije', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];
?>
<?php
$coord = new LatLng(['lat' => $model->location->lat, 'lng' => $model->location->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    
]);

$map->width = '100%';
$map->height = '366';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);

// Provide a shared InfoWindow to the marker
$marker->attachInfoWindow(
    new InfoWindow([
        'content' => '<p>This is my super cool content</p>'
    ])
);

// Add marker to the map
$map->addOverlay($marker);
?>
<div class="card_container record-xl fadeIn animated" id="card_container" style="float:none;">
    <div class="header-context gray">
        <div class="head">Dobrodošli na Servicemapp!</div>
        <div class="subhead">Lorem ipsum</div>
    </div>
    <div class="secondary-context cont gray">
        <p>Usluge, delatnost, uslovi pružanja usluga.</p>
        <p>Usluge, delatnost, uslovi pružanja usluga.</p>
    </div>
    <hr style="margin:0">
    <div class="secondary-context">
        <div class="head thin">Podešavanje usluga koje pružate</div>
        <div class="subhead">Lorem ipsum</div>
        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.</p>
    </div>
    <div class="action-area right">
        <?= Html::a('<i class="fa fa-wrench"></i>&nbsp;'.Yii::t('app', 'Podesite usluge'), Url::to('/'.$model->username.'/services'), ['class'=>'btn btn-primary']); ?>
    </div>
    <hr style="margin:0">
    <div class="secondary-context">
        <div class="head thin">Vaš profil</div>
        <div class="subhead">Lorem ipsum</div>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>
    </div>
    <div class="action-area right">
        <?= Html::a('<i class="fa fa-wrench"></i>&nbsp;'.Yii::t('app', 'Podesite profil'), Url::to('/'.$model->username.'/profile'), ['class'=>'btn btn-primary']); ?>
    </div>
</div>

<div class="activities-index">
    <h1 class="padding-bottom-20">Feed</h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<div class="card_container record-xl grid-item fadeInUp animated" id="card_container" style="float:none;">
    
        <div class="header-context">                
            <div class="avatar">
                <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
            </div>
            <div class="title">
                <div class="head second">Masterplan</div>
                <div class="subhead"><?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?></div> 
            </div>
            <div class="subaction">
                <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?>    
            </div>
        </div>
        <div class="media-area">                
            <div class="image">
                <?= $map->display() ?>                   
            </div>
        </div>
        <table class="main-context"> 
            <tr>
                <td class="body-area">
                    <div class="primary-context">
                        <div class="head">Heading</div>
                        <div class="subhead">Lorem ipsum</div>
                    </div>
                    <div class="secondary-context cont">
                        <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                        <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                        <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>
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
        <div class="action-area right">
            <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
        </div>
    
</div>

<div class="card_container record-xl grid-item fadeInUp animated" id="card_container" style="float:none;">
    <a href="<?= Url::to('/services') ?>">
        <div class="header-context">                
            <div class="avatar">
                <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
            </div>
            <div class="title">
                <div class="head second">Masterplan</div>
                <div class="subhead"><?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?></div> 
            </div>
            <div class="subaction">
                <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?>    
            </div>
        </div>
        <table class="main-context"> 
            <tr>
                <td class="body-area">
                    <div class="primary-context">
                        <div class="head">Heading</div>
                        <div class="subhead">Lorem ipsum</div>
                    </div>
                    <div class="secondary-context cont">
                        <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                        <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                        <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                            fugiat nulla pariatur.</p>
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
        <div class="action-area right">
            <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
        </div>
    </a>
        <div class="action-area normal-case">
            <?= Html::a(Yii::t('app', 'Bids').'&nbsp;<i class="fa fa-caret-down"></i>', null, ['class'=>'btn btn-link bid-link']); ?>
        </div>

        <div class="bids-area animated fadeInDown">
            <div class="bid-wrap">
                <table>
                    <tr>
                        <td class="avatar">
                            <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
                        </td>
                        <td class="body">
                            <table>
                                <tr>
                                    <td class="head second">
                                        Masterplan
                                    </td>
                                    <td class="subaction">                                      
                                        <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?> 
                                    </td>                       
                                </tr>                        
                            </table>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur.</p> 
                        </td>                       
                    </tr>                        
                </table>
            </div>

            <div class="bid-wrap">
                <table>
                    <tr>
                        <td class="avatar">
                            <?= Html::img('@web/images/cards/info/info_docs2.jpg') ?>          
                        </td>
                        <td class="body">
                            <table>
                                <tr>
                                    <td class="head second">
                                        Tomislav
                                    </td>
                                    <td class="subaction">                                      
                                        <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?> 
                                    </td>                       
                                </tr>                        
                            </table>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua..</p> 
                        </td>                       
                    </tr>                        
                </table>
            </div>                  
        </div>

        <div class="action-area normal-case">
            <?= Html::a(Yii::t('app', 'Comments').'&nbsp;<i class="fa fa-caret-down"></i>', null, ['class'=>'btn btn-link comment-link']); ?>
        </div>

        <div class="comments-area animated fadeInDown">
            <div class="comment-wrap">
                <table>
                    <tr>
                        <td class="avatar">
                            <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
                        </td>
                        <td class="body">
                            <table>
                                <tr>
                                    <td class="head second">
                                        Masterplan
                                    </td>
                                    <td class="subaction">                                      
                                        <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?> 
                                    </td>                       
                                </tr>                        
                            </table>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                        fugiat nulla pariatur.</p> 
                        </td>                       
                    </tr>                        
                </table>
            </div>

            <div class="comment-wrap">
                <table>
                    <tr>
                        <td class="avatar">
                            <?= Html::img('@web/images/cards/info/info_docs2.jpg') ?>          
                        </td>
                        <td class="body">
                            <table>
                                <tr>
                                    <td class="head second">
                                        Tomislav
                                    </td>
                                    <td class="subaction">                                      
                                        <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?> 
                                    </td>                       
                                </tr>                        
                            </table>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                        dolore magna aliqua..</p> 
                        </td>                       
                    </tr>                        
                </table>
            </div>                  
        </div>           
</div>