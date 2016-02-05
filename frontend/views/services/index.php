<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Index usluga');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1 class="padding-bottom-20 padding-top-20"><?= Html::encode($this->title) ?></h1>
<div class="card_container record-full transparent no-border no-shadow hidden-content-container" id="card_container" style="float:none;">   
    <div class="header-context page-title side-widget">
        <h4><i class="fa fa-filter"></i> Filteri <?= Html::a('<i class="fa fa-chevron-right"></i>', null, ['class'=>'btn btn-link float-right show-more']); ?></h4>
    </div>
    <div class="secondary-context hidden hidden-content fadeInDown animated">
        <?= $this->render('_search', ['model' => $searchModel]) ?>
    </div>   
</div>

<div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }' style="margin-top:40px;">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_card',
    ]) ?>

</div>
