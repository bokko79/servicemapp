<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h2><?= c(Html::encode($this->title)) ?> <small>id: <?= $model->id ?> / type: <?= ($model->is_provider==1) ? 'provider' : 'user' ?></small></h2>

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
    <div class="col-sm-3">
        <h5>Type</h5>
        <p>Roles</p>
        <p>Membership</p>
        <p>Status</p>
        <p>Type</p>
        <p>IP address</p>
        <p>online status</p>
        <p>Regeistered by</p>
    </div>

    <div class="col-sm-3">
        <h5>Activity</h5>
        <p>Auctional Orders</p>
        <p>Direct Orders</p>
        <p>Bids</p>
        <p>Bookings</p>
        <p>Feedback</p>
        <p>Presentations</p>
        <p>Promotions</p>
        <p>Posts</p>
        <p>Comments</p>
    </div> 

    <div class="col-sm-3">
        <h5>Stats</h5>
        <p>Login count</p>
        <p>Membership</p>
        <p>Status</p>
        <p>Type</p>
    </div>  

    <div class="col-sm-3">
        <h5>Hashes</h5>
        <p>Invite</p>
        <p>Auth</p>
        <p>Password</p>
        <p>Phone</p>
    </div> 
</div>

<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'username',
        'auth_key',
        'password_hash',
        'password_reset_token',
        'email',
        'unconfirmed_email',
        'fullname',
        'is_provider',
        'invite_hash',
        'registered_by',
        'registered_from',
        'registration_ip',
        'type',
        'logged_in_at',
        'logged_in_from',
        'login_count',
        'last_activity',
        'phone',
        'phone_verification_hash',
        'phone_verification_time',
        'rememberme_token',
        'role_code',
        'status',
        'flags',
        'recovery_token',
        'recovery_sent_at',
        'confirmation_token',
        'confirmation_sent_at',
        'confirmed_at',
        'blocked_at',
        'updated_at',
        'created_at',
    ],
]) ?>