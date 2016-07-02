<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsServices */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-services-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'image_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'industry_id')->textInput() ?>

    <?= $form->field($model, 'action_id')->textInput() ?>

    <?= $form->field($model, 'action_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'service_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'unit_id')->textInput() ?>

    <?= $form->field($model, 'amount')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'amount_default')->textInput() ?>

    <?= $form->field($model, 'amount_range_min')->textInput() ?>

    <?= $form->field($model, 'amount_range_max')->textInput() ?>

    <?= $form->field($model, 'amount_range_step')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consumer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consumer_children')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'consumer_default')->textInput() ?>

    <?= $form->field($model, 'consumer_range_min')->textInput() ?>

    <?= $form->field($model, 'consumer_range_max')->textInput() ?>

    <?= $form->field($model, 'consumer_range_step')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_ownership')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'duration')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'frequency')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'support')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'turn_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tools')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'labour_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coverage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'geospecific')->textInput() ?>

    <?= $form->field($model, 'process')->textInput() ?>

    <?= $form->field($model, 'dat')->dropDownList([ 'open' => 'Open', 'closed' => 'Closed', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'availability')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ordering')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pricing')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'terms')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'approved' => 'Approved', 'submitted' => 'Submitted', 'rejected' => 'Rejected', 'to_finish' => 'To finish', 'updated' => 'Updated', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'hit_counter')->textInput(['maxlength' => true]) ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>

</div>
