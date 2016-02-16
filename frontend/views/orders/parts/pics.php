<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">4</span>&nbsp;
        <?php echo Yii::t('app', 'Slike {object}', ['object'=>$service->object->tNameGen]); ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;">
    <?= $form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
					    'options' => ['multiple' => true, 'accept' => 'image/*'],
					    'pluginOptions' => [
					    	'previewFileType' => 'any',
					    	'showCaption' => false,
					        //'showRemove' => false,
					        'showUpload' => false,
					        'browseClass' => 'btn btn-primary',
					        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
					        'browseLabel' =>  Yii::t('app', 'Izaberi sliku'),
					        'removeLabel' =>  Yii::t('app', 'Izbaci'),
					        'resizeImage'=> true,
						    'maxImageWidth'=> 200,
						    'maxImageHeight'=> 200,
						    'resizePreference'=> 'width'
					    ]
					]) ?>
</div>