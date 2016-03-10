<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ProviderServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Portfolio usluga');
$this->params['breadcrumbs'][] = $this->title;
$this->params['user'] = $user;
$pageDescription = '<p style="font-size:12px; line-height:14px; margin:10px;">'.Yii::t('app', 'Lista uslužnih delatnosti kojima se bavite i usluga u okviru tih delatnosti koje pružate.').'</p>';
$this->pageTitle = [
    'background' => 'bg-blue-gray-900',
    'icon' => 'cogs',     
    'title' => Html::encode($this->title) . Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Dodaj nove delatnosti'), [''], ['class' => 'btn btn-warning float-right', 'id'=>'show-industries-modal-button', 'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#provider-industries']),
    'description' => $pageDescription,
    'h' => 2,
];
?>
<?php // echo $this->render('_search', ['model' => $searchModel]); ?>
<div class="">
<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => '_industryCard',
    'summary' => '',
    'options' => ['style'=>'overflow: hidden;'],
]) ?>
</div>

<?php Modal::begin([
        'id'=>'provider-industries',
        'size'=>Modal::SIZE_LARGE,
        'class'=>'overlay_modal',
        'header'=> '<h3>Izaberite uslužne delatnosti kojima se bavite</h3>',
        'options'=>['class'=>'fade','tabindex' => null,]
    ]); ?>
    <div id="loading"><i class="fa fa-spinner fa-pulse fa-3x"></i></div>
<?php Modal::end(); ?>