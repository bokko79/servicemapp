<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

$menuItems[] = ['label' => 'Izveštaj stanja', 'url' => [$user->username.'/finances'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user/finances') ? 'active' : null)]];
$menuItems[] = ['label' => 'Transakcije', 'url' => [$user->username.'/transactions'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='transactions/index') ? 'active' : null)]];
$menuItems[] = ['label' => 'Načini plaćanja', 'url' => [$user->username.'/payments'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user-payments/index') ? 'active' : null)]];
$menuItems[] = ['label' => 'Uplata sredstava', 'url' => ['/site/deposit'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='site/deposit') ? 'active' : null)]];
$menuItems[] = ['label' => 'Isplata sredstava', 'url' => ['/site/withdraw'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='site/withdraw') ? 'active' : null)]];

echo Menu::widget([
        'options' => ['class' => 'sidebar-menu'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
?>
