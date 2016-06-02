<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;

?>
<?php if ($properties):
        foreach ($properties as $property): ?> 
        <div class="card_container record-full transparent no-shadow no-margin fadeInUp animated" id="card_container" style="">
            <div class="secondary-context cont col-md-6">
                <?= c($property->property->tName) ?>
            </div>
        </div>
<?php
        endforeach;
    endif; ?>