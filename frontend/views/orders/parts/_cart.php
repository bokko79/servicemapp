<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;

$service = frontend\models\CsServices::findOne($order_service['service']);
?>          
<div class="card_container record-full list-item fadeIn animated" id="card_container" style="float:none;">   
    <table class="main-context"> 
        <tr>
            <td class="media-area left">
                <div >                
                    <div class="image">
                        <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>
                    </div>
                </div> 
            </td>
            <td class="body-area">
                <div class="primary-context">
                    <div class="head"><?= c($service->tName) ?>
                        <div class="action-area free">
                            <?= Html::a('<i class="fa fa-wrench"></i>', Url::to(), ['class'=>'btn btn-default']); ?>
                            <?= Html::a('<i class="fa fa-times"></i>', Url::to(), ['class'=>'btn btn-danger']); ?>
                        </div>
                    </div>
                    <div class="subhead"><?= $service->industry->name ?></div>
                </div>
                <div class="secondary-context cont">
                    <span><i class="fa fa-globe"></i>&nbsp;<?= $order_service['amount'] ?></span>
                    <span>&nbsp;<i class="fa fa-users"></i>&nbsp;<?= $order_service['consumer'] ?></span>
                    <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;<?= $order_service['consumer_children'] ?></span>
                    <p><?= $order_service['note'] ?></p>
                </div>
            </td>
            
        </tr>                        
    </table>
</div>