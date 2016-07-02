<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Objects', 'url' => ['index']];
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
<?php
// object models
// object properties
// products
// parts
// subclasses
// path
?>
<div class="row">

    <div class="col-sm-12">
        <div class="card_container record-full grid-item fadeInUp animated" id="card_container" style="float:none;">
            <table class="main-context"> 
                <tr>
                    <td class="body-area">
                        <div class="primary-context">
                            <div class="head"><?= c(Html::encode($this->title)) ?> <small class="gray-color">class: <?= $model->class ?></small></div>
                            <div class="subhead"><?php
                                foreach ($model->getPath($model) as $path){
                                    echo Html::a($path->tName, ['view', 'id'=>$path->id]) . ' > ';
                                } ?> <?= $model->tName ?></div>
                        </div>
                        <div class="secondary-context cont">
                            Path
                             <?php
                                foreach ($model->getPath($model) as $path){
                                    echo Html::a($path->tName, ['view', 'id'=>$path->id]) . ' > ';
                                } ?> <?= $model->tName ?>
                        </div>
                    </td>
                    <td class="media-area">
                        <div >                
                            <div class="image">
                                <?= Html::img('/images/objects/'.$model->image->ime) ?>
                            </div>
                        </div> 
                    </td>
                </tr>                        
            </table>
            <div class="action-area right">
                <?= Html::a('<i class="fa fa-edit"></i>', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                <?= Html::a('<i class="fa fa-times"></i>', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
        
</div>
        
<div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }' style="margin:40px 0;">
      

        <div class="card_container record-33 grid-item grid-item fadeInUp animated" id="card_container">
            <div class="primary-context gray normal">
                <div class="head major">Subclasses</div>
            </div>
            <div class="secondary-context">
                <ul>
                <?php
                    foreach ($model->children as $child){
                        echo '<li>'.Html::a(c($child->tName), ['view', 'id'=>$child->id]) . ' </li> ';
                    } ?>
                </ul>
            </div>
        </div>

        <div class="card_container record-33 grid-item fadeInUp animated" id="card_container">
            <div class="primary-context gray normal">
                <div class="head major">Products</div>
                <div class="subhead"></div>
            </div>
            <div class="secondary-context">
                <ul>
                <?php
                    foreach ($model->products as $product){
                        echo '<li>'.Html::a(c($product->name), ['products/view', 'id'=>$product->id]) . ' </li> ';
                    } ?>
                </ul>
            </div>
        </div>

        <div class="card_container record-33 grid-item fadeInUp animated" id="card_container">
            <div class="primary-context gray normal">
                <div class="head major">Properties</div>
                <div class="subhead"></div>
            </div>
            <div class="secondary-context">
                All Properties: <br>
                <ul>
                <?php
                    foreach ($model->getProperties($model) as $property){
                        echo '<li>'.c($property->property->tName) . ' </li> ';
                    } ?>
                </ul>
            </div>

            <div class="secondary-context">
                Inherited Properties: <br>
                <ul>
                <?php
                    foreach ($model->getProperties($model) as $property){
                        echo '<li>'.c($property->property->tName) . ' </li> ';
                    } ?>
                </ul>
            </div>
        </div>

        <div class="card_container record-33 grid-item fadeInUp animated" id="card_container">
            <div class="primary-context gray normal">
                <div class="head major">Models</div>
                <div class="subhead"></div>
            </div>
            <div class="secondary-context">
                All Models: <br>
                <ul>
                <?php
                    foreach ($model->getProperties($model) as $property){
                        echo '<li>'.$property->property->tName . ' </li> ';
                    } ?>
                </ul>
            </div>

            <div class="secondary-context">
                Inherited Models: <br>
                <ul>
                <?php
                    foreach ($model->getProperties($model) as $property){
                        echo '<li>'.$property->property->tName . ' </li> ';
                    } ?>
                </ul>
            </div>
        </div>

        <div class="card_container record-33 grid-item fadeInUp animated" id="card_container">
            <div class="primary-context gray normal">
                <div class="head major">Parts</div>
                <div class="subhead"></div>
            </div>
            <div class="secondary-context">
                All Parts: <br>
                <ul>
                <?php
                    foreach ($model->getProperties($model) as $property){
                        echo '<li>'.$property->property->tName . ' </li> ';
                    } ?>
                </ul>
            </div>

            <div class="secondary-context">
                Inherited Parts: <br>
                <ul>
                <?php
                    foreach ($model->getProperties($model) as $property){
                        echo '<li>'.$property->property->tName . ' </li> ';
                    } ?>
                </ul>
            </div>
        </div>

        <div class="card_container record-33 grid-item fadeInUp animated" id="card_container">
            <div class="primary-context gray normal">
                <div class="head major">Part properties</div>
                <div class="subhead"></div>
            </div>
            <div class="secondary-context">
                <ul>
                <?php
                    foreach ($model->getProperties($model) as $property){
                        echo '<li>'.$property->property->tName . ' </li> ';
                    } ?>
                </ul>
            </div>
        </div>
</div>

<?php
?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'object_type_id',
            'object_id',
            'level',
            'class',
            'favour',
            'image_id',
        ],
    ]) ?>

