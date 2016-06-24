<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal-presentation',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
    //'enableAjaxValidation' => true,
    //'enableClientValidation' => true,
]); ?>
    <fieldset class="settings" style="margin:30px 0 !important;">    

    <?php // 4 METHODS AND DURATION
        if($service->serviceActionProperties): ?>
            <?= $this->render('parts/action_properties.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_action_properties'=>$model_action_properties, 'user' => $user]) ?>
    <?php endif; ?>

    <?php // 8 QUANTITIES 
        if($service->amount!=0 or $service->object_ownership!='provider'): ?>
            <?= $this->render('parts/quantity.php', ['form'=>$form, 'service' => $service, 'model'=>$model]) ?>
    <?php endif; ?>
    <?php // 9 CONSUMER 
        if($service->consumer!=0): ?>
            <?= $this->render('parts/consumer.php', ['form'=>$form, 'service' => $service, 'model'=>$model]) ?>
    <?php endif; ?> 

        <hr>
    <?php // 16 SUBMIT
        if(Yii::$app->controller->action->id!='update'): ?>
        <div class="float-right col-md-5" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-cart"></i> Napravi prezentaciju'), ['class' => 'btn btn-success shadow btn-lg form-presentation', 'style'=>'width:100%']) ?>
        </div>
    <?php endif; ?>
    </fieldset>
<?php ActiveForm::end(); ?>

