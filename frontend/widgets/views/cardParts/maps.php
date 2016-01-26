<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$coord = new LatLng(['lat' => $location->lat, 'lng' => $location->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,    
]);

$map->width = '100%';

switch ($size) {
    case 'xl':
        $map->height = ($version==1) ? '366' : '650';
        break;
    case 'md':
        $map->height = ($version==1) ? '176' : '320';
        break;
    case 'sm':
        $map->height = ($version==1) ? '152' : '270';
        break;
    case 'xs':
        $map->height = ($version==1) ? '113' : '200';
        break;    
    default:
        $map->height = ($version==1) ? '492' : '875';
        break;
}
// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    //'title' => 'My Home Town',
]);
// Add marker to the map
$map->addOverlay($marker);
?>
<div class="media-area <?= ($version==1) ? null : 'square' ?> <?= $options ?>">
    <?= $map->display() ?>
</div>