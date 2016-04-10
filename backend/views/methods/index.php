<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsMethodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cs Methods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-methods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cs Methods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'action_id',
            'action_name',
            'property_id',
            'property_name',
            // 'default_value',
            // 'range_min',
            // 'range_max',
            // 'range_step',
            // 'display_order',
            // 'required',
            // 'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
