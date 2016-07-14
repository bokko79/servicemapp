<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Properties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= c(Html::encode($this->title)) ?> <small>class: <?= $model->class ?></small></h2>

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
<div class="row">
    <div class="col-sm-12">
        <div class="card_container record-full grid-item fadeInUp animated" id="card_container" style="float:none;">
            <div class="primary-context">
                <div class="head"><?= c(Html::encode($this->title)) ?> <small class="gray-color">class: <?= $model->class ?></small></div>
                
            </div>
            <div class="secondary-context cont">
                <table class="table table-striped">                              
                    <tr>
                        <td>
                            Type
                        </td>
                        <td>
                            <?= $model->type ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Class
                        </td>
                        <td>
                            <?= $model->class ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Parent
                        </td>
                        <td>
                            <?= $model->parent ? Html::a(c($model->parent->tName), ['view', 'id'=>$model->parent->id]) : null ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Siblings
                        </td>
                        <td>
                            <?php
                                if($model->parent){
                                    foreach ($model->siblings as $key => $sibling){
                                        echo Html::a(c($sibling->tName), ['view', 'id'=>$sibling->id]) . ($key==count($model->siblings)-1 ? null : ' / ');
                                    }
                                } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Children
                        </td>
                        <td>
                            <?php
                                foreach ($model->children as $key => $child){
                                    echo Html::a(c($child->tName), ['view', 'id'=>$child->id]) . ($key==count($model->children)-1 ? null : ' / ');
                                } ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Multiple Values
                        </td>
                        <td>
                            <?= $model->multiple_values==1 ? 'Yes' : 'No' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Translatable Values
                        </td>
                        <td>
                            <?= $model->translatable_values==1 ? 'Yes' : 'No' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Description
                        </td>
                        <td>
                            <?= $model->description ?>
                        </td>
                    </tr>
                </table>
                
                 
            </div>
        </div>
    </div>
        
</div>

<div class="row">

    <div class="col-sm-12">
        <div class="card_container record-full grid-item fadeInUp animated" id="card_container">
            <div class="primary-context gray normal">
                <div class="head"><?= ($model->propertyValues) ? Html::a('Property Values', Url::to(['/property-values/index', 'CsPropertyValuesSearch[property_id]'=>$model->id]), []) : 'Property Values' ?></div>
                <div class="subhead"><?= Html::a('New Property Value', ['/property-values/create', 'CsPropertyValuesSearch[property_id]' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?></div>
            </div>
            <div class="secondary-context">
            <?php      Pjax::begin(); ?>    
                    <?= GridView::widget([
                        'dataProvider' => $propertyValues,
                        'columns' => [
                            'id',
                            [
                                'label'=>'Property Value',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->tName, ['property-values/view', 'id' => $data->id]);
                                },
                            ],
                            [
                                'attribute' => 'selected_value',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return $data->selected_value==1 ? 'Yes' : 'No';
                                },
                            ],
                            'file_id',
                            'video_link',

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
                Pjax::end(); ?>
            </div>
        </div>
    </div>
        
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="card_container record-full grid-item fadeInUp animated" id="card_container">
            <div class="primary-context gray normal">
                <div class="head"><?= ($model->objectProperties) ? Html::a('Object Properties', Url::to(['/object-properties/index', 'CsObjectProperties[property_id]'=>$model->id]), []) : 'Object Properties' ?></div>
                <div class="subhead"><?= Html::a('New Object Property', ['/object-properties/create', 'CsObjectProperties[property_id]' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?></div>
            </div>
            <div class="secondary-context">
            <?php      Pjax::begin(); ?>    <?= GridView::widget([
                        'dataProvider' => $objectProperties,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],

                            'id',
                            [
                                'label'=>'Object',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return Html::a($data->object->tName, ['object-properties/view', 'id' => $data->id]);
                                },
                            ],
                            [
                                'label'=>'Unit',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return $data->unit ? Html::a($data->unit->tName, ['units/view', 'id' => $data->property_unit_id]) : null;
                                },
                            ],
                            'property_class',
                            'property_type',
                            'value_default',
                            [
                                'attribute' => 'multiple_values',
                                'format' => 'raw',
                                'value'=>function ($data) {
                                    return $data->multiple_values==1 ? 'Yes' : 'No';
                                },
                            ],       

                            [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{update}',
                                'buttons' => [
                                    'update' => function ($url, $model, $key) {
                                        return \Yii::$app->user->can('manageCoreDatabase') ? Html::a('Update', ['/object-properties/update', 'id' => $model->id], ['class' => '']) : '';
                                    },
                                ],                        
                            ],
                        ],
                    ]);
                Pjax::end(); ?>
            </div>
        </div>
    </div>
        
</div>

<?php

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
