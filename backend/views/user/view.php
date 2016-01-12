<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

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
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'email_reset_hash:email',
            'email_reset_time:email',
            'fullname',
            'is_provider',
            'ip_address',
            'activation_hash',
            'activation_time',
            'invite_hash',
            'registered_by',
            'type',
            'last_login_time',
            'login_count',
            'login_hash',
            'online_status',
            'last_activity',
            'phone',
            'phone_verification_hash',
            'phone_verification_time',
            'rememberme_token',
            'role_code',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>