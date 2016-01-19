<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use frontend\widgets\Tabs;
use frontend\widgets\Stats;

/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Market'), 'url' => ['/market']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->cardData = [
    'pic' => 'default_avatar', 
];

$this->profileSubNavData = [
    'pic' => 'default_avatar',
    'title' => $model->user->fullname ? $model->user->fullname : $model->user->username,
    'username' => $model->user->username,
    'loc' => $model->user->userDetails->loc->city,        
];

// <!-- TABS -->
$this->tabs = [
    ['url'=>Url::to('/index'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Index'), 'active'=>'provider/services'],
    ['url'=>Url::to('/contact-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Contact'), 'active'=>''],
    ['url'=>Url::to('/about-us'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'About'), 'active'=>''],
    ['url'=>Url::to('/users'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Users'), 'active'=>''],
    ['url'=>Url::to('/login'), 'class'=>'', 'role'=>'', 'icon'=>'fa-dot-circle-o', 'label'=>Yii::t('app', 'Login'), 'active'=>''],

];


$this->profileTitle = [
    'icon'          => '',
    'title'         => ($model->user->fullname!=null) ? $model->user->fullname : $model->user->username,
    'description'   => '',
];

$this->stats = [
    ['title'=>'Posete', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Komentari', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];
?>

<?= $this->render('//layouts/partial/product_head.php', ['model'=>$model]) ?>

<div class="grid-container">
    <div class="grid-row">
        <div class="grid-left">
            <?php // Details Widget ?>
        </div>

        <div class="grid-center" style="">  

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
                    'activity_id',
                    'loc_id',
                    'loc_id2',
                    'loc_within',
                    'delivery_starts',
                    'delivery_ends',
                    'validity',
                    'update_time',
                    'lang_code',
                    'class',
                    'registered_to',
                    'phone_contact',
                    'turn_key',
                    'order_type',
                    'process_id',
                    'success',
                    'success_time',
                    'hit_counter',
                ],
            ]) ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?= $this->render('//layouts/partial/news-feed.php') ?>
            <?= $this->render('//layouts/partial/news.php') ?>
            <?= $this->render('//layouts/partial/footer.php') ?>
        </div>
    </div>
</div>



