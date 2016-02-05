<?php

use yii\helpers\Html;
use yii\widgets\ListView;

use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\widgets\Card;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ActivitiesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Market feed');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activities-index">
    <h1 class="padding-top-20 padding-bottom-20"><?= Html::encode($this->title) ?> <span class="float-right fs_12 bold">sort by <?= Html::dropDownList('sort', null, [
            'value1' => 'time ascending',
            'value2' => 'time descending',
        ], []) ?></span></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_card',
    'summary'=>'', 
]) ?>