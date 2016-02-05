<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use frontend\models\CsServices;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProviderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Provajderi');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="provider-index">
	<h1 class="padding-top-20 padding-bottom-20"><?= Html::encode($this->title) ?> <span class="float-right fs_12 bold">sort by <?= Html::dropDownList('sort', null, [
            'value1' => 'time ascending',
            'value2' => 'time descending',
        ], []) ?></span></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_card',
        'summary'=>'', 
    ]) ?>
</div>
