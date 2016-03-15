<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;

$message = 'Jedna slika vredi više od hiljadu reči. Pokažite pružaocima usluga o čemu se radi tako što ćete prikačiti fotografije '. $service->object->tNameGen;
?>
<div class="wrapper headline" style="" id="pics">
    <label class="head">
        <span class="badge"><?= $model->noPic ?></span>&nbsp;
        <i class="fa fa-image fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Slike {object}', ['object'=>$service->object->tNameGen]) ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections03">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>
	
	<?php if($medias = $model->images){
		echo '<label class="control-label col-md-3" for="presentations-imagefiles">Izabrane slike</label>';
		echo '<div class="col-sm-9 margin-bottom-20">';
		foreach($medias as $media){
			$image = Html::img('@web/images/presentations/thumbs/'.$media->image->ime);
			echo Html::a($image, Url::to(), [
                'class' => 'margin-bottom-10 margin-right-10',
                'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#image-delete'.$media->id
            ]);
		}
		echo '</div>';
	} ?>
	
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