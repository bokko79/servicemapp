<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;

$message = 'Jedna slika vredi više od hiljadu reči. Pokažite pružaocima usluga o čemu se radi tako što ćete prikačiti fotografije '. $service->object->tNameGen;
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge"><?= $model->noPic ?></span>&nbsp;
        <i class="fa fa-image fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Slike {object}', ['object'=>$service->object->tNameGen]) ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
    <?= $form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
					    'options' => ['multiple' => true, /*'accept' => 'image/*'*/],
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
    <p class="hint-text col-sm-offset-1 margin-top-20 gray-color" style="<?= (Yii::$app->controller->action->id=='update' and $model->youtube_link!='') ? 'display:none' : '' ?>"><i class="fa fa-youtube-square"></i> Želite da objavite Youtube video? <?= Html::a('Unesite URL (link) videa', null, ['class'=>'youtubeUrlLink']) ?></p>
    <div class="youtube_link_container animated fadeIn" style="<?= (Yii::$app->controller->action->id=='update' and $model->youtube_link!='') ? '' : 'display:none' ?>">
       <?= $form->field($model, 'youtube_link')->textInput() ?> 
    </div>
</div>