<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsServiceSkills */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-service-skills-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'service_id')->textInput() ?>

    <?= $form->field($model, 'skill_id')->textInput() ?>

    <?= $form->field($model, 'requirement')->textInput() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>

</div>
