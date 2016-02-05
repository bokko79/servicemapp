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
use frontend\models\CsSectors;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->cardData = [
    'pic' => 'default_avatar', 
];

$this->profileSubNavData = [
    'pic' => 'default_avatar',
    'title' => $model->fullname ? $model->fullname : $model->username,
    'username' => $model->username,
    'loc' => $model->userDetails->loc->city,        
];

// <!-- TABS -->
$this->tabs = [
    ['url'=>Url::to('/'.$model->username.'/activities'), 'class'=>'', 'role'=>'', 'icon'=>'fa-bars', 'label'=>Yii::t('app', 'Moji poslovi'), 'active'=>''],
    ['url'=>Url::to('/'.$model->username.'/home'), 'class'=>'', 'role'=>'', 'icon'=>'fa-feed', 'label'=>Yii::t('app', 'Feed'), 'active'=>'provider/services'],        
    ['url'=>Url::to('/'.$model->username.'/inbox'), 'class'=>'', 'role'=>'', 'icon'=>'fa-envelope-o', 'label'=>Yii::t('app', 'Inbox'), 'active'=>''],
    ['url'=>Url::to('/'.$model->username.'/finances'), 'class'=>'', 'role'=>'', 'icon'=>'fa-money', 'label'=>Yii::t('app', 'Finansije'), 'active'=>''],
    ['url'=>Url::to('/'.$model->username.'/profile'), 'class'=>'', 'role'=>'', 'icon'=>'fa-user', 'label'=>Yii::t('app', 'Moj profil'), 'active'=>''],
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
$coord = new LatLng(['lat' => $model->userDetails->loc->lat, 'lng' => $model->userDetails->loc->lng]);
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
<div class="user-view" style="margin-top:20px;">
    <?= Alert::widget([
        'type' => Alert::TYPE_SUCCESS,
        'title' => 'Note',
        'titleOptions' => ['icon' => 'info-sign'],
        'body' => 'This is an informative alert'
    ]) ?>
</div>

    

<div class="card_container record-650 grid-item fadeInUp animated" id="card_container" style="float:none;">
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
    </a>
</div>

<div class="card_container record-650 grid-item fadeInUp animated" id="card_container" style="float:none;">
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


<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email:email',
        'email_reset_hash:email',
        'email_reset_time:email',
        'fullname',
        'is_provider',
        'ip_address',
        'activation_hash',
        'activation_time',
        'invite_hash',
        'registered_by',
        'type',
        'last_login_time',
        'login_count',
        'login_hash',
        'online_status',
        'last_activity',
        'phone',
        'phone_verification_hash',
        'phone_verification_time',
        'rememberme_token',
        'role_code',
        'status',
        'created_at',
        'updated_at',
    ],
]) ?>