<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsUnitsTranslation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-units-translation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'unit_id')->textInput() ?>

    <?= $form->field($model, 'lang_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_gen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_imp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oznaka')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'oznaka_imp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ozn_htmlfree')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ozn_htmlfree_imp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'orig_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
