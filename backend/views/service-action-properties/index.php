<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsServiceMethodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Action Properties';
$this->params['breadcrumbs'][] = $this->title;
?>


    <h2><?= Html::encode($this->title) ?> <small>Svojstva akcije usluge</small></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create New Service Action Property', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'service_id',
            'action_property_id',
            'requirement',
            'readOnly',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
