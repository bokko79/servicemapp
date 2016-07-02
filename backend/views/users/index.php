<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<h2><?= Html::encode($this->title) ?> <small>Korisnici</small></h2>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

<p><?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?></p>

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

<?php Pjax::begin(); ?> 
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            //'auth_key',
            //'password_hash',
            //'password_reset_token',
            'email:email',
            'fullname',
            'is_provider',           
            // 'invite_hash',
            // 'registered_by',
            // 'type',
            // 'login_count',
            // 'phone',
            // 'phone_verification_hash',
            // 'phone_verification_time',
            // 'rememberme_token',
            // 'role_code',
            // 'status',
            // 'created_at',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?>