<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

// 1 SPECIFICATIONS
if($service->serviceSpecs!=null or ($service->object->isPart() && $service->object->parent->specs)):
	$menuItems[] = ['label' => '1. '. 'Karakteristike '.$service->object->tNameGen. '<span class="check01 float-right"><i class="fa"></i></span>', 'url' => '#specification', 'options'=>[]];   	   
endif;
// 2 PICS
	$menuItems[] = ['label' => $model->noPic.'. '. 'Slike '.$service->object->tNameGen. '<span class="check02 float-right"><i class="fa"></i></span>', 'url' => '#pics', 'options'=>[]];
// 3 ISSUES 
if($service->service_type==6 && ($service->object->issues or (count($object_model)==1 and $object_model[0]->issues))):
	$menuItems[] = ['label' => $model->noIssues.'. '. 'Problemi '.$service->object->tNameGen. '<span class="check03 float-right"><i class="fa"></i></span>', 'url' => '#issues', 'options'=>[]];
endif;
// 4 METHODS
if($service->serviceMethods):
	$menuItems[] = ['label' => $model->noMethods.'. '.c($service->action->tName). '<span class="check04 float-right"><i class="fa"></i></span>', 'url' => '#action', 'options'=>[]];
endif;
// 5 TITLE & DESC
	$menuItems[] = ['label' => $model->noTitle.'. '. 'Ime i opis <span class="check05 float-right"><i class="fa"></i></span>', 'url' => '#title', 'options'=>[]];
// 6 LOCATIONS 
if($service->location!=0):
	$menuItems[] = ['label' => $model->noLocation.'. '. 'Lokacija <span class="check06 float-right"><i class="fa"></i></span>', 'url' => '#locations', 'options'=>[]];
endif;
// 7 PRICE 
if($service->pricing!=0):
	$menuItems[] = ['label' => $model->noPrice.'. '. 'Cena <span class="check07 float-right"><i class="fa"></i></span>', 'url' => '#price', 'options'=>[]];
endif;
// 8 AMOUNT
if($service->amount!=0 && $service->service_object!=1):
	$menuItems[] = ['label' => $model->noAmount.'. '. 'Količina <span class="check08 float-right"><i class="fa"></i></span>', 'url' => '#amount', 'options'=>[]];
endif;
// 9 CONSUMER 
if($service->consumer!=0):
	$menuItems[] = ['label' => $model->noConsumer.'. '. 'Broj korisnika <span class="check09 float-right"><i class="fa"></i></span>', 'url' => '#consumer', 'options'=>[]];
endif;

// 10 AVAILABILITY 
if($service->availability!=0):
	$menuItems[] = ['label' => $model->noAvailability.'. '. 'Dostupnost <span class="check10 float-right"><i class="fa"></i></span>', 'url' => '#availability', 'options'=>[]];
endif;
// 11 OTHER
	$menuItems[] = ['label' => $model->noOther.'. '. 'Ostala podešavanja <span class="check11 float-right"><i class="fa"></i></span>', 'url' => '#other', 'options'=>[]];
// 12 NOTIFICATIONS
	$menuItems[] = ['label' => $model->noNotifications.'. '. 'Notifikacije <span class="check12 float-right"><i class="fa"></i></span>', 'url' => '#notifications', 'options'=>[]];
// 13 TERMS
	$menuItems[] = ['label' => $model->noTerms.'. '. 'Uslovi izvršenja <span class="check13 float-right"><i class="fa"></i></span>', 'url' => '#terms', 'options'=>[]];
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
