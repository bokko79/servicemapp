<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Objects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-objects-view">

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
<?php
// object models
// object properties
// products
// parts
// subclasses
// path
echo '<b>Path: </b>';
foreach ($model->getPath($model) as $path){
    echo Html::a($path->tName, ['view', 'id'=>$path->id]) . ' > ';
}
echo $model->tName;
echo '<br> <b>Subclasses: </b><ul>';
foreach ($model->children as $child){
    echo '<li>'.Html::a($child->tName, ['view', 'id'=>$child->id]) . ' </li> ';
}
echo '</ul>';

echo '<br> <b>Products: </b><ul>';
foreach ($model->products as $product){
    echo '<li>'.Html::a($product->name, ['products/view', 'id'=>$product->id]) . ' </li> ';
}
echo '</ul>';

echo '<br> <b>Properties: </b><ul>';
foreach ($model->getProperties($model) as $property){
    echo '<li>'.$property->property->tName . ' </li> ';
}
echo '</ul>';
echo '<br> <b>Models: </b><ul>';

echo '</ul>';

echo '</ul>';
echo '<br> <b>Parts: </b><ul>';

echo '</ul>';

echo '</ul>';
echo '<br> <b>Inherited properties: </b><ul>';

echo '</ul>';

echo '</ul>';
echo '<br> <b>Inherited models: </b><ul>';

echo '</ul>';

echo '</ul>';
echo '<br> <b>Inherited parts: </b><ul>';

echo '</ul>';

echo '</ul>';
echo '<br> <b>Parts properties: </b><ul>';

echo '</ul>';
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
            'description',
        ],
    ]) ?>

</div>
