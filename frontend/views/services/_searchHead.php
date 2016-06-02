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
        <div class="head  thin">Rezultati pretrage za traženi pojam: 
        	<?php
        		if($searchString){
        			echo '<span class="head ">"'.$searchString.'"</span>';
        		} else if($action) {
        			echo '<span class="head ">'.c($action->tName).'<span class="fs_11 gray-color regular margin-left-5">[akcija]</span></span>';
        		} else if($object) {
        			echo '<span class="head">'.c($object->tName).'<span class="fs_11 gray-color regular margin-left-5">[predmet usluge]</span></span>';
        		} else if($product) {
                    echo '<span class="head">'.c($product->name).'<span class="fs_11 gray-color regular margin-left-5">[proizvod]</span></span>';
                } ?>
        	<?= Html::a('<i class="fa fa-table"></i>', Url::current(['advanced-view'=>null]), ['class'=>'fs_13']).'<span class="fs_11 gray-color"> | </span>'.Html::a('<i class="fa fa-list"></i>', Url::current(['advanced-view'=>'list']), ['class'=>'fs_13']) ?>
        </div>
        <div class="subhead">
        	<b><?= $countSearchResults ?> rezultata: </b>
        	Usluge: <b><?= $countServicesResults ?></b> | Delatnosti: <b><?= $countIndustriesResults ?></b> | Akcije: <b><?= $countActionsResults ?></b> | Predmeti usluga: <b><?= $countObjectsResults ?> | Proizvodi: <b><?= $countProductsResults ?></b>
           
        </div>
    </div>
</div>