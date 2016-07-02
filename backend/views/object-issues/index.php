<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsObjectIssuesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Object Issues';
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?> <small>Problemi predmeta</small></h2>    
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create New Object Issue', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'object_id',
            'issue',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
