<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2; // or kartik\select2\Select2
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\PostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="posts-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE
    ]); ?>

    <?= $form->field($model, 'post_category_id', ['options' =>['style'=>'width:220px; float:left;']])->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(\frontend\models\PostCategory::find()->all(), 'id', 'ime'),
                                'options' => ['placeholder' => 'Select object type ...'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>

    <?= $form->field($model, 'title') ?>
    
    <?= $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'published') ?>

    <?php // echo $form->field($model, 'time') ?>

    <?php // echo $form->field($model, 'description') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
