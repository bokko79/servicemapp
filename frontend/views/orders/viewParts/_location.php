<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

/* items */

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
?>
<div class="card_container record-full" id="card_container" style="float:none;">
    <?php /* time/loc */ ?>
    <div class="hidden-content-container">
        <div class="header-context">                    
            <div class="avatar center gray-color">
                <i class="fa fa-map-marker fa-3x"></i>    
            </div>
            <div class="title">
                <div class="subhead"><?= Yii::t('app', 'delivery location') ?></div> 
                <div class="head second"><?= $model->loc->city ?></div>                           
            </div>
            <?= Html::a('<i class="fa fa-chevron-right"></i>', null, ['class'=>'btn btn-link float-right show-more', 'id'=>'mapShowTrigger']); ?>
        </div>
        <div class="media-screen hidden hidden-content no-margin" id="map_container">                   
            <?php $map->display() ?>
        </div>
    </div>                                               
</div>