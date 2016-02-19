<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */

$this->title = Yii::t('app', 'Create Orders');
$this->pageTitle = [
		'icon' => '',
		'title' => $this->title,
		'description' => '',
	];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>

<?php foreach(Yii::$app->session['cart']['industry'][$service->industry_id] as $ordered_service){
        echo $this->render('parts/_cart.php', ['order_service'=>$ordered_service]);
    } ?>

    <?= $this->render('_form', [
    	'service' => $service,
        'model' => $model,
        'location'=> $location,
		'location_end'=> $location_end,
		'no_location' => $no_location,
        'no_time' => $no_time,
        'no_freq' => $no_freq,
    ]) ?>

