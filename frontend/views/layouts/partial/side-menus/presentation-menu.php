<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

// 1 SPECIFICATIONS AND OBJECT AVAILABILITY
if($service->serviceSpecs!=null or ($service->object->isPart() && $service->object->parent->specs)):
	$menuItems[] = ['label' => '1. '. 'Karakteristike '.$service->object->tNameGen. '<span class="check01 float-right"><i class="fa"></i></span>', 'url' => '#specification', 'options'=>[]];   	   
endif;
// 2 PICS, DOCS AND MEDIA
	$menuItems[] = ['label' => $data->noPic.'. '. 'Slike '.$service->object->tNameGen. '<span class="check02 float-right"><i class="fa"></i></span>', 'url' => '#pics', 'options'=>[]];
// 3 ISSUES WITH THE OBJECTS 
if($service->service_type==6 && ($service->object->issues or (count($object_model)==1 and $object_model[0]->issues))):
	$menuItems[] = ['label' => $data->noIssues.'. '. 'Problemi '.$service->object->tNameGen. '<span class="check03 float-right"><i class="fa"></i></span>', 'url' => '#issues', 'options'=>[]];
endif;
// 4 METHODS AND DURATION
if($service->serviceMethods):
	$menuItems[] = ['label' => $data->noMethods.'. '.c($service->action->tName). '<span class="check04 float-right"><i class="fa"></i></span>', 'url' => '#action', 'options'=>[]];
endif;
// 5 TITLE & DESC
	$menuItems[] = ['label' => $data->noTitle.'. '. 'Naslov i opis <span class="check05 float-right"><i class="fa"></i></span>', 'url' => '#title', 'options'=>[]];
// 6 LOCATION AND COVERAGE  
if($service->location!=0):
	$menuItems[] = ['label' => $data->noLocation.'. '. 'Lokacija i pokrivenost <span class="check06 float-right"><i class="fa"></i></span>', 'url' => '#locations', 'options'=>[]];
endif;
// 7 PRICE AND PRICE CORRECTIONS 
if($service->pricing!=0):
	$menuItems[] = ['label' => $data->noPrice.'. '. 'Cena <span class="check07 float-right"><i class="fa"></i></span>', 'url' => '#price', 'options'=>[]];
endif;
// 8 PRICE AND PRICE CORRECTIONS
if($service->amount!=0 or $service->service_object!=1):
	$menuItems[] = ['label' => $data->noAmount.'. '. 'Količina <span class="check08 float-right"><i class="fa"></i></span>', 'url' => '#amount', 'options'=>[]];
endif;
// 9 CONSUMER 
if($service->consumer!=0):
	$menuItems[] = ['label' => $data->noConsumer.'. '. 'Broj korisnika <span class="check09 float-right"><i class="fa"></i></span>', 'url' => '#consumer', 'options'=>[]];
endif;
// 10 AVAILABILITY 
if($service->availability!=0):
	$menuItems[] = ['label' => $data->noAvailability.'. '. 'Radno vreme <span class="check10 float-right"><i class="fa"></i></span>', 'url' => '#availability', 'options'=>[]];
endif;
// 11 VALIDITY
	$menuItems[] = ['label' => $data->noValidity.'. '. 'Važenje ponude <span class="check11 float-right"><i class="fa"></i></span>', 'url' => '#validity', 'options'=>[]];
if(Yii::$app->controller->action->id=='update'):
// 12 NOTIFICATIONS
	$menuItems[] = ['label' => $data->noNotifications.'. '. 'Notifikacije <span class="check12 float-right"><i class="fa"></i></span>', 'url' => '#notifications', 'options'=>[]];
// 13 TERMS
	$menuItems[] = ['label' => $data->noTerms.'. '. 'Uslovi izvršenja <span class="check13 float-right"><i class="fa"></i></span>', 'url' => '#terms', 'options'=>[]];
endif;
// 14 OTHER
	//$menuItems[] = ['label' => $data->noOther.'. '. 'Ostala podešavanja <span class="check14 float-right"><i class="fa"></i></span>', 'url' => '#other', 'options'=>[]];
// 15 LOGIN/REGISTER
if(Yii::$app->user->isGuest):
	$menuItems[] = ['label' => $data->noUac.'. '. 'Vaši podaci <span class="check15 float-right"><i class="fa"></i></span>', 'url' => '#uac', 'options'=>[]];
endif;

echo Menu::widget([
        'options' => ['class' => 'sidebar-menu', 'style'=>'position:fixed; width:200px;'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
?>
