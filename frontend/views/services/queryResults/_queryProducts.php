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
	//foreach ($queryProducts as $queryProduct): ?>    		

		    <div class="primary-context overflow-hidden low-margin">
		    	<div class="avatar">
		    		<?= Html::img('@web/images/objects/car_logo_PNG16'.rand(36,69).'.png', ['style'=>'']) ?>
		    	</div>
		    	<div class="title">
		    		<div class="head third regular"><?= Html::a(c($model->name), ['/auto/index/'], ['data'=>['method'=>'post', 'params'=>['CsServicesSearch[product_id]'=>$model->id]]]) ?></div>
			    	<div class="subhead">
			        	<i class="fa fa-cube"></i> 
			        	 <?php foreach($model->object->getPath($model->object) as $path){
			        	 	echo $path->tName . '/';
			        	 } ?>
			        	 <b><?= $model->object->tName ?></b>
			       	</div>
		    	</div>
		    </div>
	
<?php 
	//endforeach; ?>

</div>