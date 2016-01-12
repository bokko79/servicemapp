<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\CsServicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cs-services-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'industry_id') ?>

    <?= $form->field($model, 'action_id') ?>

    <?= $form->field($model, 'action') ?>

    <?php // echo $form->field($model, 'object_id') ?>

    <?php // echo $form->field($model, 'object_name') ?>

    <?php // echo $form->field($model, 'unit_id') ?>

    <?php // echo $form->field($model, 'service_type') ?>

    <?php // echo $form->field($model, 'amount') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'service_object') ?>

    <?php // echo $form->field($model, 'consumer_count') ?>

    <?php // echo $form->field($model, 'support') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'duration') ?>

    <?php // echo $form->field($model, 'turn_key') ?>

    <?php // echo $form->field($model, 'addinfo_tools') ?>

    <?php // echo $form->field($model, 'skill_id') ?>

    <?php // echo $form->field($model, 'regulation_id') ?>

    <?php // echo $form->field($model, 'labour_type') ?>

    <?php // echo $form->field($model, 'frequency') ?>

    <?php // echo $form->field($model, 'coverage') ?>

    <?php // echo $form->field($model, 'process') ?>

    <?php // echo $form->field($model, 'geospecific') ?>

    <?php // echo $form->field($model, 'dat') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'added_by') ?>

    <?php // echo $form->field($model, 'added_time') ?>

    <?php // echo $form->field($model, 'hit_counter') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
