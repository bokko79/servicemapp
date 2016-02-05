<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Feedback */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Feedbacks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-view">

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

<?= StarRating::widget([
    'name' => 'rating_21',
    'pluginOptions' => [
        'min' => 0,
        'max' => 12,
        'step' => 2,
        'size' => 'lg',
        'starCaptions' => [
            0 => 'Extremely Poor',
            2 => 'Very Poor',
            4 => 'Poor',
            6 => 'Ok',
            8 => 'Good',
            10 => 'Very Good',
            12 => 'Extremely Good',
        ],
        'starCaptionClasses' => [
            0 => 'text-danger',
            2 => 'text-danger',
            4 => 'text-warning',
            6 => 'text-info',
            8 => 'text-primary',
            10 => 'text-success',
            12 => 'text-success'
        ],
    ],
]) ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'activity_id',
            'offer_id',
            'agreement_id',
            'description',
        ],
    ]) ?>

</div>
