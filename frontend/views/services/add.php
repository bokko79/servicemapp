<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\checkbox\CheckboxX;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cs Services');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cs-services-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Cs Services'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

<div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 26 }' style="">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_view-form',
    ]) ?>
</div>
</div>
