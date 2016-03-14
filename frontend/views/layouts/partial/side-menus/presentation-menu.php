<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

// 1 METHODS
if($service->serviceMethods):
	$menuItems[] = ['label' => '1. '.c($service->action->tName). '<span class="check01 float-right"><i class="fa"></i></span>', 'url' => '#action', 'options'=>[]];
endif;
// 2 SPECIFICATIONS
if($service->serviceSpecs):
	$menuItems[] = ['label' => $model->noSpecs.'. '. 'Karakteristike '.$service->object->tNameGen. '<span class="check02 float-right"><i class="fa"></i></span>', 'url' => '#specification', 'options'=>[]];   	   
endif;
// 3 PICS
	$menuItems[] = ['label' => $model->noPic.'. '. 'Slike '.$service->object->tNameGen. '<span class="check03 float-right"><i class="fa"></i></span>', 'url' => '#pics', 'options'=>[]];
// 4 ISSUES 
if($service->service_type==6 && $service->object->issues):
	$menuItems[] = ['label' => $model->noIssues.'. '. 'Problemi '.$service->object->tNameGen. '<span class="check04 float-right"><i class="fa"></i></span>', 'url' => '#issues', 'options'=>[]];
endif;
// 5 TITLE & DESC
	$menuItems[] = ['label' => $model->noTitle.'. '. 'Ime i opis <span class="check05 float-right"><i class="fa"></i></span>', 'url' => '#title', 'options'=>[]];
// 6 LOCATIONS 
if($service->location!=0):
	$menuItems[] = ['label' => $model->noLocation.'. '. 'Lokacija <span class="check06 float-right"><i class="fa"></i></span>', 'url' => '#locations', 'options'=>[]];
endif;
// 7 AMOUNT
if($service->amount!=0):
	$menuItems[] = ['label' => $model->noAmount.'. '. 'Količina <span class="check07 float-right"><i class="fa"></i></span>', 'url' => '#amount', 'options'=>[]];
endif;
// 8 CONSUMER 
if($service->consumer!=0):
	$menuItems[] = ['label' => $model->noConsumer.'. '. 'Broj korisnika <span class="check08 float-right"><i class="fa"></i></span>', 'url' => '#consumer', 'options'=>[]];
endif;
// 9 PRICE 
if($service->pricing!=0):
	$menuItems[] = ['label' => $model->noPrice.'. '. 'Cena <span class="check09 float-right"><i class="fa"></i></span>', 'url' => '#price', 'options'=>[]];
endif;
// 10 AVAILABILITY 
if($service->availability!=0):
	$menuItems[] = ['label' => $model->noAvailability.'. '. 'Dostupnost <span class="check10 float-right"><i class="fa"></i></span>', 'url' => '#availability', 'options'=>[]];
endif;
// 11 OTHER
	$menuItems[] = ['label' => $model->noOther.'. '. 'Ostala podešavanja <span class="check11 float-right margin-left-10"><i class="fa fa-plus"></i></span>', 'url' => '#other', 'options'=>[]];
// 12 NOTIFICATIONS

// 13 TERMS

// 14 LOGIN/REGISTER
if(Yii::$app->user->isGuest):
	$menuItems[] = ['label' => $model->noUac.'. '. 'Vaši podaci <span class="check14 float-right"><i class="fa"></i></span>', 'url' => '#uac', 'options'=>[]];
endif;

echo Menu::widget([
        'options' => ['class' => 'sidebar-menu', 'style'=>'position:fixed; width:200px;'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
?>
