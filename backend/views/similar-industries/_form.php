<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsSimilarIndustries */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-similar-industries-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'industry_id')->textInput() ?>

    <?= $form->field($model, 'similar_industry_id')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
