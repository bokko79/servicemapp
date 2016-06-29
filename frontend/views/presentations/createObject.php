<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */

$this->title = Yii::t('app', 'Nova prezentacija');
$this->params['breadcrumbs'][] = $this->title;
$this->params['service'] = $service;
$this->params['object_model'] = $object_model;
$this->params['presentation'] = $model;
?>
<?= $this->render('_steps.php', ['model'=>$model]) ?>
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
    <?php // 1 SPECIFICATIONS AND OBJECT AVAILABILITY
        if($service->serviceObjectProperties!=null or ($service->object->isPart() && $service->object->parent->objectProperties)): ?>
	       <?= $this->render('parts/object_properties.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_object_properties' => $model_object_properties, 'object_model'=>$object_model, 'user' => $user]) ?>
    <?php endif; ?>
    <?php // 2 PICS, DOCS AND MEDIA ?>
            <?= $this->render('parts/pics.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'object_model'=>$object_model, 'user' => $user]) ?>
    <?php // 3 ISSUES WITH THE OBJECTS
        if($service->service_type==6 && ($service->object->issues or (count($object_model)==1 and $object_model[0]->issues))): ?>
            <?= $this->render('parts/issues.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'object_model'=>$object_model]) ?>
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
