<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Services';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create New Service', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            //'image_id',
            'industry_id',
            //'action_id',
            't.name',
            // 'object_id',
            // 'object_model_relevance',
            // 'service_type',
            'unit.oznaka',
            'amount',
            // 'amount_default',
            // 'amount_range_min',
            // 'amount_range_max',
            // 'amount_range_step',
            'consumer',
            // 'consumer_children',
            // 'consumer_default',
            // 'consumer_range_min',
            // 'consumer_range_max',
            // 'consumer_range_step',
            'service_object',
            'pic',
            'location',
            'time',
            // 'duration',
            // 'frequency',
            // 'support',
            // 'turn_key',
            // 'tools',
            // 'labour_type',
            'coverage',
            // 'geospecific',
            // 'process',
            // 'dat',
            // 'availability',
            // 'ordering',
            // 'pricing',
            // 'terms',
            // 'status',
            // 'added_by',
            // 'added_time',
            // 'hit_counter',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>

