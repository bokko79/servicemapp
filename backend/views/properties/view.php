<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\CsProperties */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
<div class="col-sm-6">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'tName',
            'translation.name_akk',
            'parent.tName',
            //'children',
            'type',
            'class',
            'description',
        ],
    ]) ?>
</div>
<div class="col-sm-6">
<?php
//parent
if($model->parent):
    echo '<h5>Parent: ' . Html::a($model->parent->tName, ['view', 'id' => $model->parent->id], ['class' => '']) . ' </h5> ';
endif;
// children
if($model->children):
    echo '<h5>Children: </h5><ul>';
foreach ($model->children as $child){
    echo '<li>'.Html::a($child->tName, ['view', 'id' => $child->id], ['class' => '']) . ' </li> ';
}
echo '</ul>';
endif;  ?>
</div>
<div class="col-sm-12">
<?php
// values
if($model->propertyValues):
echo '<h5 class="margin-top-20">Property Values: </h5>'; 
    
Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProviderPropertyValues,
        //'filterModel' => $searchModelPropertyValues,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            //'property.tName',
            'value',
            'tName',
            //'translation.name_akk',
            //'translation.hint',
            'selected_value',
            'image_id',
            'video_link',
            'description',

            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'view') {
                                        $url = Url::to('/property-values/view?id='.$model->id); // your own url generation logic
                                        return $url;
                                    }
                                },
            ],
        ],
    ]);
Pjax::end();
endif;

// property of objects
if($model->objectProperties):
echo '<h5 class="margin-top-20">Objects (object_properties): </h5> (predmeti koji imaju ovo svojstvo) '; 
Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProviderObjectProperties,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            'object.tName',
            'unit.tName',
            'property_class',
            'property_type',
            'value_default',
            'value_min',
            'value_max',
            'step',
            'pattern',
            'display_order',
            'multiple_values',
            'specific_values',
            'read_only',
            'required',
            

            [
                'class' => 'yii\grid\ActionColumn',
                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'view') {
                                        $url = Url::to('/object-properties/view?id='.$model->id); // your own url generation logic
                                        return $url;
                                    }
                                    if ($action === 'update') {
                                        $url = Url::to('/object-properties/update?id='.$model->id); // your own url generation logic
                                        return $url;
                                    }
                                },
            ],
        ],
    ]);
Pjax::end();
endif;

// property of actions
/*if($model->actionProperties):
echo '<h5 class="margin-top-20">Objects: </h5>'; 
Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProviderActionProperties,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'object.tName',
            'property_class',
            'property_type',
            'value_default',
            'value_min',
            'value_max',
            'step',
            'pattern',
            'display_order',
            'multiple_values',
            'specific_values',
            'read_only',
            'required',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
Pjax::end();
endif;

// property of industries
if($model->industryProperties):
echo '<h5 class="margin-top-20">Objects: </h5>'; 
Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProviderIndustryProperties,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'object.tName',
            'property_class',
            'property_type',
            'value_default',
            'value_min',
            'value_max',
            'step',
            'pattern',
            'display_order',
            'multiple_values',
            'specific_values',
            'read_only',
            'required',
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
Pjax::end();
endif;*/
?>

</div>
