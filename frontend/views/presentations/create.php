<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */

$this->title = Yii::t('app', 'Nova prezentacija');
$this->params['breadcrumbs'][] = $this->title;
$this->params['service'] = $service;
$this->params['object_model'] = $object_model;
$this->params['presentation'] = $model;
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>
<div class="presentations-create">
    <?= $this->render('_form', [
    	'service' => $service,
        'model' => $model,
        'model_methods' => $model_methods,
        'model_specs' => $model_specs,
        'object_model' => $object_model,
        'new_provider' => $new_provider,
        'returning_user' => $returning_user,
        'locationHQ'=> $locationHQ,
        'locationPresentation'=> $locationPresentation,
        'locationPresentationTo'=> $locationPresentationTo,
        'user' => $user,
        'model_timetable' => $model_timetable,
        'provider_openingHours' => $provider_openingHours,
        'model_notifications' => $model_notifications,
        'model_terms' => $model_terms,
        'model_termexpenses' => $model_termexpenses,
        'model_termmilestones' => $model_termmilestones,
        'model_termclauses' => $model_termclauses,
    ]) ?>
</div>
