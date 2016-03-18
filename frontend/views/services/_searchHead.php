<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\Session;
$session = Yii::$app->session;
?>

<div class="card_container record-full transparent no-shadow no-margin  overflow-hidden" id="card_container" style="">
    <div class="primary-context">
        <div class="head thin">Rezultati pretrage za traženi pojam: 
        	<?php
        		if($searchString){
        			echo '<span class="head">"'.$searchString.'"</span></div>';
        		} else if($action) {
        			echo '<span class="head">'.c($action->tName).'<span class="fs_11 gray-color regular margin-left-5">[akcija]</span></span></div>';
        		} else if($object) {
        			echo '<span class="head">'.c($object->tName).'<span class="fs_11 gray-color regular margin-left-5">[predmet usluge]</span></span></div>';
        		} ?>
        	
        <div class="subhead">
        	<b><?= $dataProvider->getTotalCount()+count($queryIndustries)+count($queryActions)+count($queryObjects) ?> rezultata: </b>
        	Usluge: <b><?= $dataProvider->getTotalCount() ?></b> | Delatnosti: <b><?= count($queryIndustries) ?></b> | Akcije: <b><?= count($queryActions) ?></b> | Predmeti usluga: <b><?= count($queryObjects) ?></b>

        </div>
    </div>
</div>