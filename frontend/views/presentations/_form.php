<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
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
    //'enableAjaxValidation' => true,
    //'enableClientValidation' => true,
]); ?>
    <fieldset class="settings" style="margin:30px 0 !important;">    
    <?php // 1 SPECIFICATIONS
        if($service->serviceSpecs!=null or ($service->object->isPart() && $service->object->parent->specs)): ?>
	       <?= $this->render('parts/specifications.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_specs' => $model_specs, 'object_model'=>$object_model, 'user' => $user,]) ?>
    <?php endif; ?>
    <?php // 2 PICS ?>
            <?= $this->render('parts/pics.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'object_model'=>$object_model, 'user' => $user]) ?>
    <?php // 3 ISSUES 
        if($service->service_type==6 && ($service->object->issues or (count($object_model)==1 and $object_model[0]->issues))): ?>
            <?= $this->render('parts/issues.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'object_model'=>$object_model]) ?>
    <?php endif; ?>
    <?php // 4 METHODS
        if($service->serviceMethods): ?>
            <?= $this->render('parts/methods.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_methods'=>$model_methods]) ?>
    <?php endif; ?>
    <?php // 5 TITLE & DESC ?>
            <?= $this->render('parts/title.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'object_model'=>$object_model]) ?>
    <?php // 6 LOCATIONS 
        if($service->location!=0): ?>
            <?= $this->render('parts/locations.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'location'=> $location,]) ?>
    <?php endif; ?>
    <?php // 7 PRICE ?>        
            <?= $this->render('parts/price.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>    
    <?php // 8 AMOUNT 
        if($service->amount!=0 && $service->service_object!=1): ?>
            <?= $this->render('parts/amount.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
    <?php endif; ?>
    <?php // 9 CONSUMER 
        if($service->consumer!=0): ?>
            <?= $this->render('parts/consumer.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
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
            <?= $this->render('parts/terms.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
    <?php // 14 LOGIN/REGISTER 
        if(Yii::$app->user->isGuest): ?>
            <?= $this->render('parts/uac.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'new_provider' => $new_provider, 'returning_user' => $returning_user,]) ?>
    <?php endif; ?>
        <hr>
    <?php // 15 SUBMIT
        if(Yii::$app->controller->action->id!='update'): ?>
        <div class="float-right col-md-5" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-cart"></i> Napravi prezentaciju'), ['class' => 'btn btn-success shadow btn-lg form-presentation', 'style'=>'width:100%']) ?>
        </div>
    <?php endif; ?>
    </fieldset>
<?php ActiveForm::end(); ?>