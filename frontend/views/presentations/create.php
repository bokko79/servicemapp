<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Presentations */

$this->title = Yii::t('app', 'Napravi prezentaciju');
?>
<?= $this->render('_steps.php', ['service'=>$service]) ?>
<div class="presentations-create">

    <?= $this->render('_form', [
    	'service' => $service,
        'model' => $model,
        'model_specs' => $model_specs,
        'model_spec_models' => $model_spec_models,
        'model_methods' => $model_methods,
        'model_images' => $model_images,
        'model_issues' => $model_issues,
        'model_locations' => $model_locations,
        'object_model' => $object_model,
    ]) ?>

</div>
