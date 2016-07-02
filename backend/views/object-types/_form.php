<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsObjectTypes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-object-types-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'object_class_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>
    
    <?php ActiveForm::end(); ?>

</div>
