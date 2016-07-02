<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\switchinput\SwitchInput;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;
?>


<?php $form = kartik\widgets\ActiveForm::begin([
    'id' => 'form-horizontal',
    'type' => ActiveForm::TYPE_HORIZONTAL,
    'fullSpan' => 7,      
    'formConfig' => ['labelSpan' => 3, 'deviceSize' => ActiveForm::SIZE_MEDIUM],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

    <?= $form->field($model, 'value')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model_trans, 'name')->input('text') ?>

    <?= $form->field($model_trans, 'name_akk')->input('text') ?>

    <?= $form->field($model, 'property_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(\common\models\CsProperties::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Izaberite...'],
            'language' => 'sr-Latn',
            'changeOnReset' => false,           
        ]) ?>

    <?= $form->field($model, 'selected_value')->checkbox()->label() ?>

    <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
                        'options' => [/*'multiple' => true, */'accept' => 'image/*'],
                        'pluginOptions' => [
                            'previewFileType' => 'any',
                            'showCaption' => false,
                            'showUpload' => false,
                            'browseClass' => 'btn btn-info shadow',
                            'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                            'browseLabel' =>  Yii::t('app', 'Izaberite slike ili PDF'),
                            'removeLabel' =>  Yii::t('app', 'Izbaci sve'),
                            'resizeImage'=> true,
                            'maxImageWidth'=> 200,
                            'maxImageHeight'=> 200,
                            'resizePreference'=> 'width',
                        ],
                    ]) ?>

    <?php if($model->image){
        echo '<label class="control-label col-md-3" for="">Slika</label>';
        echo '<div class="col-sm-9 margin-bottom-20">';

                $image = Html::img('/images/property-values/'.$model->image->ime);
                echo Html::a($image, Url::to(), [
                    'class' => 'margin-bottom-10 margin-right-10',
                    //'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#file-delete'.$model->id
                ]);
        echo '</div>';
    } ?>

    <?= $form->field($model_trans, 'hint')->textArea(['rows'=>4]) ?>

    <?= $form->field($model, 'video_link')->textInput(['maxlength' => true]) ?>

    
    <div class="row" style="margin:20px;">
        <div class="col-md-offset-3">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>        
    </div>

    <?php ActiveForm::end(); ?>