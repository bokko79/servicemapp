<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsIndustries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-industries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'image_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subtitle')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 'approved' => 'Approved', 'submitted' => 'Submitted', 'rejected' => 'Rejected', 'to_finish' => 'To finish', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'added_by')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'added_time')->textInput() ?>

    <?= $form->field($model, 'hit_counter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>

</div>
