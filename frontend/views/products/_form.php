<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CsProducts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'object_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'object_property_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'property_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'level')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'class')->dropDownList([ 'menu' => 'Menu', 'product' => 'Product', 'variant' => 'Variant', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'base_product_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'predecessor_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'successor_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
