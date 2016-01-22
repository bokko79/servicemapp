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

        <div class="card_container record-full fadeInUp animated" id="card_container" style="float:none;"> 
            <?php /* creator and product details */ ?>                   
            <div class="header-context gray">
                <div class="">
                    <div class="avatar">
                        <?= Html::img('@web/images/cards/default_avatar.jpg') ?>    
                    </div>
                    <div class="title">
                        <div class="head second"><?= $this->productData['creator']['name'] ?></div>
                        <div class="subhead"><?= $this->productData['creator']['location'] ?></div> 
                    </div>
                </div>
                <div class="">
                    <div class="avatar">
                                  
                    </div>
                    <div class="title">
                        <div class="head second">Service order no. <?= $this->productData['activity']['id'] ?></div>
                        <div class="label label-primary"><i class="fa fa-bookmark"></i> <?= $this->productData['activity']['type'] ?></div> 
                    </div>
                    <div class="right">
                        <span class="fs_11"><i class="fa fa-hourglass-3"></i>&nbsp;AKTIVNO JOŠ: </span>
                        <div class="head major">
                            
                            <?= \russ666\widgets\Countdown::widget([
                            'datetime' => $this->productData['activity']['validity'],
                            'format' => '%d<span class=\"fs_11\">'.Yii::t('app', 'dana').'</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> %S<span class=\"fs_11\">s</span>',
                            'events' => [
                                //'finish' => 'function(){location.reload()}',
                            ],
                        ]) ?>
                        </div>
                    </div>
                </div>
            </div>           
            
            <?php /* service */ ?>
            <?php foreach ($this->productData['product'] as $product): ?>
            <div class="hidden-content-container hovering" style="position:relative;">
                <div class="header-context head">              
                    <div class="avatar">
                        <?= Html::img('@web/images/cards/'.$product['avatar'].'.jpg') ?>          
                    </div>
                    <div class="title">

                        <div class="head"><?= $product['head'] ?></div>
                        <div class="subhead">
                            <div class="label label-success fs_11 margin-right-15"><i class="fa fa-building"></i> Izdavanje nekretnina</div>
                            <?= ($product['qty']) ? '<span class="margin-right-15"><i class="fa fa-signal fa-rotate-90 "></i>'.$product['qty'].'</span>' : null ?>
                            <?= ($product['consumer']) ? '<span class="margin-right-15"><i class="fa fa-user"></i> '.$product['consumer'].'</span>' : null ?>
                        </div>                                   
                    </div>

                    <?= Html::a('<i class="fa fa-chevron-up"></i>', null, ['class'=>'btn btn-link float-right show-more']); ?>

                </div>
                <div class="secondary-context avatar-padded hidden hidden-content fadeInDown animated">
                    <?= ($product['note']) ? '<p><b><i class="fa fa-sticky-note"></i> Note:</b> '.$product['note'].'</p>' : null ?>                
                </div>
                <div class="secondary-context cont avatar-padded hidden hidden-content fadeInDown animated">
                    <?= TabsX::widget([
                        'items' => $product['details'],
                        'position'=>TabsX::POS_ABOVE,
                        'encodeLabels'=>false,
                        'containerOptions' => ['class'=>'product-nav-tabs']
                    ]) ?>                          
                </div>
                <?php if($product['media']): ?>
                <div class="media-area hidden hidden-content">
                    <?php foreach ($product['media'] as $media): ?>
                        <?= Html::img('@web/images/cards/'.$media.'.jpg') ?>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?> 
                <hr class="no-margin">           
                 
            </div>
            <?php endforeach; ?>

            
                      
            <?php /* time/loc */ ?>
            <div class="hidden-content-container">
                <div class="header-context">  
                    <div class="float-left" style="width:50%; border-right:1px solid #ddd;">
                        <div class="avatar right">
                            <i class="fa fa-calendar fa-2x"></i>    
                        </div>
                        <div class="title">
                            <div class="subhead"><?= Yii::t('app', 'vreme') ?></div> 
                            <div class="head second"><?= $this->productData['activity']['time'] ?></div>                           
                        </div>
                    </div>

                    <div class="float-left">
                        <div class="avatar right">
                            <i class="fa fa-map-marker fa-2x"></i>    
                        </div>
                        <div class="title">
                            <div class="subhead"><?= Yii::t('app', 'delivery location') ?></div> 
                            <div class="head second"><?= $this->productData['activity']['location'] ?></div>                           
                        </div>
                        <?= Html::a('<i class="fa fa-chevron-down"></i>', null, ['class'=>'btn btn-link float-right show-more', 'id'=>'mapShowTrigger']); ?>
                    </div>                
                    
                </div>
                <div class="media-screen hidden hidden-content no-margin" id="map_container">                   
                    <?= $this->productData['maps'] ?>
                </div>
            </div>
            

        
             <?php /* price/action */ ?>
            <div class="action-area avatar-padded gray" style="height: 62px;"> 
                <table>
                    <tr>
                        <td>
                            <div class="head padding-bottom-5">299.99 EUR</div>
                            <span class="strikethrough">349.99 EUR</span> <span class="label label-warning">popust 25%</span>
                        </td>
                        <td>
                             
                        </td>
                        <td class="right">
                            <?= Html::a('<i class="fa fa-eye"></i>&nbsp;'.Yii::t('app', 'Prati'), Url::to(), ['class'=>'btn btn-link']); ?>
                            <?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger']); ?>
                            
                        </td>
                    </tr>
                </table>                            
            </div>
                                                              
        </div>
        <?php
    }
}
