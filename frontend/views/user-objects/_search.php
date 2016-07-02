<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2; // or kartik\select2\Select2
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model frontend\models\UserObjectsSearch */
/* @var $form yii\widgets\ActiveForm */
?>
<h5 class="search-index" style="margin: 20px 10px 0; cursor: pointer"><i class="fa fa-search"></i> <?= Yii::t('app', 'Search') ?> <i class="fa fa-caret-down"></i></h5>
<div class="user-objects-search fadeInDown animated" style="margin: 20px 10px; display:none;">

    
     
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_INLINE
    ]); ?>

    <?= $form->field($model, 'object_id', [
                    'options' =>['style'=>''],
                    'addon' => [
                        'append' => [
                            'content' => Html::submitButton('Go', ['class'=>'btn btn-primary']), 
                            'asButton' => true
                        ]
                    ],
                ])->widget(Select2::classname(), [
                        'data' => ArrayHelper::map(\common\models\CsObjects::find()->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Select object type ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]) ?>

    <?php //= Html::submitButton(Yii::t('app', 'Go'), ['class' => 'btn btn-primary']) ?>

    <?php // echo $form->field($model, 'loc_id') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'is_set') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    

    <?php ActiveForm::end(); ?>

</div>
