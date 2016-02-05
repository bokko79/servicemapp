<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\ProviderTerms */

$this->title = $model->provider_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Provider Terms'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provider-terms-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->provider_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->provider_id], [
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
            'provider_id',
            'ip_warranty',
            'performance_warranty',
            'invoicing',
            'payment_methods',
            'payment',
            'payment_advance_percentage',
            'payment_at_once_time',
            'payment_installment_no_rates',
            'payment_installment_rate',
            'payment_installment_frequency',
            'payment_installment_frequency_unit',
            'liability',
            'agreement_effective_until',
            'cancellation_policy',
            'update_time',
        ],
    ]) ?>

</div>
