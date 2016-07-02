<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use common\models\Objects;
use yii\helpers\Url;
?>
      
<div class="card_container record-650 list-item" id="card_container" style="float:none;">
    <a href="<?= Url::to('/object-setup/'.$model->id) ?>">
        
        <table class="main-context"> 
            <tr>
                <td class="body-area">
                    <div class="primary-context" style="">
                        <div class="head">
                            <?= $model->object->name ?><?= ($model->ime) ? ': '.$model->ime : null ?>
                            <div class="action-area">
                                <?= Html::a('<i class="fa fa-pencil"></i>', Url::to('/object-setup/'.$model->id), ['class'=>'btn btn-default']); ?>
                                <?= Html::a('<i class="fa fa-times"></i>', Url::to(), ['class'=>'btn btn-danger']); ?>
                            </div>
                        </div>
                        <div class="subhead"><?= $model->objectType->name ?></div>                        
                    </div>
                    <div class="secondary-context cont">
                        <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                        <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                        <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                            ex ea commodo consequat.</p>
                    </div>
                </td>
                <td class="media-area">
                    <div >                
                        <div class="image">
                            <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>
                        </div>
                    </div> 
                </td>
            </tr>                        
        </table>        
    </a>
</div>