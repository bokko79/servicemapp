<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Provider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Providers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provider-view">

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
        'model' => $provider,
        'attributes' => [
            'id',
            'user_id',
            'industry_id',
            'legal_form',
            'phone2',
            'phone3',
            'website',
            'VAT_ID',
            'company_no',
            'bank_acc_no',
            'work_time_start',
            'work_time_end',
            'registration_time',
            'status',
            'is_active',
            'del_upd_time',
            'service_upd_time',
            'score',
            'rate',
            'rating',
            'licence_no',
            'licence_hash',
            'licence_upd_time',
            'hit_counter',
        ],
    ]) ?>

</div>
