<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
/* @var $form yii\widgets\ActiveForm */
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\Session;
?>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>
    <fieldset class="settings" style="margin:30px 0 !important;">
    <?php if($service->serviceSkills): // SERVICE INDUSTRY SKILLS ?>
        <?= $this->render('parts/skills.php', ['form'=>$form, 'service'=>$service, 'model'=>$model, 'industry'=>$service->industry, 'model_skills' => $model_skills,]) ?>
    <?php endif; ?>
    <?php if($service->location!=0 or $service->shipping!=0): // LOCATION ?>
        <?= $this->render('parts/location.php', ['form'=>$form, 'service' => $service, 'model'=>$model,'location'=> $location, 'location_end'=> $location_end,]) ?>
    <?php endif; ?>
    <?php if($service->time!=0): // DELIVERY TIME ?>
        <?= $this->render('parts/time.php', ['form'=>$form, 'service' => $service, 'model'=>$model]) ?>
    <?php endif; ?> 
    <?php if($service->consumer!=0): // SERVICE CONSUMERS ?>
        <?= $this->render('parts/consumers.php', ['model'=>$model, 'form'=>$form, 'service'=>$service]) ?>
    <?php endif; ?>       
    <?php if($service->frequency!=0): // FREQUENCY ?>
        <?= $this->render('parts/frequency.php', ['form'=>$form, 'model'=>$model]) ?>
    <?php endif; ?>
        
        <?= $this->render('parts/budget.php', ['form'=>$form, 'model'=>$model]) ?>
        <?= $this->render('parts/validity.php', ['form'=>$form, 'model'=>$model]) ?>
        <?= $this->render('parts/other.php', ['form'=>$form, 'service' => $service, 'model'=>$model]) ?>
    <?php if(Yii::$app->user->isGuest): ?>
        <?= $this->render('parts/uac.php', ['form'=>$form, 'model'=>$model, 'new_user' => $new_user, 'returning_user' => $returning_user,]) ?>
    <?php endif; ?>

        <hr>
        <div class="float-right col-md-3" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-cart"></i> Naruči'), ['class' => 'btn btn-success btn-lg', 'style'=>'width:100%']) ?>
        </div>
    </fieldset>

<?php ActiveForm::end(); ?>

