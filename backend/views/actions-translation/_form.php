<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsActionsTranslation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-actions-translation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'action_id')->textInput() ?>

    <?= $form->field($model, 'lang_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_akk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_inst')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orig_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
