<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserObjectsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Objects');
$this->params['breadcrumbs'][] = $this->title;

$this->cardData = [
        'pic' => 'default_avatar', 
        'subSection' => '',
        'headSection' => '',
        'icon' => '',
        'subtitle' => '',
        'title' => '',    
    ];

$this->stats = [
        ['title'=>'Zahtevi', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
        ['title'=>'Ponude', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
        ['title'=>'Promocije', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
    ];
?>



    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User Objects'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
    ]) ?>

<?php

