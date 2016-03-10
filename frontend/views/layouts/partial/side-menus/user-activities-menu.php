<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

$menuItems[] = ['label' => 'Porudžbine', 'url' => [Yii::$app->user->identity->username.'/orders'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user/orders') ? 'active' : null)]];
$menuItems[] = ['label' => 'Spremne porudžbine', 'url' => [Yii::$app->user->identity->username.'/ready-orders'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user/saved-orders') ? 'active' : null)]];
$menuItems[] = ['label' => 'Aranžmani', 'url' => [Yii::$app->user->identity->username.'/arrangements'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user/arrangements') ? 'active' : null)]];
$menuItems[] = ['label' => 'Ponude', 'url' => [Yii::$app->user->identity->username.'/bids'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/bids') ? 'active' : null)]];
$menuItems[] = ['label' => 'Prezentacije usluga', 'url' => [Yii::$app->user->identity->username.'/presentations'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/presentations') ? 'active' : null)]];
$menuItems[] = ['label' => 'Promocije usluga', 'url' => [Yii::$app->user->identity->username.'/promotions'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/promotions') ? 'active' : null)]];
$menuItems[] = ['label' => 'Povratne informacije', 'url' => [Yii::$app->user->identity->username.'/feedback'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='feedback/index') ? 'active' : null)]];

echo Menu::widget([
        'options' => ['class' => 'sidebar-menu'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
?>
