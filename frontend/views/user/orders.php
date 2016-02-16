<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use yii\grid\GridView;

$this->title = 'Porudžbine';
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => [$model->username.'/home']];
$this->params['breadcrumbs'][] = ['label' => 'Vaše poslovanje', 'url' => [$model->username.'/orders']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="title_holder_home">
   <h2 style="padding: 20px 20px 10px 50px;"><?= Html::encode($this->title) ?></h2>
</div>
<div class="card_container record-full list-item margin-bottom-20" style="float:none; background:#F6F7F8;">
    <?= $this->render('_search_orders.php', ['model'=>$searchModel]) ?>
    <table class="indexed table table-striped table-hover">
        <tr class="table-header">        
            <td class="center id-column"><i class="fa fa-shopping-cart fa-lg"></i></td>
            <td class="detail-column">Detalji porudžbine</td>
            <td class="subdetail-column">Start</td>
            <td>Status</td>
            <td>Tip porudžbine</td>
            <td>Ponude</td>
            <td class="center action-column">Akcija</td>
        </tr>
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => 'activity/_orders',
            'options' => [
                'class' => 'index-sorter float-right padding-right-20',
            ],
            'summary' => false,
            'layout' => "{sorter}\n{summary}\n{items}\n{pager}", // Add sorter to layout because it's turned off by default
            'sorter' => [
                'class' => \frontend\widgets\IndexSorter::className(),
                'attributes' => ['time_asc', 'time_desc'],
            ],
        ]) ?> 
    </table>
</div>