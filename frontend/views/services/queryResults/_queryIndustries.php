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
<div class="card_container record-full transparent no-shadow fadeInUp animated" id="card_container" style="">
<?php
	foreach ($queryIndustries as $queryIndustry): ?>
	    <div class="primary-context overflow-hidden low-margin bottom-bordered">
	    	<div class="avatar">
	    		<i class="fa <?= $queryIndustry->icon ?> fa-3x" style="color:<?= $queryIndustry->color ?>"></i>
	    	</div>
	    	<div class="title">
	    		<div class="head major"><?= Html::a(c($queryIndustry->tName), ['/auto/index/'], ['data'=>['method'=>'post', 'params'=>['CsServicesSearch[industry_id]'=>$queryIndustry->id]]]) ?></div>
	    		<div class="subhead"><?= c($queryIndustry->category->tName) ?></div>
	    	</div>
	    	   
	    </div>
<?php 
	endforeach; ?>
</div>