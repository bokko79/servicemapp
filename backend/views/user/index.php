<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            // 'email:email',
            // 'email_reset_hash:email',
            // 'email_reset_time:email',
            // 'fullname',
            // 'is_provider',
            // 'ip_address',
            // 'activation_hash',
            // 'activation_time',
            // 'invite_hash',
            // 'registered_by',
            // 'type',
            // 'last_login_time',
            // 'login_count',
            // 'login_hash',
            // 'online_status',
            // 'last_activity',
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

</div>