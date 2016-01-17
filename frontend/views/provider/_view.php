<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>          
<div class="card_container record-650 list-item color-border fadeInUp animated" id="card_container" style="float:none; border-left-color: purple;">
    <a href="<?= Url::to('/services') ?>">
        
        <table class="main-context"> 
            <tr>
                <td class="body-area">
                    <div class="primary-context">
                        <div class="head"><?= $model->user->fullname ?></div>
                        <div class="subhead"><?= $model->user->userDetails->loc->city ?></div>
                        <span class="label label-default">arhitekta</span>
                        <span class="label label-default">dizajner</span>
                        <span class="label label-primary">izdavanje nekretnina</span>
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
        <div class="action-area">
            <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
        </div>
    </a>
</div>