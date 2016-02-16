<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>
<tr>        
    <td class="center">
        <div class="gray-color"><i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->order->activity->time, 'language'=>'en-short']); ?></div>   
        <div class="label label-primary fs_11"><i class="fa fa-building"></i> <?= $model->order->activity->type ?></div>             
        <div class="margin-top-5"><?= Html::a('#'.sprintf("%'07d\n", $model->order_id), Url::to('/order/'.$model->order_id), ['class'=>'']) ?></div>       
        
    </td>
    <td>
        <div class="margin-bottom-5 gray-color"><i class="fa fa-cogs"></i> Zemljani radovi</div>
        <?php foreach ($model->order->orderServices as $orderService): ?>            
            <div class=""><?= Html::a($orderService->service->name, Url::to('/order/'.$model->id), ['class'=>'fs_16']) ?></div>
        <?php endforeach; ?>
    </td>
    <td>
        <?= $model->order->activity->user->username ?>
    </td>
    <td class="">
        <div class="label label-default"><i class="fa fa-bookmark"></i> Aukcija</div>
        <div><?= $model->order->registered_to ?></div>                
    </td>
    <td class="center">
        <div><?= $model->order->activity->status ?></div>
    </td>    
    <td class="center">
        <?= count($model->order->bids) ?>
    </td>
    <td class="center">
        <div class="gray-color"><i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->activity->time, 'language'=>'en-short']); ?></div>   
        <div class="label label-primary fs_11"><i class="fa fa-building"></i> <?= $model->activity->type ?></div>             
        <div class="margin-top-5"><?= Html::a('#'.sprintf("%'07d\n", $model->id), Url::to('/bid/'.$model->id), ['class'=>'']) ?></div>       
        
    </td>
    <td>
        <div><?= $model->price ?></div>        
        <div><?= $model->period ?></div>
        <div><?= Yii::$app->formatter->asDateTime($model->delivery_starts, 'php:d.M @H:i') ?></div>
    </td>
    
    <td class="center">                   
        <?= Html::a(Yii::t('app', '<i class="fa fa-pencil"></i>'), Url::to('/bid-setup/'.$model->id), ['class'=>'btn btn-default btn-sm']); ?>
    </td>
</tr>
   