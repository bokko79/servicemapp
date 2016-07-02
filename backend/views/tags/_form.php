<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsTags */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-tags-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'entity')->dropDownList([ 'service' => 'Service', 'industry' => 'Industry', 'object' => 'Object', 'category' => 'Category', 'action' => 'Action', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'entity_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lang_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tag')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orig_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>

</div>
