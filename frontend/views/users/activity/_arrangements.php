<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

?>
<tr>        
    <td class="center">
        <div class="gray-color"><i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->activity->time, 'language'=>'en-short']); ?></div>
        <div class="margin-top-5"><?= Html::a('#'.sprintf("%'07d\n", $model->id), Url::to('/order/'.$model->id), ['class'=>'']); ?></div>
    </td>
    <td>

    </td>
    <td>
        
    </td>
    <td class="center">
        <div><?= $model->activity->status ?></div>
    </td>
    <td class="">
        <div class="label label-default"><i class="fa fa-bookmark"></i> Aukcija</div>               
    </td>
    <td class="center">
    </td>
    <td class="center">                   
        <?= Html::a(Yii::t('app', '<i class="fa fa-pencil"></i>'), Url::to('/order-setup/'.$model->id), ['class'=>'btn btn-default btn-sm margin-bottom-10']); ?>
    </td>
</tr>
   