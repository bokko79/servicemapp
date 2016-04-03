<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */
/* @var $form yii\widgets\ActiveForm */

?>
<div class="presentations-search" style="margin-top:10px; margin-bottom:30px;">
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal-presentation-search',
    'action' => ['index'],
    'method' => 'get',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    //'enableAjaxValidation' => true,
    //'enableClientValidation' => true,
]); ?>
    <fieldset class="settings" style="margin:30px 0 !important;">
    <?= $this->render('searchParts/title.php', ['form'=>$form, 'model'=>$model, 'service'=>$service]) ?>
    <div class="form-group margin-bottom-20">
        <div class="col-sm-offset-2">
        <?= Html::a(Yii::t('app', '<i class="fa fa-sliders"></i> Detaljna pretraga'), null, ['class' => 'btn btn-default more-filters']) ?>
        </div>        
    </div>
    <div class="more-filters-plaza animated fadeIn" style="display:none; margin:20px 0">
    <?= $this->render('searchParts/budget.php', ['form'=>$form, 'model'=>$model, 'service'=>$service]) ?>
    <?= $this->render('searchParts/location.php', ['form'=>$form, 'model'=>$model, 'service'=>$service, 'location' => $location,]) ?>
    <?php if($service): ?>
        <?php if($service->amount!=0): ?>
        <?= $this->render('searchParts/quantity.php', ['form'=>$form, 'model'=>$model, 'service'=>$service]) ?>
        <?php endif; ?>
        <?php if($service->consumer!=0): ?>
        <?= $this->render('searchParts/consumers.php', ['form'=>$form, 'model'=>$model, 'service'=>$service]) ?>
        <?php endif; ?>        
        <?php if($service->object->models): ?>
        <?= $this->render('searchParts/object_models.php', ['form'=>$form, 'model'=>$model, 'service'=>$service]) ?>
        <?php endif; ?>
        
        <?= $this->render('searchParts/specifications.php', ['form'=>$form, 'model'=>$model, 'service'=>$service, 'model_specs'=>$model_specs]) ?>
        <?php if($service->service_type==6 and $service->object->issues): ?>
        <?= $this->render('searchParts/issues.php', ['form'=>$form, 'model'=>$model, 'service'=>$service]) ?>
        <?php endif; ?>
        <?= $this->render('searchParts/methods.php', ['form'=>$form, 'model'=>$model, 'service'=>$service, 'model_methods' => $model_methods,]) ?>            
        <?= yii\helpers\Html::activeHiddenInput($model, 'service_id', ['value'=>($service) ? $service->id : null]) ?>    
        <?= $this->render('searchParts/timetable.php', ['form'=>$form, 'model'=>$model, 'service'=>$service]) ?>
    <?php endif; ?>  
    </div>
    <div class="form-group margin-top-20">
        <div class="col-sm-offset-2">
        <?= Html::submitButton(Yii::t('app', '<i class="fa fa-search"></i> Traži'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', '<i class="fa fa-stop-circle"></i> Resetuj filtere'), ['class' => 'btn btn-default']) ?>
        <?= Html::button(Yii::t('app', '<i class="fa fa-undo"></i> Poništi sve filtere'), ['class' => 'btn btn-default', 'name'=>'clear', 'onclick'=>'clearForm(this.form);']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>
    </fieldset>
</div>
