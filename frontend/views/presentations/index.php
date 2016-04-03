<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PresentationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Presentations');
$this->params['breadcrumbs'][] = $this->title;

?>

<?php if($service): ?>
	<h2 class="margin-top-20">Ponude pružalaca za uslugu <?= $service->tName ?></h2>
<?php endif; ?>
<hr>
<h4 class="gray-color">Filteri pretrage</h4>
<?= $this->render('_search.php', [
                    'model'=>$searchModel, 
                    'service'=>$service, 
                    'model_specs' => $model_specs, 
                    'model_methods' => $model_methods, 
                    'location' => $location,
                ]) ?>
<hr>
<?php //<div class="grid js-masonry" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }' style="margin-top:40px;">
 ?>   <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_card',
        //'summary' => '',
    ]) ?>
<?php //</div> ?>
