<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\CsObjects */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cs Objects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['renderIndex'] = false;
?>
<div class="cs-objects-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'object_id',
            'level',
            'object_type_id',
            'favour',
            'image_id',
            'class',
            'description',
        ],
    ]) ?>

</div>
<?php if($models = $model->models){
    foreach($models as $objectModel){
        echo $objectModel->tName. '<br>';
    }
    } ?>
