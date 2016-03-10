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
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>
    <fieldset class="settings" style="margin:30px 0 !important;">
        <?php // 1 METHODS ?>
        <?= $this->render('parts/methods.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_methods'=>$model_methods]) ?>
        <?php // 2 SPECIFICATIONS ?>
    	<?= $this->render('parts/specifications.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_specs'=>$model_specs, 'model_spec_models'=>$model_spec_models, 'object_model'=>$object_model]) ?>
        <?php // 3 PICS ?>
        <?= $this->render('parts/pics.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_images'=>$model_images]) ?>
        <?php // 4 ISSUES ?>
        <?= $this->render('parts/issues.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_issues'=>$model_issues]) ?>
        <?php // 5 TITLE & DESC ?>
        <?= $this->render('parts/title.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'object_model'=>$object_model]) ?>
        <?php // 6 LOCATIONS ?>
        <?= $this->render('parts/locations.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'model_locations'=>$model_locations]) ?>
        <?php // 7 AMOUNT ?>
        <?= $this->render('parts/amount.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
        <?php // 8 CONSUMER ?>
        <?= $this->render('parts/consumer.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
        <?php // 9 PRICE ?>
        <?= $this->render('parts/price.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
        <?php // 10 AVAILABILITY ?>
        <?= $this->render('parts/availability.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
        <?php // 11 OTHER ?>
        <?= $this->render('parts/other.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
        <?php // 12 NOTIFICATIONS ?>
        <?= $this->render('parts/notifications.php', ['form'=>$form, 'service' => $service, 'model'=>$model,]) ?>
        <?php // 13 TERMS ?>

        <hr>
        <div class="float-right col-md-5" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-cart"></i> Napravi prezentaciju'), ['class' => 'btn btn-success btn-lg', 'style'=>'width:100%']) ?>
        </div>
    </fieldset>

<?php ActiveForm::end(); ?>