<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\tabs\TabsX;

/**
 * ProductHead displays a card on the left sidebar.
 *
 * To use ProductHead, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo ProductHead::widget([
 *     'cardPic' => $this->cardPic, // ProductHead Picture
 *     'cardIcon'=>$this->cardIcon, // ProductHead Icon
 *     'cardSub'=>$this->cardSub, // ProductHead SubTitle
 *     'cardTitle'=>$this->cardTitle, // ProductHead Title
 *     
 * ]);
 * ~~~
 *
 * @author Bojan Grozdanic <bojan.grozdanic@gmail.com>
 * @since 2.0
 */
class ProductHead extends Widget
{
    public $productData = [];

    /**
     * Renders the widget
     */
    public function run()
    { ?>

        <div class="card_container record-full" id="card_container" style="float:none;"> 
            <?php /* creator and product details */ ?>                   
            <div class="header-context gray">                
                <div class="avatar">
                    <?= Html::img('@web/images/cards/default_avatar.jpg') ?>    
                </div>
                <div class="title">
                    <div class="head second"><?= $this->productData['creator']['name'] ?></div>
                    <div class="subhead"><?= $this->productData['creator']['location'] ?></div> 
                </div>
                <div class="subaction right">                        
                    <i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?>
                </div>
                
            </div>           
            <hr class="no-margin">
            <div class="header-context">
                <div class="avatar center gray-color">
                    <i class="fa fa-shopping-cart fa-3x"></i>        
                </div>
                <div class="title">
                    <div class="head second gray-color">Porudžbina br. #<?= sprintf("%'09d\n", $this->productData['activity']['id']) ?></div>
                    <span class="label label-primary margin-right-10"><i class="fa fa-bookmark"></i> <?= $this->productData['activity']['type'] ?></span> 
                        
                </div> 
                <div class="right fs_30">                        
                    <i class="fa fa-refresh fa-spin"></i> 
                    <?= \russ666\widgets\Countdown::widget([
                            'datetime' => $this->productData['activity']['validity'],
                            'format' => '%d<span class=\"fs_11\">d</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> %S<span class=\"fs_11\">s</span>',
                            'events' => [
                                //'finish' => 'function(){location.reload()}',
                            ],
                        ]) ?>
                        <?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger btn-xs no-margin']); ?>
                </div>                
            </div>           
            <hr class="no-margin">
            <?php /* service */ ?>
            <?php $productCount = count($this->productData['product']); ?>
            <?php foreach ($this->productData['product'] as $product): ?>
            <div class="hidden-content-container hovering" style="position:relative;">
                <div class="header-context head">              
                    <div class="avatar">
                        <?= Html::img('@web/images/cards/'.$product['avatar'].'.jpg') ?>          
                    </div>
                    <div class="title">
                        <div class="head" style="color:#2196F3; font-weight:300;"><?= $product['head'] ?><span class="margin-left-10 fs_11"><?= Html::a('<i class="fa fa-external-link"></i>', Url::to(''), []) ?></span></div>
                        <div class="subhead">
                            <div class="label label-success fs_11 margin-right-15"><i class="fa fa-building"></i> Izdavanje nekretnina</div>
                            <?= ($product['qty']) ? '<span class="margin-right-15"><i class="fa fa-signal fa-rotate-270 margin-right-5"></i>'.$product['qty'].'</span>' : null ?>
                            <?= ($product['consumer']) ? '<span class="margin-right-15"><i class="fa fa-user"></i> '.$product['consumer'].'</span>' : null ?>
                        </div>                                   
                    </div>

                    <?= Html::a('<i class="fa '.(($productCount>1) ? 'fa-chevron-right' : 'fa-chevron-down').'"></i>', null, ['class'=>'btn btn-link float-right show-more']); ?>

                </div>
                <div class="secondary-context avatar-padded <?= ($productCount>1) ? 'hidden' : '' ?> hidden-content fadeIn animated">
                    <?= ($product['note']) ? '<p><b><i class="fa fa-sticky-note"></i> Note:</b> '.$product['note'].'</p>' : null ?>                
                </div>
                <div class="secondary-context cont avatar-padded <?= ($productCount>1) ? 'hidden' : '' ?> hidden-content fadeIn animated">
                    <?= TabsX::widget([
                        'items' => $product['details'],
                        'position'=>TabsX::POS_ABOVE,
                        'encodeLabels'=>false,
                        'containerOptions' => ['class'=>'product-nav-tabs']
                    ]) ?>                          
                </div>
                <?php if($product['media']): ?>
                <div class="media-area <?= ($productCount>1) ? 'hidden' : '' ?> hidden-content">
                    <?php foreach ($product['media'] as $media): ?>
                        <?= Html::img('@web/images/cards/'.$media.'.jpg') ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?> 
                <hr class="no-margin">                 
            </div>
            <?php endforeach; ?>

            
                      
            <?php /* time/loc */ ?>
                <div class="header-context">  
                    <div class="avatar center gray-color">
                        <i class="fa fa-calendar fa-3x"></i>    
                    </div>
                    <div class="title">
                        <div class="subhead"><?= Yii::t('app', 'vreme') ?></div> 
                        <div class="head second"><?= $this->productData['activity']['time'] ?></div>                           
                    </div>
                </div>
            <?php /* time/loc */ ?>
            <div class="hidden-content-container">
                <div class="header-context">                    
                    <div class="avatar center gray-color">
                        <i class="fa fa-map-marker fa-3x"></i>    
                    </div>
                    <div class="title">
                        <div class="subhead"><?= Yii::t('app', 'delivery location') ?></div> 
                        <div class="head second"><?= $this->productData['activity']['location'] ?></div>                           
                    </div>
                    <?= Html::a('<i class="fa fa-chevron-right"></i>', null, ['class'=>'btn btn-link float-right show-more', 'id'=>'mapShowTrigger']); ?>
                </div>
                <div class="media-screen hidden hidden-content no-margin" id="map_container">                   
                    <?= $this->productData['maps'] ?>
                </div>
            </div>
            

        
             <?php /* price/action */ ?>
            <div class="secondary-context" style="height:84px;">
                <div class="float-left" style="">
                    <div class="avatar center gray-color">
                        <i class="fa fa-barcode fa-3x"></i>    
                    </div>
                    <div class="title">
                        <div class="subhead"><?= Yii::t('app', 'cena') ?></div> 
                        <div class="head black no-padding"><?= Yii::$app->formatter->asCurrency(12750, 'EUR') ?></div>
                        <span class="strikethrough"><?= Yii::$app->formatter->asCurrency(13499.99, 'EUR') ?></span> <span class="label label-warning">popust 25%</span>
                    </div>
                </div>
                <div class="float-right action-area no-margin no-padding" style="">
                    <div class="head second padding-bottom-5 right gray-color">
                        <?= \russ666\widgets\Countdown::widget([
                            'datetime' => $this->productData['activity']['validity'],
                            'format' => '%d<span class=\"fs_11\">'.Yii::t('app', 'd').'</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> %S<span class=\"fs_11\">s</span>',
                            'events' => [
                                //'finish' => 'function(){location.reload()}',
                            ],
                        ]) ?>
                    </div>
                    <?= Html::a('<i class="fa fa-eye"></i>&nbsp;'.Yii::t('app', 'Prati'), Url::to(), ['class'=>'btn btn-link']); ?>
                    <?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger no-margin']); ?>
                            
                </div>                     
            </div>                                                             
        </div>
        <?php
    }
}
