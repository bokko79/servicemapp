<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\widgets\FileInput;

$message = '';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">2</span>&nbsp;
        <i class="fa fa-image fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Avatar') ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>
<div class="wrapper body notshown fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
	<?= $form->field($model, 'user_avatar')->widget(FileInput::classname(), [
					    'options' => ['multiple' => false, 'accept' => 'image/*'],
					    'pluginOptions' => [
					    	'previewFileType' => 'any',
					    	'showCaption' => false,
					        'showUpload' => false,
					        'browseClass' => 'btn btn-info shadow',
					        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
					        'browseLabel' =>  Yii::t('app', 'Izaberite profilnu sliku'),
					        'removeLabel' =>  Yii::t('app', 'Izbaci'),
					        'resizeImage'=> true,
						    'maxImageWidth'=> 200,
						    'maxImageHeight'=> 200,
						    'resizePreference'=> 'width',
					    ],
					]) ?>
<?= $this->render('_submitButton.php') ?>
</div>