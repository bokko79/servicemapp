<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsServiceOrderingFlowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cs Service Ordering Flows');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-service-ordering-flow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cs Service Ordering Flow'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'service_id',
            'industry_properties',
            'object_container',
            'object_models',
            'object_properties',
            // 'object_files',
            // 'object_issues',
            // 'action_properties',
            // 'quantitites',
            // 'locations',
            // 'times:datetime',
            // 'budget',
            // 'advanced',
            // 'notifications',
            // 'terms',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
