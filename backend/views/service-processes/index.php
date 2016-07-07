<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsServiceProcessesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Processes';
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?></h2>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?= Html::a('Create New Service Processes', ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'process_id',
            'service_id',
            'service_order_no',
            'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
