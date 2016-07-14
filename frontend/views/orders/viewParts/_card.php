<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;

/* items */
$industry = [
        'label'=>'<i class="fa fa-tag"></i> Izdavanje nekretnina: Veštine',
        'content'=>'<span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                            <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                            <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat.</p>',
    ];
$action = [
        'label'=>'<i class="fa fa-tag"></i> Izdavanje: Opcije',
        'content'=>'<span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                            <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                            <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat.</p>',
    ];
$object = [
        'label'=>'<i class="fa fa-cube"></i> Apartman: Karakteristike',
        'content'=>'<table class="table table-striped">
                    <tr>
                        <td>Površina</td>
                        <td>65 m<sup>2</sup></td>
                    </tr>
                    <tr>
                        <td>Broj soba</td>
                        <td>3</sup></td>
                    </tr>
                    <tr>
                        <td>Broj kupatila</td>
                        <td>1</td>
                    </tr>
                    </table>',
        'active'=>true,
    ];
$issue = [
        'label'=>'<i class="fa fa-tag"></i> Apartman: Problemi',
        'content'=>'<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat.</p>',
    ];
$additional = [
        'label'=>'<i class="fa fa-tag"></i> Ostali detalji',
        'content'=>'<span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                            <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                            <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>',
    ];
$items = [ $industry, $action, $object, $issue, $additional ];
?>
<div class="card_container record-full" id="" style="float:none;"> 
    <div class="secondary-context indexed">
        <div class="head major thin">Detalji porudžbine</div>
    </div>
    <?php /* service */ ?>
    <?php $orderServicesCount = count($model->orderServices); ?>
    <?php foreach ($model->orderServices as $key=>$orderService): ?>
    <div class="hidden-content-container hovering" id="service-details<?= $key ?>" style="position:relative;">
        <div class="header-context head">              
            <div class="avatar">
                <?= Html::img('@web/images/cards/'.$orderService->service->avatar) ?>          
            </div>
            <div class="title">
                <div class="head" style="font-weight:300;"><?= ($orderService->title) ? $orderService->title : $orderService->customTitle; ?></div>
                <div class="subhead">
                    <div class="label label-success fs_11 center margin-right-15" style="background:<?= $model->industry->color ?>; letter-spacing:1px; font-weight:400"><i class="fa <?= $model->industry->icon ?>"></i> <?= c($model->industry->tName) ?></div>
                    <?= Html::a($orderService->service->tName.' <i class="fa fa-external-link"></i>', Url::to('/s/'.slug($orderService->service->tName)), []) ?>
                    <?= ($orderService->amount) ? '<span class="margin-right-15"><i class="fa fa-signal fa-rotate-270 margin-right-5"></i>'.$orderService->amount.'</span>' : null ?>
                    <?= ($orderService->consumer) ? '<span class="margin-right-15"><i class="fa fa-user"></i> '.$orderService->consumer.'</span>' : null ?>
                </div>                                   
            </div>

            <?= Html::a('<i class="fa '.(($orderServicesCount>1) ? 'fa-chevron-right' : 'fa-chevron-down').'"></i>', null, ['class'=>'btn btn-link float-right show-more']); ?>

        </div>
        <div class="secondary-context avatar-padded <?= ($orderServicesCount>1) ? 'hidden' : '' ?> hidden-content fadeIn animated">
            <?= $orderService->note ?>                
        </div>
        <?php if($orderService->files): ?>
        <div class="media-area <?= ($orderServicesCount>1) ? 'hidden' : '' ?> hidden-content">
        <?php 
            $fotorama = \metalguardian\fotorama\Fotorama::begin(
                [
                    'options' => [
                        'loop' => true,
                        'hash' => true,
                        'allowfullscreen' => true,
                        'width' => '100%',
                        'minwidth' => '400',
                        'maxwidth' => '875',
                        'minheight' => '300',
                        'maxheight' => '100%',
                        'height' => '492',
                        'ratio' => 875/492,
                        'nav' => false,
                        //'fit' => 'cover',
                    ],
                    //'tagName' => 'span',
                    'useHtmlData' => false,
                    'htmlOptions' => [
                        'style'=>'',
                        'class'=>'card-width-cover'
                    ],
                ]
            ); 
            ?>
            <?php foreach ($orderService->files as $media): ?>
                <?= Html::img('@web/images/user_objects/'.$media->file->ime) ?>
            <?php endforeach; ?>
            <?php $fotorama->end(); ?>
        </div>
        <?php endif; ?> 
        <div class="secondary-context cont avatar-padded <?= ($orderServicesCount>1) ? 'hidden' : '' ?> hidden-content fadeIn animated">
            <?= TabsX::widget([
                'items' => $items,
                'position'=>TabsX::POS_ABOVE,
                'encodeLabels'=>false,
                'containerOptions' => ['class'=>'product-nav-tabs']
            ]) ?>                          
        </div>
        
        <hr class="no-margin">                 
    </div>
    <?php endforeach; ?>                                 
</div>