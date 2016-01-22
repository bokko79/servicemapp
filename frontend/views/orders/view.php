<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\ProductHead;


use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Market'), 'url' => ['/market']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

/* specs */
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


$this->stats = [
    ['title'=>'Posete', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Komentari', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];
?>

<?php // $this->render('//layouts/partial/product_head.php', ['model'=>$model]) ?>

<?= ProductHead::widget([
        'productData' => [
            'creator' => [
                'name' => ($model->user->fullname) ? $model->user->fullname : $model->user->username,
                'location' => $model->user->userDetails->loc->city,
            ],
            'product' => [
                [
                    'avatar' => 'info/info_docs3',
                    'head' => 'Kratkoročno izdavanje apartmana',
                    'qty' => '65 m<sup>2</sup>',
                    'consumer' => 4,
                    'note' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat.',
                    'details' => $items,
                    'media' => [0=>'info/info_docs'.rand(0, 9)],
                ],
                [
                    'avatar' => 'info/info_docs2',
                    'head' => 'Izdavanje apartmana',
                    'qty' => '78 m<sup>2</sup>',
                    'consumer' => 2,
                    'note' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat.',
                    'details' => $items,
                    'media' => [0=>'info/info_docs'.rand(0, 9)],
                ]
            ],            
            'maps' => $map->display(),
            'activity' => [
                'id' => 54,
                'type' => 'normal',
                'status' => 'active',
                'validity' => date('Y-m-d H:i:s', time() + 15),
                'time' => 'pon 27. mart @<b>18:30</b>',// <i class="fa fa-long-arrow-right"></i> sre 29. mart @<b>11:00</b>
                'location' => 'Novi Sad (SRB), Šekspirova 7',//<i class="fa fa-long-arrow-right"></i> Čazma (HR), Kralja Tomislava 3
            ],            
        ]
    ]) ?>

    <h1><?= Html::encode('Bids') ?></h1>
    <div class="card_container record-full fadeInUp animated" id="card_container" style="float:none;">
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

            <div class="action-area right">
                <?= Html::a('<i class="fa fa-exchange"></i>&nbsp;'.Yii::t('app', 'Bid'), Url::to(), ['class'=>'btn btn-primary']); ?>                   
            </div>                  
        </div>
    </div>

<h1><?= Html::encode('Comments') ?></h1>
    <div class="card_container record-full fadeInUp animated" id="card_container" style="float:none;">
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

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

          