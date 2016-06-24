<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\widgets\FileInput;

$object = $service->object;
$message = 'Jedna slika vredi više od hiljadu reči. Pokažite pružaocima usluga o čemu se radi tako što ćete prikačiti fotografije '. $service->object->tNameGen;
?>
<div class="wrapper headline" style="" id="pics">
    <label class="head">
        <span class="badge"><?= $model->noPic ?></span>&nbsp;
        <i class="fa fa-image fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Slike i dokumenti {object}', ['object'=>($object_model and count($object_model)==1) ? $object_model[0]->tNameGen : $object->tNameGen]) ?>
    </label>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections02">

    <?= $this->render('pics/_selected_pics.php', ['model'=>$model]) ?> 	
    <?= $this->render('../_hint.php', ['message'=>$message]) ?> 
	<?= $this->render('pics/_similar_pics.php', ['form'=>$form, 'model'=>$model, 'user'=>$user, 'service'=>$service, 'object'=>$object]) ?>
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
<?php
if($user and $user->provider && $user->provider->presWithSameObject($object->id)!=null && $service->object_ownership!='provider' and Yii::$app->controller->action->id=='create'){ // zaostali div iz _similar_pics ?>
    </div>
<?php } ?>
<?= $this->render('_submitButton.php') ?>
</div>