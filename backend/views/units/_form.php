<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsUnits */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-units-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oznaka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oznaka_imp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ozn_htmlfree')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ozn_htmlfree_imp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
