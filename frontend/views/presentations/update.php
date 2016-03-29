<?php

use yii\helpers\Html;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */

$this->title = Yii::t('app', 'Podešavanje prezentacije ') . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Presentations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$this->params['object_model'] = $object_model;
$this->params['service'] = $service;
$this->params['presentation'] = $model;
?>
<?= $this->render('_form', [
    'service' => $model->pService,
    'model' => $model,
    'model_methods' => $model_methods,
    'model_specs' => $model_specs,
    'object_model' => $object_model,
    'locationHQ'=> $locationHQ,
    'locationPresentation'=> $locationPresentation,
    'locationPresentationTo'=> $locationPresentationTo,
    'user' => $user,
    'model_timetable' => $model_timetable,
    'provider_openingHours' => $provider_openingHours,
    'model_notifications' => $model_notifications,
    'model_terms' => $model_terms,
    'new_provider' => $new_provider,
	'returning_user' => $returning_user,
	'model_termexpenses' => $model_termexpenses,
    'model_termmilestones' => $model_termmilestones,
    'model_termclauses' => $model_termclauses,
]) ?>
<?php if($medias = $model->images){
	foreach($medias as $media){
		Modal::begin([
	        'id'=>'image-delete'.$media->id,
	        //'size'=>Modal::SIZE_SMALL,
	        'options' => ['class'=>'overlay_modal fade'],
	        'header'=> '<h4 class="thin center">Da li zaista želite da obrišete sliku iz prezentacije?</h4>',
	    ]); ?>

		    <div class="container-fluid">
		        <div class="row">
		            <div class="col-md-12 center">
		                <?= Html::a(Yii::t('app', 'Potvrdi'), ['/presentations/deleteImage', 'id' => $media->id], ['class' => 'btn btn-danger margin-right-20', 'data'=>['method'=>'post']]) ?>
		                <?= Html::button(Yii::t('app', 'Odustani'), ['class' => 'btn btn-default', 'data-dismiss'=>"modal"]) ?>
		            </div>
		        </div>
		    </div>
		<?php Modal::end();
	}
} ?>
