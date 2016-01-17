<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserPaymentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<h5 class="search-index" style="margin: 20px 10px 0; cursor: pointer"><i class="fa fa-search"></i> <?= Yii::t('app', 'Search') ?> <i class="fa fa-caret-down"></i></h5>
<div class="user-objects-search fadeInDown animated" style="margin: 20px 10px; display:none;">    
     
    <?php $form = ActiveForm::begin([
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE
    ]); ?>

    <?= $form->field($model, 'payment_type', [
                    'options' =>['style'=>''],
                    'addon' => [
                        'append' => [
                            'content' => Html::submitButton('Go', ['class'=>'btn btn-primary']), 
                            'asButton' => true
                        ]
                    ],
                ])->dropDownList([
                    'MasterCard' => 'MasterCard', 
                    'Visa' => 'Visa', 
                    'AmericanExpress' => 'AmericanExpress', 
                    'PayPal' => 'PayPal'
                    ]) ?>
    

    <?php ActiveForm::end(); ?>
</div>
