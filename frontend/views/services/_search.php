<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model frontend\models\CsServicesSearch */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fullSpan' => 11,      
        'formConfig' => ['labelSpan' => 2, 'deviceSize' => ActiveForm::SIZE_SMALL],
    ]); ?>

        <?= $form->field($model, 'industry_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(\common\models\CsIndustries::find()->all(), 'id', 'name'),
                                'options' => ['placeholder' => 'Izaberi uslužnu delatnost ...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'width' => '100%',
                                ],
                            ]) ?>

        <?= $form->field($model, 'object_id')->widget(Select2::classname(), [
                                'data' => ArrayHelper::map(\common\models\CsObjects::find()->all(), 'id', 'name'),
                                'options' => ['placeholder' => 'Izaberi predmet usluge ...'],
                                'pluginOptions' => [
                                    'allowClear' => true,
                                    'width' => '100%',
                                ],
                            ]) ?>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-9">
                <?= Html::submitButton(Yii::t('app', 'Traži'), ['class' => 'btn btn-default']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

