<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2; // or kartik\select2\Select2
use kartik\checkbox\CheckboxX;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use common\models\CsServices;
use frontend\widgets\ServiceBox;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Circle;

$model = common\models\User::findOne(1);
$model2 = common\models\User::findOne(22);
$coord = new LatLng(['lat' => $model->location->lat, 'lng' => $model->location->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 10,
    
]);

$map->width = '100%';
$map->height = '431';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);

// Lets add a marker now
$circle = new Circle([
    'center' => $coord,
    'radius' => 3000,
]);

// Add marker to the map
$map->addOverlay($marker);
$map->addOverlay($circle);

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
echo distance($model->location->lat, $model->location->lng, $model2->location->lat, $model2->location->lng);
?>

<?= (Yii::$app->request->url=='/index') ? 'yes' : 'no' ?>

<div class="site-index">
<div class="body-content">
    <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to('/services') ?>">
            <div class="media-area">                
                <div class="image">
                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
                </div>
            </div>
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
            </div>
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
            </div>
        </a>
    </div>

    <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to('/services') ?>">
            <div class="media-area">                
                <div class="image">
                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
                </div>
                <div class="primary-context in-media">
                    <div class="head">Quis nostrud exercitation erasten</div>
                </div>
            </div>
            <div class="primary-context">
                <div class="subhead">Heading</div>
            </div>
            <div class="secondary-context">
                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.</p>
            </div>
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
            </div>
        </a>
    </div>


    <?php $form = kartik\widgets\ActiveForm::begin([
        'id' => 'form-horizontal',
        'type' => ActiveForm::TYPE_VERTICAL,        
    ]); ?>
    <label class="cbx-label" for="s_1">
    <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">        
            <div class="media-area square">                
                <div class="image">
                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                                        
                </div>
                <div class="primary-context in-media dark">
                    <div class="head">Quis nostrud exercitation erasten aboris nisi ut aliquip</div>
                </div>
                <div class="action-area" style="height:40px; position: absolute; top:0; right:0;">
                    <?= CheckboxX::widget([
                        'name'=>'s_1',
                        'options'=>['id'=>'s_1'],
                        'pluginOptions'=>['threeState'=>false]
                    ]) ?>
                </div> 
            </div>            
                  
    </div>
    </label>
    <?php ActiveForm::end(); ?>

    <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">
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
                    <?= $map2->display() ?>                   
                </div>
            </div>
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
            </div>
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
            </div>
        </a>
    </div>


    <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to('/services') ?>">
            
            <div class="primary-context">
                <div class="head">Congratulations</div>
                <div class="subhead">Lorem ipsum</div>
            </div>
            <div class="secondary-context cont">
                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                <p>You have successfully created your Yii-powered application.</p>
            </div>
            <div class="action-area right">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-warning']); ?>
            </div>
        </a>
    </div>


    <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to('/services') ?>">            
            <div class="primary-context">
                <div class="head">Heading</div>
                <div class="subhead">Lorem ipsum</div>
            </div>
            <div class="secondary-context cont">
                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                <p>You have successfully created your Yii-powered application.</p>
            </div>
            <div class="action-area right">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-success']); ?>
            </div>
        </a>
    </div>

    <div class="card_container teaser-xl grid-item fadeInUp animated" id="card_container" style="float:none;">
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
                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
                </div>
            </div>
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
            </div>
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
            </div>
        </a>
    </div>

    <div class="card_container teaser-xl grid-item fadeInUp animated" id="card_container" style="float:none;">
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
            </div>
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info']); ?>
            </div>
        </a>
    </div>

    <div class="card_container teaser-xs grid-item fadeInUp animated" id="card_container" style="float:none; clear:both;">
        <a href="<?= Url::to('/services') ?>">            
            <div class="media-area square">                
                <div class="image">
                    <?= Html::img('@web/images/cards/default_avatar.jpg') ?>               
                </div>
            </div>
            <div class="primary-context in-media">
                <div class="head">Heading</div>
            </div>            
            <div class="action-area right">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
            </div>
        </a>
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
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
            </div>
        </a>
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
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
            </div>
        </a>
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


    <div class="card_container record-xl list-item fadeInUp animated" id="card_container" style="float:none; border-left-color: green;">
        <a href="<?= Url::to('/services') ?>">
            
            <table class="main-context"> 
                <tr>
                    <td class="body-area">
                        <div class="primary-context">
                            <div class="head">Devon Konstalting</div>
                            <div class="subhead">Beograd, Srbija</div>
                            <span class="label label-success">arhitekta</span>
                            <span class="label label-primary">izdavanje nekretnina</span>
                        </div>
                        <div class="secondary-context cont">
                            <span><i class="fa fa-globe"></i>&nbsp;164</span>
                            <span>&nbsp;<i class="fa fa-users"></i>&nbsp;283</span>
                            <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;90</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua.</p>
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
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
                <?= Html::a('<i class="fa fa-arrow-right"></i>&nbsp;'.Yii::t('app', 'View'), Url::to(), ['class'=>'btn btn-link']); ?>
                <?= Html::a('<i class="fa fa-eye"></i>&nbsp;'.Yii::t('app', 'Review'), Url::to(), ['class'=>'btn btn-link']); ?>
            </div>
        </a>
    </div>
    <div class="card_container record-xl list-item fadeInUp animated" id="card_container" style="float:none; border-left-color: purple;">
        <a href="<?= Url::to('/services') ?>">
            
            <table class="main-context"> 
                <tr>
                    <td class="body-area">
                        <div class="primary-context">
                            <div class="head">Kantarion Networks</div>
                            <div class="subhead">Beograd, Srbija</div>
                            <span class="label label-default">arhitekta</span>
                            <span class="label label-default">dizajner</span>
                            <span class="label label-primary">izdavanje nekretnina</span>
                        </div>
                        <div class="secondary-context cont">
                            <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                            <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                            <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat.</p>
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
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
            </div>
        </a>
    </div>



    <div class="jumbotron" style="float:none;">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    

    <?php /* $form = kartik\widgets\ActiveForm::begin([

    ]); 
    $url = \yii\helpers\Url::to(['/auto/list-services']); ?>
    <?= $form->field(new CsServices, 'name')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(CsServices::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Search for a service ...'],
            'pluginLoading' => false,
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => $url,
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(city) { return city.text; }'),
                'templateSelection' => new JsExpression('function (city) { return city.text; }'),
            ],
        ]); ?>

    <?php ActiveForm::end(); */ ?>

<div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 26 }' style="">
     <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to('/services') ?>">
            <div class="media-area">                
                <div class="image">
                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
                </div>
            </div>
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
            </div>
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
            </div>
        </a>
    </div>

    <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">
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
                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
                </div>
            </div>
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
            </div>
            <div class="action-area">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service']); ?>
            </div>
        </a>
    </div>


    <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to('/services') ?>">
            
            <div class="primary-context">
                <div class="head">Congratulations</div>
                <div class="subhead">Lorem ipsum</div>
            </div>
            <div class="secondary-context cont">
                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                <p>You have successfully created your Yii-powered application.</p>
            </div>
            <div class="action-area right">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-warning']); ?>
            </div>
        </a>
    </div>


    <div class="card_container record-md grid-item fadeInUp animated" id="card_container" style="float:none;">
        <a href="<?= Url::to('/services') ?>">            
            <div class="primary-context">
                <div class="head">Heading</div>
                <div class="subhead">Lorem ipsum</div>
            </div>
            <div class="secondary-context cont">
                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                <p>You have successfully created your Yii-powered application.</p>
            </div>
            <div class="action-area right">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-success']); ?>
            </div>
        </a>
    </div>
    <?php 
        $query = \common\models\CsServices::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        foreach ($models as $service) {
            echo ServiceBox::widget([
                'serviceId' => $service->id,
                'containerOptions' => '',
                'link' => '/s/'.mb_strtolower(str_replace(' ', '-', $service->t[0]->name)),
                'image' => [
                    'source'=>'info_docs'.substr($service->id, -1).'.jpg',
                ],
                'name' => $service->t[0]->name,
                'subhead' => $service->industry->t[0]->name,
                'description' => $service->industry->t[0]->description,
                'stats' => [
                    'orders'=> 346,
                    'providers' => 71,
                    'promotions' => 102,
                ],
                'price' => [
                    'amount'=> rand(1000, 10000),
                    'currencyCode' => 'RSD',
                    'unit' => 'm',
                ],
                'actionButton' => '',
            ]);
        }  ?>
</div>    

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
