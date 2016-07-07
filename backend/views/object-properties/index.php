<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = Yii::t('app', 'Object Properties');
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= Html::encode($this->title) ?> <small>Svojstva predmeta</small></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
<p><?= Html::a(Yii::t('app', 'Create New Object Property'), ['create'], ['class' => 'btn btn-success']) ?></p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'object_id',
            'property_id',
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>
