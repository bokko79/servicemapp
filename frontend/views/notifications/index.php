<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\NotificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Notifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="notifications-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Notifications'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<fieldset id="box_notification">
    <div class="wrapper">
        <ul class="unstyled">

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
            ]) ?>

        </ul>
    </div><!-- <div class="wrapper"> -->
</fieldset><!-- <fieldset id="box_notification"> -->

</div>
