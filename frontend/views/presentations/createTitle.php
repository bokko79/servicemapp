<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */

$this->title = Yii::t('app', 'Nova prezentacija');
$this->params['breadcrumbs'][] = $this->title;
$this->params['service'] = $service;
$this->params['presentation'] = $model;
?>
<?= $this->render('_steps.php', ['model'=>$model]) ?>

<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal-presentation-title',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 12,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
    //'enableAjaxValidation' => true,
    //'enableClientValidation' => true,
]); ?>
    <fieldset class="settings" style="margin:30px 0 !important;">    

    <?php // 5 TITLE & DESC ?>
            <?= $this->render('parts/title.php', ['form'=>$form, 'service' => $service, 'model'=>$model, 'object_model'=>$object_model]) ?>
        <hr>
    <?php // 16 SUBMIT
        if(Yii::$app->controller->action->id!='update'): ?>
        <div class="float-right col-md-5" style="margin:20px;">
            <?= Html::submitButton(Yii::t('app', '<i class="fa fa-shopping-cart"></i> Napravi prezentaciju'), ['class' => 'btn btn-success shadow btn-lg form-presentation', 'style'=>'width:100%']) ?>
        </div>
    <?php endif; ?>
    </fieldset>
<?php ActiveForm::end(); ?>
