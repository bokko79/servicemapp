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
        /*['url'=>$this->createUrl(Yii::$app->user->username.'/home'), 'class'=>'', 'role'=>'', 'icon'=>'fa-home', 'label'=>Yii::t('main', 'Home'), 'active'=>'users/view'],
        ((Yii::$app->urlManager->parseUrl(Yii::$app->request)=='users/view') ?                    
            ['url'=>'#orders', 'class'=>'', 'role'=>'role="tab" data-toggle="tab"', 'icon'=>'fa-play', 'label'=>Yii::t('main', 'Ready orders'), 'active'=>''] : null),
        ((Yii::$app->urlManager->parseUrl(Yii::$app->request)=='users/view') ?
            ['url'=>'#following', 'class'=>'', 'role'=>'role="tab" data-toggle="tab"', 'icon'=>'fa-eye', 'label'=>Yii::t('main', 'Follows'), 'active'=>''] : null),


        ['url'=>$this->createUrl('/pro-services-setup/'.Yii::$app->user->id), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('main', 'Services'), 'active'=>'provider/services'],

*/
        ['url'=>Url::to('/index'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Index'), 'active'=>'provider/services'],
        ['url'=>Url::to('/contact-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Contact'), 'active'=>''],
        ['url'=>Url::to('/about-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'About'), 'active'=>''],
        ['url'=>Url::to('/users'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Users'), 'active'=>''],
        ['url'=>Url::to('/login'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Login'), 'active'=>''],

        /*['url'=>Url::to(Yii::app()->user->username.'/notifications'), 'class'=>'', 'role'=>'', 'icon'=>'fa-bell', 'label'=>Yii::t('main', 'Notifications').$counter_ntf, 'active'=>'users/notifications'],*/
        /*['url'=>Url::to('/messages'), 'class'=>'', 'role'=>'', 'icon'=>'fa-envelope-o', 'label'=>Yii::t('main', 'Messages').$counter_msg, 'active'=>'thread/index'],
        ['url'=>Url::to(Yii::app()->user->username.'/transactions'), 'class'=>'', 'role'=>'', 'icon'=>'fa-download', 'label'=>Yii::t('main', 'Transactions'), 'active'=>'transactions/index'],
        ['url'=>Url::to(Yii::app()->user->username.'/objects'), 'class'=>'', 'role'=>'', 'icon'=>'fa-cube', 'label'=>Yii::t('main', 'Objects'), 'active'=>'users/objects'],                   
        ['url'=>Url::to(Yii::app()->user->username.'/locations'), 'class'=>'', 'role'=>'', 'icon'=>'fa-map-marker', 'label'=>Yii::t('main', 'Locations'), 'active'=>'users/locations'],
        ['url'=>Url::to(Yii::app()->user->username.'/services'), 'class'=>'', 'role'=>'', 'icon'=>'fa-flag', 'label'=>Yii::t('main', 'Followed Services'), 'active'=>'users/services'],
        ['url'=>Url::to(Yii::app()->user->username.'/payments'), 'class'=>'', 'role'=>'', 'icon'=>'fa-credit-card', 'label'=>Yii::t('main', 'Payments'), 'active'=>'users/payments'],*/
        
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


<?php
echo StarRating::widget([
    'name' => 'rating_21',
    'pluginOptions' => [
        'min' => 0,
        'max' => 12,
        'step' => 2,
        'size' => 'lg',
        'starCaptions' => [
            0 => 'Extremely Poor',
            2 => 'Very Poor',
            4 => 'Poor',
            6 => 'Ok',
            8 => 'Good',
            10 => 'Very Good',
            12 => 'Extremely Good',
        ],
        'starCaptionClasses' => [
            0 => 'text-danger',
            2 => 'text-danger',
            4 => 'text-warning',
            6 => 'text-info',
            8 => 'text-primary',
            10 => 'text-success',
            12 => 'text-success'
        ],
    ],
]); ?>
