<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cs Products');
$this->params['breadcrumbs'][] = $this->title;
?>

    <h2><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create New Product'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php if($object = Yii::$app->request->get('CsProductsSearch')){
            echo Html::a('Object', ['/objects/view', 'id' => $object['cs_products.object_id']], ['class' => 'btn btn-default']);
        } ?>
    </p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'object_id',
            'object_property_id',
            'name',
            // 'product_id',
            // 'level',
            // 'class',
            // 'base_product_id',
            // 'predecessor_id',
            // 'successor_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
