<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\ProductHead;
use frontend\widgets\Card;
use frontend\widgets\OrderBox;
use kartik\widgets\ActiveForm;


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
        'active'=>true,
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
                    'link' => '/service/1',
                    'qty' => '65 m<sup>2</sup>',
                    'consumer' => 4,
                    'note' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat.',
                    'details' => $items,
                    'media' => [0=>'info/info_docs'.rand(0, 9)],
                ]
            ],            
            'maps' => $map->display(),
            'activity' => [
                'id' => 6454,
                'type' => 'normal',
                'status' => 'active',
                'validity' => date('Y-m-d H:i:s', time() + 10000),
                'time' => 'pon 27. mart @<b>18:30</b> <i class="fa fa-long-arrow-right"></i> sre 29. mart @<b>11:00</b>',
                'location' => 'Novi Sad (SRB), Šekspirova 7',//<i class="fa fa-long-arrow-right"></i> Čazma (HR), Kralja Tomislava 3
            ],            
        ]
    ]) ?>

    <h1><?= Html::encode('Ponude') ?><span class="float-right fs_12 bold">sortiraj po <?= Html::dropDownList('sort', null, [
    'value1' => 'time ascending',
    'value2' => 'time descending',
], []) ?></span></h1>
    <div class="card_container record-full fadeIn animated" id="card_container" style="float:none;">
        <div class="bids-area animated fadeIn">
            <?php // bid ?>
            <?= Card::widget([
                'bid' => \frontend\models\Bids::findOne(1),
                //'view' => Card::VIEW_COMPACT,                
                'sections' => [
                    1 => [
                        'part' => Card::PART_BID,
                        'options' => ['class'=>''],
                    ]                    
                ] 
            ]); ?>
           
        </div>
    </div>

<h1><?= Html::encode('Komentari') ?></h1>
    <div class="card_container record-full fadeIn animated" id="card_container" style="float:none;">

        <div class="comments-area animated fadeIn">
            <?= Card::widget([
                'comment' => \frontend\models\ActivityComments::findOne(1),
                'sections' => [
                    1 => [
                        'part' => Card::PART_COMMENT,
                        'options' => ['class'=>''],
                    ]                    
                ]                    
            ]) ?>                  
        </div>
        <div class="secondary-context avatar-padded fadeIn animated">
            <?php $form = kartik\widgets\ActiveForm::begin([
                'id' => 'form-horizontal',
                'type' => ActiveForm::TYPE_INLINE,
            ]); ?>

            <?= $form->field($model, 'validity', [
                    'addon' => [
                        'append' => [
                            'content' => Html::button('Kometar', ['class'=>'btn btn-primary']), 
                            'asButton' => true
                        ]
                    ],
                    'inputOptions' => ['style' => 'width:100%;'],
                    'options' => ['style' => 'width:100%;'],
                ]) ?>

            <?php ActiveForm::end(); ?>         
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

    
<?php 
$content_1 = '<i class="fa fa-refresh fa-spin"></i> '.
    \russ666\widgets\Countdown::widget([
            'datetime' => $model->validity,
            'format' => '%d<span class=\"fs_11\">d</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> %S<span class=\"fs_11\">s</span>',
            'events' => [
            ],
        ]);
$services = [];
foreach ($model->orderServices as $orderService):
$services[] = [
    /*'ser1' => [
        'part' => Card::PART_HEAD,
        'options' => ['class'=>'head', 'head'=>'head'],
        'hr'=>true,
        'version' => 1,
    ],*/
    /*'media' => [
        'part' => Card::PART_MEDIA,
        'options' => ['class'=>'']
    ],*/
];
endforeach;
?>
<?= Card::widget([
    'model' => $model,
    'medias' => \frontend\models\Images::find()->where('id>20 and id<25')->all(),
    'sections' => [        
        2 => [
            'part' => Card::PART_HEAD,
            'options' => ['class'=>'gray', 'head'=>'lower'],
            'hr'=>true,
            'version' => 1,
        ],
        1 => [
            'part' => Card::PART_HEAD,
            'options' => [
                'class'=>'', 
                'head'=>'second gray-color', 
                'avatarIcon'=>'shopping-cart', 
                'avatar'=>'center gray-color',
                'subhead' => 'label label-primary',
                'headContent'=>'Porudžbina br. #'. sprintf("%'09d\n", $model->id),
                'subheadContent'=>'<i class="fa fa-bookmark"></i> '. $model->activity->type,
                'subactionContent'=>$content_1,
                'subaction' => 'fs_30',
            ],
            'hr'=>true,
            'version' => 2,
        ],
    ]
]) ?>