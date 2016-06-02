<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */

$this->title = Yii::t('app', 'Create Orders');

$this->cart = [
    'session' => Yii::$app->session['cart']['industry'][$service->industry_id]['data'],
    'industry' => $service->industry_id,
];
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>

<?php foreach(Yii::$app->session['cart']['industry'][$service->industry_id]['data'] as $ordered_service){
        echo $this->render('_cart.php', ['order_service'=>$ordered_service, 'objects'=>$objects]);
    } ?>

<?= $this->render('_form', [
	'service' => $service,
    'model' => $model,
    'model_skills' => $model_skills,
    'location'=> $location,
	'location_end'=> $location_end,
	'objects' => $objects,
	'new_user' => $new_user,
	'returning_user' => $returning_user,
]) ?>

