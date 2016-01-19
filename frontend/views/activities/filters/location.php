<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
?>
      
<div class="card_container record-200 left-sidebar" id="card_container" style="float:none;">   
    <div class="header-context page-title side-widget">
        <h4><i class="fa fa-filter"></i> Filteri</h4>
    </div>     
    <div class="primary-context">
        <div class="subhead float-left"><i class="fa fa-map-marker"></i> Lokacija
            <?= Html::a('<i class="fa fa-chevron-down"></i>', null, ['class'=>'btn btn-link float-right show-more']); ?>
        </div>
        
    </div>
    <div class="secondary-context tease">
        <p>You have successfully created your Yii-powered application.</p>
    </div> 
    
    <div class="secondary-context cont hidden hidden-content fadeInDown animated">
        <?php $form = kartik\widgets\ActiveForm::begin([
            'id' => 'form-horizontal',
            'type' => ActiveForm::TYPE_INLINE,
        ]); ?>
        <?= $form->field($model, 'user_id')->textInput(['maxlength' => true]) ?>
        <?php ActiveForm::end(); ?>
    </div>   
</div>