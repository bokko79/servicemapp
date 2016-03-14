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
use dosamigos\google\maps\overlays\Circle;

/* items */

/* maps */
$coord = new LatLng(['lat' => $model->loc->lat, 'lng' => $model->loc->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => ($model->loc_within) ? 10 : 15,
    
]);

$map->width = '100%';
$map->height = '420';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);
// Lets add a marker now
$circle = new Circle([
    'center' => $coord,
    'radius' => ($model->loc_within) ? $model->loc_within*1000 : 500,
    'strokeColor' => '#2196F3',
    'strokeWeight' => 1,
    'fillOpacity' => 0.08,
    //'editable' => true,
]);

// Add marker to the map
//$map->addOverlay($marker);
$map->addOverlay($circle);

/*$map->appendScript("google.maps.event.addDomListener(mapShowTrigger, 'click', function() {
        $(this).closest('.hidden-content-container').find('div.hidden-content').toggleClass('hidden');
        initialize();
    });");*/
?>
<div class="card_container record-full" id="service-location" style="float:none;">
    <?php /* time/loc */ ?>
    <div class="hidden-content-container">
        <div class="header-context">                    
            <div class="avatar center gray-color">
                <i class="fa fa-map-marker fa-3x"></i>    
            </div>
            <div class="title">
                <div class="subhead"><?= Yii::t('app', 'Lokacija izvršenja usluge') ?></div> 
                <div class="head second"><?= $model->loc->location_name ?></div>                           
            </div>            
        </div>
        <div class="media-screen no-margin" id="gmap0-map-canvas">                   
            <?php $map->display() ?>
        </div>
    </div>                                               
</div>