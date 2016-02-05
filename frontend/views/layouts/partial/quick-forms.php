<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use kartik\widgets\Select2;?>
<div id="quick-form-makers" style="margin:20px 0;">
    <div class="btn-group btn-group-sm " role="group" aria-label="...">
        <?= Html::a('<i class="fa fa-shopping-basket"></i>&nbsp;Naruči uslugu', null, ['class'=>'btn btn-info control order-service']); ?>
        <?= Html::a('<i class="fa fa-flag-o"></i>&nbsp;Promoviši uslugu', null, ['class'=>'btn btn-info control promote-service']); ?>
        <?= Html::a('<i class="fa fa-bullhorn"></i>&nbsp;Najavi događaj', null, ['class'=>'btn btn-info control announce-event']); ?>
    </div> 
    <div class="card_container record-650 grid-item fadeIn animated order-service-process" id="card_container" style="float:none;">
    <?php
        $form = kartik\widgets\ActiveForm::begin(
        [
            'id' => 'signup-form',
            'action' => Url::to('market'),
        ]); ?>
            <div class="primary-context small-margin">
                <div class="head lower">Brzo naručivanje usluga</div>
            </div>
            <div class="secondary-context cont">
                <p><i class="fa fa-lightbulb-o"></i>&nbsp;Birajte delatnost, zatim aktivnost i na kraju predmet usluge i naručite uslugu. 
                            Npr.: Treba mi... <b>arhitekta</b> za <b>projektovanje kuće</b></p>
            </div>
            <div class="secondary-context cont">
                
                <?= $form->field(new \frontend\models\CsServices, 'industry_id')->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(\frontend\models\CsIndustries::find()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Izaberi delatnost ...', 'id'=>'ind_id'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]) ?>

                <?= $form->field(new \frontend\models\CsServices, 'action_id')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'act_id'],
                    'pluginOptions'=>[
                        'depends'=>['ind_id'],
                        'placeholder'=>'Izaberi akciju...',
                        'url'=>Url::to(['/glob-nav-act-services'])
                    ],
                ]) ?>
                <?= $form->field(new \frontend\models\CsServices, 'object_id')->widget(DepDrop::classname(), [
                    'options'=>['id'=>'obj_id'],
                    'pluginOptions'=>[
                        'depends'=>['act_id'],
                        'placeholder'=>'Izaberi predmet...',
                        'url'=>Url::to(['/glob-nav-ser-objects'])
                    ],
                ]) ?>
                
            </div>
            <div class="action-area right gray">
                <?= Html::submitButton('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), ['class'=>'btn btn-info']); ?>
            </div>
    <?php kartik\widgets\ActiveForm::end(); ?>        
    </div>    

    <div class="promote_service_process">
        

    </div>

    <div class="provide_service_process">
        
        
    </div>
</div>