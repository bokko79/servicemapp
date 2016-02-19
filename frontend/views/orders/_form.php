<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\web\Session;

/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
/* @var $form yii\widgets\ActiveForm */

?>
<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <fieldset class="settings" style="margin-bottom:10px !important;">
    <?php 
        
        if($service->location!=0): // DELIVERY TIME ?>
        <?= $this->render('parts/location.php', ['form'=>$form, 'service' => $service, 'model'=>$model,'location'=> $location, 'location_end'=> $location_end,]) ?>
    <?php endif; ?>
    <?php 
        
        if($service->time!=0): // DELIVERY TIME ?>
        <?= $this->render('parts/time.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'no'=>2-$no_location]) ?>
    <?php endif; ?>        
    <?php 
        
        if($service->frequency!=0): // FREQUENCY ?>
        <?= $this->render('parts/frequency.php', ['form'=>$form, 'model'=>$model, 'no'=>3-$no_location-$no_time]) ?>
    <?php endif; ?>
        <?= $this->render('parts/validity.php', ['form'=>$form, 'model'=>$model, 'no'=>4-$no_location-$no_time-$no_freq]) ?>
        <?= $this->render('parts/budget.php', ['form'=>$form, 'model'=>$model, 'no'=>5-$no_location-$no_time-$no_freq]) ?>
        <?= $this->render('parts/other.php', ['form'=>$form, 'model'=>$model, 'no'=>6-$no_location-$no_time-$no_freq]) ?>
    <?php if(Yii::$app->user->isGuest): ?>
        <?= $this->render('parts/uac.php', ['form'=>$form, 'model'=>$model, 'no'=>7-$no_location-$no_time-$no_freq]) ?>
    <?php endif; ?>

        <div class="float-right  col-md-3" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-cart"></i> Naruči'), ['class' => 'btn btn-success btn-lg', 'style'=>'width:100%']) ?>
        </div>
    </fieldset>

<?php ActiveForm::end(); ?>

