<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PresentationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Presentations');
$this->params['breadcrumbs'][] = $this->title;
$this->params['searchModel'] = $searchModel;
$this->params['service'] = $service;
$this->params['model_specs'] = $model_specs;
$this->params['model_methods'] = $model_methods;
$this->params['location'] = $location;
?>

<?php if($service): ?>
	<h2 class="margin-top-20">Ponude pružalaca za uslugu <?= $service->tName ?></h2>
<?php endif; ?>
<hr>

<?php /* $this->render('_search.php', [
                    'model'=>$searchModel, 
                    'service'=>$service, 
                    'model_specs' => $model_specs, 
                    'model_methods' => $model_methods, 
                    'location' => $location,
                ]) */ ?>
<hr>
<?= Html::ul([Html::a('<i class="fa fa-sort-numeric-asc"></i> Cena', Url::current(['sort'=>'price']), [])], ['encode'=>false]) ?>
<?= Html::a('<i class="fa fa-table"></i>', Url::current(['advanced-view'=>null]), ['class'=>'btn btn-link']) ?>
<?= Html::a('<i class="fa fa-list"></i>', Url::current(['advanced-view'=>'list']), ['class'=>'btn btn-link']) ?>
<?php /*<div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }' style="margin:40px 0;">
 */ ?>  <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => Yii::$app->request->get('advanced-view')=='list' ? '_card_list' : '_card',
        'layout' => '{summary}{pager}{items}',
        //'summary' => '',
    ]) ?>
<?php /*</div>*/?>
