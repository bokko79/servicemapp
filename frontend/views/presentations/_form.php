<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\Session;

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
]); ?>
    <fieldset class="settings" style="margin:30px 0 !important;">
    <?php // 1 METHODS
        if($service->serviceMethods): ?>
            <?= $this->render('parts/methods.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_methods'=>$model_methods]) ?>
    <?php endif; ?>
    <?php // 2 SPECIFICATIONS 
        if($service->serviceSpecs): ?>
	       <?= $this->render('parts/specifications.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_specs' => $model_specs, 'object_model'=>$object_model]) ?>
    <?php endif; ?>
    <?php // 3 PICS ?>
            <?= $this->render('parts/pics.php', ['form'=>$form, 'service' => $service, 'model'=>$model]) ?>
    <?php // 4 ISSUES 
        if($service->service_type==6 && $service->object->issues): ?>
            <?= $this->render('parts/issues.php', ['form'=>$form, 'service' => $service, 'model'=>$model]) ?>
    <?php endif; ?>
    <?php // 5 TITLE & DESC ?>
            <?= $this->render('parts/title.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'object_model'=>$object_model]) ?>
    <?php // 6 LOCATIONS 
        if($service->location!=0): ?>
            <?= $this->render('parts/locations.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'location'=> $location,]) ?>
    <?php endif; ?>
    <?php // 7 AMOUNT 
        if($service->amount!=0): ?>
            <?= $this->render('parts/amount.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
    <?php endif; ?>
    <?php // 8 CONSUMER 
        if($service->consumer!=0): ?>
            <?= $this->render('parts/consumer.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
    <?php endif; ?>
    <?php // 9 PRICE 
        if($service->pricing!=0): ?>
            <?= $this->render('parts/price.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
    <?php endif; ?>
    <?php // 10 AVAILABILITY 
        if($service->availability!=0): ?>
            <?= $this->render('parts/availability.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
    <?php endif; ?>
    <?php // 11 OTHER ?>
            <?= $this->render('parts/other.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
    <?php // 12 NOTIFICATIONS ?>
            <?= $this->render('parts/notifications.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
    <?php // 13 TERMS ?>

    <?php // 14 LOGIN/REGISTER 
        if(Yii::$app->user->isGuest): ?>
            <?= $this->render('parts/uac.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'new_provider' => $new_provider, 'returning_user' => $returning_user,]) ?>
    <?php endif; ?>
        <hr>
        <div class="float-right col-md-5" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-cart"></i> Napravi prezentaciju'), ['class' => 'btn btn-success btn-lg', 'style'=>'width:100%']) ?>
        </div>
    </fieldset>
<?php ActiveForm::end(); ?>