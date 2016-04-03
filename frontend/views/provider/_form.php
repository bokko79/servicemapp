<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\web\Session;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserObjects */
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
    <?php // 1 GENERAL PROVIDER DETAILS: username, email, password, fullname ?>
        <?= $this->render('formParts/basic.php', ['form'=>$form, 'model'=>$model, 'provider' => $provider]) ?>
    <?php // 2 AVATAR/COVER ?>
        <?= $this->render('formParts/avatar.php', ['form'=>$form, 'model'=>$model, 'details' => $details]) ?>
    <?php // 3 PORTFOLIO ?>
        <?= $this->render('formParts/portfolio.php', ['form'=>$form, 'model'=>$model, 'portfolio' => $portfolio]) ?>
    <?php // 4 PORTFOLIO IMAGES: pics, docs, youtube ?>
        <?= $this->render('formParts/media.php', ['form'=>$form, 'model'=>$model, 'portfolio_images' => $portfolio_images]) ?>
    <?php // 5 LOCATION ?>
        <?= $this->render('formParts/location.php', ['form'=>$form, 'model'=>$model, 'locationHQ' => $locationHQ]) ?>
    <?php // 5 PUBLICATIONS ?>
        <?= $this->render('formParts/publications.php', ['form'=>$form, 'model'=>$model, 'publication' => $publication]) ?>
    <?php // 5 EDUCATION ?>
        <?= $this->render('formParts/educations.php', ['form'=>$form, 'model'=>$model, 'education' => $education]) ?>
    <?php // 5 EXPERIENCE ?>
        <?= $this->render('formParts/experience.php', ['form'=>$form, 'model'=>$model, 'experience' => $experience]) ?>
    <?php // 5 CERTIFICATIONS ?>
        <?= $this->render('formParts/certifications.php', ['form'=>$form, 'model'=>$model, 'certification' => $certification]) ?>
    <?php // 5 OPENING HOURS ?>
        <?= $this->render('formParts/openingHours.php', ['form'=>$form, 'model'=>$model, 'openingHours' => $openingHours]) ?>

    <?php // 16 SUBMIT
        if(Yii::$app->controller->action->id!='update'): ?>
        <div class="float-right col-md-5" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-cart"></i> Napravi prezentaciju'), ['class' => 'btn btn-success shadow btn-lg form-presentation', 'style'=>'width:100%']) ?>
        </div>
    <?php endif; ?>                        
    </fieldset>
<?php ActiveForm::end(); ?>
