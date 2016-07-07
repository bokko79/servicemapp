<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsServiceActionPropertyValuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Service Action Property Values');
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Vrednosti svojstava akcija usluga</small></h2>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p>
    <?= Html::a(Yii::t('app', 'Create New Service Action Property Values'), ['create'], ['class' => 'btn btn-success']) ?>
</p>
<?php Pjax::begin(); ?>   
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'service_action_property_id',
            'action_property_value_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
