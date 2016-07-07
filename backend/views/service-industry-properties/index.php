<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsServiceSkillsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Service Industry Properties';
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Svojstva delatnosti usluge</small></h2>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?= Html::a('Create New Service Industry Property', ['create'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Services', ['/services/index'], ['class' => 'btn btn-danger']) ?>
    <?= Html::a('Industry Properties', ['/industry-properties/index'], ['class' => 'btn btn-warning']) ?>
</p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'service_id',
            'industry_property_id',
            'requirement',
            'readOnly',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
