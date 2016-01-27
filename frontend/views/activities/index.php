<?php

use yii\helpers\Html;
use yii\widgets\ListView;

use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$model = frontend\models\User::findOne(1);
$coord = new LatLng(['lat' => $model->userDetails->loc->lat, 'lng' => $model->userDetails->loc->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    
]);

$map->width = '100%';
$map->height = '431';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);

// Add marker to the map
$map->addOverlay($marker);

$map2 = new Map([
    'center' => $coord,
    'zoom' => 14,
    
]);

$map2->width = '100%';
$map2->height = '176';


// Lets add a marker now
$marker2 = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);

// Add marker to the map
$map2->addOverlay($marker2);

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ActivitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Feed');
$this->params['breadcrumbs'][] = $this->title;
?>
	<div class="activities-index">
	    <h1><?= Html::encode($this->title) ?> <span class="float-right fs_12 bold">sort by <?= Html::dropDownList('sort', null, [
    'value1' => 'time ascending',
    'value2' => 'time descending',
], []) ?></span></h1>
	    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	</div>
	<div class="card_container record-650 grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to('/order/1') ?>">
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
    </div>

    <?= \frontend\widgets\BidBox::widget([
        'bidder' => [
            'avatar' => 'default_avatar',
            'name' => 'Masterplan',
            'location' => 'Novi Sad',
        ],
        'data' => [
            'time' => date('U'),
            'note' => '',
            'price' => 12750,
            'currency' => 'EUR',
            'price_per' => 7500,
            'units' => 'm<sup>2</sup>',
            'duration' => 3,
            'durationUnits' => 'h',
            'expectedStart' => Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s', time() + 10000), 'php:j. M y @H:i'),
        ],
        'bidOptions' => [],
    ]); ?>
    
    <div class="card_container record-650 grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to('/services') ?>">
            <div class="header-context">                
                <div class="avatar">
                    <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
                </div>
                <div class="title">
                    <div class="head second">Masterplan</div>
                    <div class="subhead">Novi Sad, Srbija</div> 
                </div>
                <div class="subaction">
                    <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?>    
                </div>
            </div>
            <table class="main-context"> 
                <tr>
                    <td class="body-area">
                        <div class="primary-context">
                            <div class="head">Izdavanje apartmana</div>
                            <div class="subhead">Izdavanje nekretnina</div>
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
                <?= Html::a('<i class="fa fa-exchange"></i>&nbsp;'.Yii::t('app', 'Bid'), Url::to(), ['class'=>'btn btn-link']); ?>
                <?= Html::a('<i class="fa fa-binoculars"></i>&nbsp;'.Yii::t('app', 'Follow'), Url::to(), ['class'=>'btn btn-link']); ?>
                <?= Html::a('<i class="fa fa-comment"></i>&nbsp;'.Yii::t('app', 'Comment'), Url::to(), ['class'=>'btn btn-link']); ?>
            </div>
        </a>
        	<div class="action-area normal-case">
                <?= Html::a(Yii::t('app', 'Bids').'&nbsp;<i class="fa fa-caret-down"></i>', null, ['class'=>'btn btn-link bid-link']); ?>
            </div>

            <div class="bids-area animated fadeInDown">
                <?php // bid ?>
                <?= \frontend\widgets\BidBox::widget([
                    'bidder' => [
                        'avatar' => 'default_avatar',
                        'name' => 'Masterplan',
                        'location' => 'Novi Sad',
                    ],
                    'data' => [
                        'time' => date('U'),
                        'note' => '',
                        'price' => 12750,
                        'currency' => 'EUR',
                        'price_per' => 7500,
                        'units' => 'm<sup>2</sup>',
                        'duration' => 3,
                        'durationUnits' => 'h',
                        'expectedStart' => Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s', time() + 10000), 'php:j. M y @H:i'),
                    ],
                    'bidOptions' => [],
                ]); ?>
                <?php // bid ?>
                <?= \frontend\widgets\BidBox::widget([
                    'bidder' => [
                        'avatar' => 'default_avatar',
                        'name' => 'Tomislav',
                        'location' => 'Beograd',
                    ],
                    'data' => [
                        'time' => date('U'),
                        'note' => '',
                        'price' => 11850,
                        'currency' => 'EUR',
                        'price_per' => 7350,
                        'units' => 'm<sup>2</sup>',
                        'duration' => 2,
                        'durationUnits' => 'h',
                        'expectedStart' => Yii::$app->formatter->asDatetime(date('Y-m-d H:i:s', time() + 9000), 'php:j. M y @H:i'),
                    ],
                    'bidOptions' => [],
                ]); ?> 
            </div>

        	<div class="action-area normal-case">
                <?= Html::a(Yii::t('app', 'Comments').'&nbsp;<i class="fa fa-caret-down"></i>', null, ['class'=>'btn btn-link comment-link']); ?>
            </div>

            <div class="comments-area animated fadeInDown gray closed">
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