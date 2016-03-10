<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PresentationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Presentations');
$this->params['breadcrumbs'][] = $this->title;
$this->params['user'] = $user;
$pageDescription .= '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Kada izaberete Vaš predmet usluge, na ovoj stranici se nalazi spisak svih izabranih predmeta. Klikom na naslov svakog njih možete ih dodatno podešavati i tako olakšati i ubrzati kupovinu ili naručivanje usluga.').'</p>';
$this->pageTitle = [
    'icon' => 'credit-card',     
    'title' => Html::encode($this->title).Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Dodaj nov način plaćanja'), Url::to('/new-payment'), ['class' => 'btn btn-success btn-sm float-right']),
    'description' => $pageDescription,
    'search' => $searchModel,
];
?>
<div class="presentations-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Presentations'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        },
    ]) ?>
</div>
