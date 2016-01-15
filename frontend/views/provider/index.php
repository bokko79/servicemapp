<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProviderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Providers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provider-index" style="margin-top:20px;">
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_view',
        'summary'=>'', 
    ]) ?>
</div>
