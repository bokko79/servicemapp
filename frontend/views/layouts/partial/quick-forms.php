<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\ActiveForm;
//use kartik\widgets\DepDrop;
use kartik\widgets\Select2;?>
<div id="quick-form-makers" style="margin:20px 0;">
    <div class="btn-group btn-group-sm btn-group-justified" role="group" aria-label="...">
        <?= Html::a('<i class="fa fa-shopping-basket"></i>&nbsp;Naruči uslugu', null, ['class'=>'btn btn-info control order-service']); ?>
        <?= Html::a('<i class="fa fa-flag-o"></i>&nbsp;Promoviši uslugu', null, ['class'=>'btn btn-info control promote-service']); ?>
        <?= Html::a('<i class="fa fa-bullhorn"></i>&nbsp;Najavi događaj', null, ['class'=>'btn btn-info control announce-event']); ?>
    </div> 
    <div class="card_container record-650 grid-item fadeInDown animated order-service-process" id="card_container" style="float:none;">
    <?php
        $form = kartik\widgets\ActiveForm::begin(
        [
            'id' => 'signup-form',
        ]); ?>
            <div class="primary-context small-margin">
                <div class="head lower">Brzo naručivanje usluga</div>
            </div>
            <div class="secondary-context cont">
                <p><i class="fa fa-lightbulb-o"></i>&nbsp;Birajte delatnost, zatim aktivnost i na kraju predmet usluge i naručite uslugu. 
                            Npr.: Treba mi... <b>arhitekta</b> za <b>projektovanje kuće</b></p>
            </div>
            <div class="secondary-context cont">
                <?php /* echo $form->field(new \frontend\models\CsServices, 'industry_id', ['addon' => ['prepend' => ['content'=>'<b>Treba mi...</b>']]])->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(\frontend\models\CsIndustries::find()->asArray()->all(), 'id', 'name'),
                    'id' => 'cat-id',
                    /*'options' => [
                        'ajax' => [
                            'type'=>'GET', //request type
                            'url'=>Url::to(['/auto/list-industries']), //action to call
                            'update'=>'#action_id', // which HTML element to update
                            'complete'=>'function(data){}',
                        ],
                    ],                   
                ]); */ ?>

                <?php echo Select2::widget([
    'name' => 'state_10',
    'data' => ArrayHelper::map(\frontend\models\CsIndustries::find()->all(), 'id', 'name'),
    'options' => [
        'placeholder' => 'Select provinces ...',
    ],
    'pluginOptions' => [
        'ajax' => [
                            'url'=>Url::to(['/auto/list-industries']), //action to call
                            'complete'=>'function(data){}',
                        ],
    ],
]); ?>

                <?php /* echo $form->field(new \frontend\models\CsServices, 'action_id', ['addon' => ['prepend' => ['content'=>'<b>...za...</b>']]])->widget(DepDrop::classname(), [
                    'type'=>DepDrop::TYPE_SELECT2,
                    'options'=>['id'=>'action_id', 'placeholder'=>'Select ...'],
                    'select2Options'=>['pluginOptions'=>['allowClear'=>true]],
                    'pluginOptions'=>[
                        'depends'=>['cat-id'],
                        'url'=>Url::to(['/auto/list-industries']),
                    ]
                ]); */ ?>
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