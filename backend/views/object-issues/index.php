<?php

use yii\helpers\Html;
use yii\helpers\Url;
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
        <?= Html::a('Objects', ['/objects/index'], ['class' => 'btn btn-warning']) ?>
        <?php if($object = Yii::$app->request->get('CsObjectIssuesSearch')){
            echo Html::a('Object', ['/objects/view', 'id' => $object['object_id']], ['class' => 'btn btn-default']);
        } ?>
    </p>

<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'id',
                'options' => ['style' =>'width:50px'],
            ],
            [
                'attribute' => 'object_id',
                'format' => 'raw',
                'value'=>function ($data) {
                    return Html::a($data->object->tName, Url::to(['/objects/view', 'id'=>$data->object_id]), []);
                },
            ],
            'issue',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
