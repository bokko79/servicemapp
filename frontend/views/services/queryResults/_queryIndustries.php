<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class="card_container record-full transparent no-shadow fadeInUp bottom-bordered animated" id="card_container" style="">
<?php
	//foreach ($queryIndustries as $queryIndustry): ?>
    <div class="primary-context overflow-hidden low-margin ">
    	<div class="avatar">
    		<?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'']) ?>
    	</div>
    	<div class="title">
    		<div class="head third regular">
    			<i class="fa <?= $model->icon ?>" style="color:<?= $model->color ?>"></i> <?= Html::a(c($model->tName), ['/auto/index/'], ['data'=>['method'=>'post', 'params'=>['CsServicesSearch[industry_id]'=>$model->id]]]) ?>
    			<span class="fs_12 muted"><i class="fa fa-globe"></i> <?= $model->countServices ?></span>
    			<span class="fs_12 muted"><i class="fa fa-user"></i> <?= count($model->providers) ?></span>
    		</div>	    		
    		<div class="subhead"><?= c($model->category->tName) ?> <i class="fa fa-caret-right"></i> <?= c($model->sector->tName) ?></div>	    		
    	</div>	    	
    </div>
    <div class="secondary-context avatar-padded col-md-7 cont">
    	<p><?= substr($model->t[0]->description, 0, 250). '...' ?></p>
    </div>
<?php 
	//endforeach; ?>
</div>