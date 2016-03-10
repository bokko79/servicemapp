<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

$countDown = \russ666\widgets\Countdown::widget([
    'datetime' => $model->validity,
    'format' => '%-D<span class=\"fs_11\">d</span> %H<span class=\"fs_11\">h</span> %M',
    'events' => [
        //'finish' => 'function(){location.reload()}',
    ],
]);
?>
<tr>        
    <td class="center">
        <div class="gray-color"><i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->activity->time, 'language'=>'en-short']); ?></div>   
        <div class="label label-primary fs_11"><i class="fa fa-building"></i> <?= $model->activity->type ?></div>             
        <div class="margin-top-5"><?= Html::a('#'.sprintf("%'07d\n", $model->id), Url::to('/order/'.$model->id), ['class'=>'']) ?></div>       
        
    </td>
    <td>
        <div class="margin-bottom-5 gray-color"><i class="fa fa-cogs"></i> Zemljani radovi</div>
        <?php foreach ($model->orderServices as $orderService): ?>            
            <div class=""><?= Html::a($orderService->service->name, Url::to('/order/'.$model->id), ['class'=>'fs_16']) ?></div>
        <?php endforeach; ?>
    </td>
    <td>
        <div><?= Yii::$app->formatter->asDateTime($model->delivery_starts, 'php:d.M @H:i') ?></div>
        <div><i class="fa fa-map-marker"></i> <?= $model->loc->city ?>, SRB</div>
    </td>
    <td class="center">
        <div><?= $model->activity->status ?></div>
        <div>još <?= $countDown ?></div>
    </td>
    <td class="">
        <div class="label label-default"><i class="fa fa-bookmark"></i> Aukcija</div>
        <div><?= $model->registered_to ?></div>                
    </td>
    <td class="center">
        <?= count($model->bids) ?>
    </td>
    <td class="center">                   
        <?= Html::a(Yii::t('app', '<i class="fa fa-pencil"></i>'), Url::to('/order-setup/'.$model->id), ['class'=>'btn btn-default btn-sm']); ?>
    </td>
</tr>
   