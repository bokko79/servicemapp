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
    <?php // 1 GENERAL USER DETAILS: username, email, password, fullname ?>
         <?= $this->render('formParts/basic.php', ['form'=>$form, 'model'=>$model, 'details' => $details]) ?>
    <?php // 2 AVATAR/COVER ?>
        <?= $this->render('formParts/avatar.php', ['form'=>$form, 'model'=>$model, 'details' => $details]) ?>
    <?php // 3 USER DETAILS: fullname, DOB, gender ?>
        <?= $this->render('formParts/details.php', ['form'=>$form, 'model'=>$model, 'details' => $details]) ?>
    <?php // 4 CONTACT DETAILS: email, phone, fax ?>
        <?= $this->render('formParts/contact.php', ['form'=>$form, 'model'=>$model, ]) ?>
    <?php // 5 LOCATION ?>
        <?= $this->render('formParts/location.php', ['form'=>$form, 'model'=>$model, 'locationHQ' => $locationHQ]) ?>
    <?php // 6 ACCOUNT: invite, role, account type, status, currency, units, language ?>

    <?php // 16 SUBMIT
        if(Yii::$app->controller->action->id!='update'): ?>
        <div class="float-right col-md-5" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-cart"></i> Napravi prezentaciju'), ['class' => 'btn btn-success shadow btn-lg form-presentation', 'style'=>'width:100%']) ?>
        </div>
    <?php endif; ?>                        
    </fieldset>
<?php ActiveForm::end(); ?>
