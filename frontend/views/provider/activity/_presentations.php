<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>
<tr>
    <td>
        <div><?= $model->providerService->service->name ?></div>
    </td>
    <td>
        <?= $model->price ?>
    </td>
    <td class="center">
        <div><?= $model->activity->status ?></div>
    </td>
    <td class="">
        <?= count($model->activity->orders) ?>              
    </td>
    <td class="center">
        <?= count($model->activity->comments) ?>
    </td>
    <td class="center">                   
        <?= Html::a(Yii::t('app', '<i class="fa fa-pencil"></i>'), Url::to('/order-setup/'.$model->id), ['class'=>'btn btn-default btn-sm margin-bottom-10']); ?>
    </td>
</tr>
   