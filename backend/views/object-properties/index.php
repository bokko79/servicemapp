<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\CsObjectPropertiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cs Object Properties');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-object-properties-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cs Object Properties'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'object_id',
            'object_name',
            'property_id',
            'property_name',
            // 'property_unit_id',
            // 'property_unit_imperial_id',
            // 'property_class',
            // 'property_type',
            // 'input_type',
            // 'value_default',
            // 'value_min',
            // 'value_max',
            // 'step',
            // 'pattern',
            // 'display_order',
            // 'multiple_values',
            // 'specific_values',
            // 'read_only',
            // 'required',
            // 'description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
