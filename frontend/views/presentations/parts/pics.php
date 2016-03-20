<?php
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use kartik\widgets\FileInput;
use yii\helpers\ArrayHelper;

$object = $service->object;
$message = 'Jedna slika vredi više od hiljadu reči. Pokažite pružaocima usluga o čemu se radi tako što ćete prikačiti fotografije '. $service->object->tNameGen;
?>
<div class="wrapper headline" style="" id="pics">
    <label class="head">
        <span class="badge"><?= $model->noPic ?></span>&nbsp;
        <i class="fa fa-image fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Slike {object}', ['object'=>($object_model and count($object_model)==1) ? $object_model[0]->tNameGen : $object->tNameGen]) ?>
    </label>
    <i class="fa fa-chevron-down chevron"></i>
</div>
<div class="wrapper body fadeIn animated" style="border-top:none;" id="sections02">
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
<?php if($user && $user->provider->presWithSameObject($object->id)!=null){ ?>    
    <?= $form->field($model, 'provider_presentation_pics', [
            'feedbackIcon' => [
                'success' => 'ok',
                'error' => 'exclamation-sign',
                'successOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%'],
                'errorOptions' => ['class'=>'text-primary', 'style'=>'padding-right:5%; top: 6px;']
            ],
            'hintType' => ActiveField::HINT_SPECIAL,
            'hintSettings' => ['onLabelClick' => true, 'onLabelHover' => false, 'title' => '<i class="glyphicon glyphicon-info-sign"></i> Napomena', ],
    ])->dropDownList(ArrayHelper::map($user->provider->presWithSameObject($object->id), 'id', 'name'), ['prompt'=>'Izaberite opis '.$object->tNameGen.' iz Vaših postojećih ponuda', 'class'=>'input-lg'])->hint('Već ste sačuvali ponudu usluge sa istim predmetom usluge. Ukoliko se radi o istom predmetu, ne morate ga ponovo opisivati, već izaberite tu ponudu iz padajućeg menija, radi uštede vremena.') ?>
    
    <div class="form-group pres-pics-plaza" style="display:none;">
        <div class="col-md-offset-3 col-md-9">                 
            <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-offset-3 col-md-9">                 
            <h4 class="divider horizontal"><i class="fa fa-sort"></i> ILI</h4>
            <div class="center" style="margin:30px 0 20px">
                <?= Html::a('<i class="fa fa-plus-circle"></i> Opišite novi '.$object->tName, null, ['class'=>'btn btn-default new_pres_pics']) ?>
            </div>
        </div>
    </div>
    <div class="enter_presPics fadeIn animated" style="display:none">
<?php } ?>	
    <?= $form->field($model, 'imageFiles[]')->widget(FileInput::classname(), [
					    'options' => ['multiple' => true, 'accept' => 'image/*'],
					    'pluginOptions' => [
					    	'previewFileType' => 'any',
					    	'showCaption' => false,
					        //'showRemove' => false,
					        'showUpload' => false,
					        'browseClass' => 'btn btn-primary',
					        'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
					        'browseLabel' =>  Yii::t('app', 'Izaberite slike'),
					        'removeLabel' =>  Yii::t('app', 'Izbaci'),
					        'resizeImage'=> true,
						    'maxImageWidth'=> 200,
						    'maxImageHeight'=> 200,
						    'resizePreference'=> 'width'
					    ]
					]) ?>
<?php
if($user && $user->provider->presWithSameObject($object->id)!=null){ ?>
    </div>
<?php } ?>
<?= $this->render('_submitButton.php') ?>
</div>