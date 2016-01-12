<?php

use yii\helpers\Html;
/*use yii\widgets\DetailView;*/
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">

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
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'Book # ' . $model->id,
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes'=>[
            'id',
            'post_category_id',
            'title',
            'subtitle',
            'body:ntext',
            'status',
            'published',
            'time',
            'description',            
            ['attribute'=>'time', 'type'=>DetailView::INPUT_DATE],
        ]
    ]) ?>
<?php /*
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'post_category_id',
            'title',
            'subtitle',
            'body:ntext',
            'status',
            'published',
            'time',
            'description',
        ],
    ]) */ ?>

</div>



