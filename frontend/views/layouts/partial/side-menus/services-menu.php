<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

$menuItems[] = ['label' => 'Usluge', 'url' => [$user->username.'/services'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider-services/index') ? 'active' : null)]];
$menuItems[] = ['label' => 'Prezentacije', 'url' => [$user->username.'/presentations'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/presentations') ? 'active' : null)]];
$menuItems[] = ['label' => 'Promocije', 'url' => [$user->username.'/promotions'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/promotions') ? 'active' : null)]];
$menuItems[] = ['label' => 'Uslovi izvršavanja usluga', 'url' => [$user->username.'/terms'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/terms') ? 'active' : null)]];

echo Menu::widget([
        'options' => ['class' => 'sidebar-menu'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
?>

<div class="margin-top-20 center">
<?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;Napravi novu prezentaciju', Url::to(['/services', 's'=>'present']), ['class'=>'btn btn-default btn-sm']) ?>	
</div>
