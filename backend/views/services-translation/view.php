<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CsServicesTranslation */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Cs Services Translations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-services-translation-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'service_id',
            'lang_code',
            'name',
            'orig_name',
            'note:ntext',
            'subnote:ntext',
            'description',
        ],
    ]) ?>

</div>