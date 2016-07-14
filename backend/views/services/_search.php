<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CsServicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-services-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'file_id') ?>

    <?= $form->field($model, 'industry_id') ?>

    <?= $form->field($model, 'action_id') ?>

    <?php // echo $form->field($model, 'object_id') ?>

    <?php // echo $form->field($model, 'object_model_relevance') ?>

    <?php // echo $form->field($model, 'service_type') ?>

    <?php // echo $form->field($model, 'unit_id') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'amount_default') ?>

    <?php // echo $form->field($model, 'amount_range_min') ?>

    <?php // echo $form->field($model, 'amount_range_max') ?>

    <?php // echo $form->field($model, 'amount_range_step') ?>

    <?php // echo $form->field($model, 'consumer') ?>

    <?php // echo $form->field($model, 'consumer_children') ?>

    <?php // echo $form->field($model, 'consumer_default') ?>

    <?php // echo $form->field($model, 'consumer_range_min') ?>

    <?php // echo $form->field($model, 'consumer_range_max') ?>

    <?php // echo $form->field($model, 'consumer_range_step') ?>

    <?php // echo $form->field($model, 'service_object') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'frequency') ?>

    <?php // echo $form->field($model, 'support') ?>

    <?php // echo $form->field($model, 'turn_key') ?>

    <?php // echo $form->field($model, 'tools') ?>

    <?php // echo $form->field($model, 'labour_type') ?>

    <?php // echo $form->field($model, 'coverage') ?>

    <?php // echo $form->field($model, 'geospecific') ?>

    <?php // echo $form->field($model, 'process') ?>

    <?php // echo $form->field($model, 'dat') ?>

    <?php // echo $form->field($model, 'availability') ?>

    <?php // echo $form->field($model, 'ordering') ?>

    <?php // echo $form->field($model, 'pricing') ?>

    <?php // echo $form->field($model, 'terms') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'added_by') ?>

    <?php // echo $form->field($model, 'added_time') ?>

    <?php // echo $form->field($model, 'hit_counter') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
