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

        /*['url'=>$this->createUrl(Yii::app()->user->username.'/notifications'), 'class'=>'', 'role'=>'', 'icon'=>'fa-bell', 'label'=>Yii::t('main', 'Notifications').$counter_ntf, 'active'=>'users/notifications'],*/
        /*['url'=>$this->createUrl('/messages'), 'class'=>'', 'role'=>'', 'icon'=>'fa-envelope-o', 'label'=>Yii::t('main', 'Messages').$counter_msg, 'active'=>'thread/index'],
        ['url'=>$this->createUrl(Yii::app()->user->username.'/transactions'), 'class'=>'', 'role'=>'', 'icon'=>'fa-download', 'label'=>Yii::t('main', 'Transactions'), 'active'=>'transactions/index'],
        ['url'=>$this->createUrl(Yii::app()->user->username.'/objects'), 'class'=>'', 'role'=>'', 'icon'=>'fa-cube', 'label'=>Yii::t('main', 'Objects'), 'active'=>'users/objects'],                   
        ['url'=>$this->createUrl(Yii::app()->user->username.'/locations'), 'class'=>'', 'role'=>'', 'icon'=>'fa-map-marker', 'label'=>Yii::t('main', 'Locations'), 'active'=>'users/locations'],
        ['url'=>$this->createUrl(Yii::app()->user->username.'/services'), 'class'=>'', 'role'=>'', 'icon'=>'fa-flag', 'label'=>Yii::t('main', 'Followed Services'), 'active'=>'users/services'],
        ['url'=>$this->createUrl(Yii::app()->user->username.'/payments'), 'class'=>'', 'role'=>'', 'icon'=>'fa-credit-card', 'label'=>Yii::t('main', 'Payments'), 'active'=>'users/payments'],*/
        
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


<div class="user-view">

    <div id="quick_form_makers">
    <table class="main_controls">
        <tr>
            <td class="control order_service">
                <?= Html::a('<i class="fa fa-shopping-basket"></i>&nbsp;Naruči uslugu', '#', array()); ?>

            </td>
            <td class="control">
                <?= Html::a('<i class="fa fa-flag-o"></i>&nbsp;Promoviši uslugu', '#', array()); ?>
            </td>
            <td class="control">
                <?= Html::a('<i class="fa fa-bullhorn"></i>&nbsp;Najavi događaj', '#', array()); ?>
            </td>
            <td class="control">

                <?php 
                    /*if(Yii::app()->urlManager->parseUrl(Yii::app()->request)=='users/notifications'):
                        echo Html::a('<i class="fa fa-wrench"></i>&nbsp;Podesi obaveštenja', '#', array());
                    elseif(Yii::app()->urlManager->parseUrl(Yii::app()->request)=='users/payments'):
                        echo Html::a('<i class="fa fa-wrench"></i>&nbsp;Podesi plaćanja', '#', array());
                    else:
                        echo Html::a('<i class="fa fa-wrench"></i>&nbsp;Podesi nalog', '#', array()); 
                    endif;*/?>

                <?= Html::a('<i class="fa fa-wrench"></i>&nbsp;Podesi nalog', '#', array()); ?>
            </td>
        </tr>
    </table>

    
    <div class="order_service_process fadeIn animated">
            <?php
                $form = kartik\widgets\ActiveForm::begin(
                    [
                        'id' => 'signup-form',
                        'enableAjaxValidation' => true,
                        'action'=>/*Yii::$app->createUrl('/cart')*/'',
                    ]); ?>

                <fieldset>
                    <p class="hint" style="">Birajte delatnost, zatim aktivnost i na kraju predmet usluge i naručite uslugu. 
                    Npr.: Treba mi... <b>arhitekta</b> za <b>projektovanje kuće</b></p>

                    
                <?php
                    // Top most parent
                    /*echo $form->field($csSectors, 'name')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(CsSectors::find()->asArray()->all(), 'id', 'name')
                    ]);
                     
                    // Child level 1
                    echo $form->field($csSectors, 'lev1')->widget(DepDrop::classname(), [
                        'data'=> [6=>'Bank'],
                        'options' => ['placeholder' => 'Select ...'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions'=>[
                            'depends'=>['account-lev0'],
                            'url' => Url::to(['/account/child-account']),
                            'loadingText' => 'Loading child level 1 ...',
                        ]
                    ]);
                     
                    // Child level 2
                    echo $form->field($csSectors, 'lev2')->widget(DepDrop::classname(), [
                        'data'=> [9=>'Savings'],
                        'options' => ['placeholder' => 'Select ...'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions'=>[
                            'depends'=>['account-lev1'],
                            'url' => Url::to(['/account/child-account']),
                            'loadingText' => 'Loading child level 2 ...',
                        ]
                    ]);
                     
                    // Child level 3
                    echo $form->field($csservices, 'lev3')->widget(DepDrop::classname(), [
                        'data'=> [12=>'Savings A/C 2'],
                        'options' => ['placeholder' => 'Select ...'],
                        'type' => DepDrop::TYPE_SELECT2,
                        'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                        'pluginOptions'=>[
                            'depends'=>['account-lev2'],
                            'initialize' => true,
                            'initDepends'=>['account-lev0'],
                            'url' => Url::to(['/account/child-account']),
                            'loadingText' => 'Loading child level 3 ...'
                        ]
                    ]);*/
                    ?>
                        <div class="ui dropdown search floating icon button labeled">
                        
                            <span class="icon" style="padding:8px;"><?php /*echo Users::avatar(Yii::app()->user->id, 20, 20);*/ ?> Treba mi...</span>
                            <div class="default text">Izaberite profesionalca/delatnost</div>
                                <?php /*echo Html::dropDownList('delid', '',
                                                CHtml::listData(Delatnost::model()->findAll(), 'id', 'ime'),
                                                array('prompt'=>'izaberi', 'id'=>'search-select', 'class'=>'', 
                                                    'ajax' => array(
                                                          'type'=>'GET', //request type
                                                          'url'=>CController::createUrl('/listIndActions'), //action to call
                                                          'update'=>'#action_id', // which HTML element to update
                                                          'complete'=>'function(data){
                                                                $(".action_seci .item").removeClass("active selected");
                                                                $(".service_seci .item").removeClass("active selected");
                                                                $(".action_seci").css({"display":"inline"});
                                                                
                                                               }',
                                                        ),
                                                )
                                        );*/ ?>
                        </div>

                        <div class="action_seci fadeIn animated ui dropdown" style="display:none;">
                        za <div class="default text">Izaberite aktivnost</div>
                            <?php /*echo Html::dropDownList('action_id', '', array(),
                                            array('id'=>'action_id', 'class'=>'',
                                                'ajax' => array(
                                                      'type'=>'GET', //request type
                                                      'url'=>CController::createUrl('/listActServices'), //action to call
                                                      'update'=>'#service_id', // which HTML element to update
                                                      'complete'=>'function(data){
                                                            
                                                            $(".service_seci .item").removeClass("active selected");
                                                            $(".service_seci").css({"display":"inline"});
                                                            
                                                           }',

                                                    ),
                                            )
                                    ); */?>
                        </div>

                        <div class="service_seci fadeIn animated ui dropdown" style="display:none;">
                            <div class="default text">Izaberite predmet usluge</div>
                            <?php/* echo Html::dropDownList('add_service_for_order', '', array(),
                                            array('id'=>'service_id', 'class'=>'', 
                                                'ajax' => array(
                                                      'type'=>'GET', //request type
                                                      'url'=>CController::createUrl('/listObjectModel'), //action to call
                                                      'update'=>'#objectmodel_id', // which HTML element to update
                                                      'complete'=>'function(data){
                                                            
                                                            $(".button_field input").removeClass("btn-disabled").addClass("btn-success");
                                                            
                                                           }',

                                                    ),
                                            )
                                    ); */?>
                        </div>

                    
                </fieldset>

                <div class="button_field"><?php echo Html::submitButton(Yii::t('app', 'Naruči'), array('class'=>'btn btn-disabled', 'style'=>'')); ?></div>
            
            <?php kartik\widgets\ActiveForm::end(); ?>

    </div>

    <div class="promote_service_process">
        

    </div>

    <div class="provide_service_process">
        
        
    </div>
    
        
</div>

    <?= Alert::widget([
        'type' => Alert::TYPE_SUCCESS,
        'title' => 'Note',
        'titleOptions' => ['icon' => 'info-sign'],
        'body' => 'This is an informative alert'
    ]) ?>

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


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php /* BoxActivity::widget([
        'boxData' => [
            'id' => '#',
            'timeago' => '#',
            'activity_creator' => [
                'avatar' => '#',
                'username' => '#',
                'loc' => '#',
                'rating' => '#',
                'stars' => '#',
            ],
            'body' => BoxOrder::widget([
                'boxData' => [
                    'id' => '#',
                    'pic' => '#',
                    'time' => '#',
                    'valid' => '#',
                ],
            ]),
        ],
        'type' => '',
        'options' => [

        ],
    ])*/ ?>

<?php /*
    <?= BoxActivity::widget([
        'boxData' => [
            'id' => '#',
            'timeago' => '#',
            'activity_creator' => [
                'avatar' => '#',
                'username' => '#',
                'loc' => '#',
                'rating' => '#',
                'stars' => '#',
            ],
            'body' => BoxOrder::widget([
                'boxData' => [
                    'id' => '#',
                    'pic' => '#',
                    'time' => '#',
                    'valid' => '#',
                ],
            ]),
        ],
    ]) ?>

    <?= BoxService::widget([
        'boxData' => [
            'href' => '#',
            'pic' => '#',
            'title' => '#',
            'stat' => [
                1 => '#',
                2 => '#',
                3 => '#',
            ],
            'desc' => '#',
            'price' => '#',
            'button' => '#',            
        ],
    ]) ?>
*/ ?>

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

</div>
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


<?php
// usage without model
echo '<label>Start Date/Time</label>';
echo DateTimePicker::widget([
    'name' => 'datetime_10',
    'options' => ['placeholder' => 'Select operating time ...'],
    'convertFormat' => true,
    'pluginOptions' => [
        'format' => 'd-M-Y g:i A',
        'startDate' => date('d-M-Y'),
        'todayHighlight' => true
    ]
]); ?>
