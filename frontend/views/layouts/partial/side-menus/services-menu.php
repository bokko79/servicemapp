<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;

foreach($industries as $pindustry){
	$industry = $pindustry->industry;
	$items = [];
	if($pservices = $pindustry->services){
		foreach($pservices as $pservice){
			$service = $pservice->service;
			$items[] = ['label' => c($service->tName), 'url' => '#service'.$pservice->id, 'options'=>[]];
		}
	}
	$menuItems[] = ['label' => '<i class="fa '.$industry->icon.'"></i> '.c($industry->tName), 'url' => '#industry'.$pindustry->id, 'options'=>[], 'items'=>$items];	
}
/*$menuItems[] = ['label' => 'Prezentacije', 'url' => [$user->username.'/presentations'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/presentations') ? 'active' : null)]];
$menuItems[] = ['label' => 'Promocije', 'url' => [$user->username.'/promotions'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/promotions') ? 'active' : null)]];*/
//$menuItems[] = ['label' => 'Uslovi izvršavanja usluga', 'url' => ['/'.$user->username.'/terms'], 'options'=>['class'=>((Yii::$app->controller->getRoute()=='provider/terms') ? 'active' : null)]];
echo Menu::widget([
        'options' => ['class' => 'sidebar-menu', 'style'=>'position:fixed; width:200px;'],
        'encodeLabels' => false,
        'items' => $menuItems,
    ]);
?>
<?php /*
<div class="margin-top-20 center">
<?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;Napravi novu prezentaciju', Url::to(['/services', 's'=>'present']), ['class'=>'btn btn-default btn-sm']) ?>	
</div> */ ?>
