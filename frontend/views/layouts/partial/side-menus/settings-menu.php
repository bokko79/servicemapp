<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

$menuItems[] = ['label' => 'Profil', 'url' => [Yii::$app->user->identity->username.'/setup'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user/update') ? 'active' : null)]];
$menuItems[] = ['label' => 'Portfolio', 'url' => [Yii::$app->user->identity->username.'/portfolio-setup'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/update') ? 'active' : null)]];
$menuItems[] = ['label' => 'Nalog', 'url' => [Yii::$app->user->identity->username.'/account-setup'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user/account') ? 'active' : null)]];
$menuItems[] = ['label' => 'Notifikacije', 'url' => [Yii::$app->user->identity->username.'/notifications-setup'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user-notifications/update') ? 'active' : null)]];
$menuItems[] = ['label' => 'Načini plaćanja', 'url' => [Yii::$app->user->identity->username.'/payments'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user-payments/index') ? 'active' : null)]];
$menuItems[] = ['label' => 'Članstvo', 'url' => ['/membership'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='site/membership') ? 'active' : null)]];
$menuItems[] = ['label' => 'Lokacije', 'url' => [Yii::$app->user->identity->username.'/locations'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user-locations/index') ? 'active' : null)]];
$menuItems[] = ['label' => 'Predmeti usluga', 'url' => [Yii::$app->user->identity->username.'/objects'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='user-objects/index') ? 'active' : null)]];
$menuItems[] = ['label' => 'Veštine', 'url' => [Yii::$app->user->identity->username.'/skills'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider-industry-skills/index') ? 'active' : null)]];
$menuItems[] = ['label' => 'Delatnosti', 'url' => [Yii::$app->user->identity->username.'/industries'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider-industries/index') ? 'active' : null)]];
$menuItems[] = ['label' => 'Usluge', 'url' => [Yii::$app->user->identity->username.'/services'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider-services/index') ? 'active' : null)]];
$menuItems[] = ['label' => 'Uslovi izvršavanja usluga', 'url' => [Yii::$app->user->identity->username.'/terms'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider-terms/update') ? 'active' : null)]];

echo Menu::widget([
        'options' => ['class' => 'sidebar-menu right'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
?>
