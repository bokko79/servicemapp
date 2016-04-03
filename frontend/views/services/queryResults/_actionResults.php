<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\Session;
$session = Yii::$app->session;
$state = $session->get('state');
?>
<div class="card_container record-full transparent no-shadow fadeInUp animated" id="card_container" style="">
    <div class="primary-context overflow-hidden">
    	<div class="avatar">
    		<i class="fa fa-flag-o fa-3x"></i>
    	</div>
    	<div class="title">
    		<div class="head grand"><?= c($action->tName) ?></div>	        
    	</div>	        
    </div>
    <div class="secondary-context overflow-hidden avatar-padded">
    <?php  	
    	if ($services = $action->services):
    		foreach ($services as $model): ?>    		
		    	<div class="card_container record-full transparent top-bordered no-shadow  no-margin fadeInUp animated" id="card_container" style="">
				    <div class="primary-context overflow-hidden low-margin">
				    	<div class="avatar round">
				    		<?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'']) ?>
				    	</div>
				    	<div class="title">
				    		<div class="head major regular" style="line-height: 22px;">
				    			<?= Html::a(c($model->object->tName), Url::to(['/s/'.slug($model->tName)]), []) ?>
				    			<span class="fs_11 muted">[<?= c($model->tName) ?>]</span> 
				    			<?= (1==1) ? '<div class="label label-success fs_11 thin"><i class="fa fa-plus"></i> Prati</div>' : null ?></div>
					        <div class="subhead">
					        	<i class="fa fa-flag"></i> <b><?= count($model->presentations) ?></b>
					        	<i class="fa fa-shopping-cart"></i> <b><?= count($model->orders) ?></b>
					        	 | <?= c($model->industry->tName) ?> <i class="fa fa-caret-right"></i> <?= c($model->industry->category->tName) ?></div>
				    	</div>
				    	<div class="subaction">
				    		<?= Html::a('<i class="fa fa-bars"></i>&nbsp;'.Yii::t('app', 'Pregled ponuda'), Url::to(['/presentations', 'PresentationsSearch[service_id]'=>$model->id]), ['class'=>'btn btn-default margin-right-10', 'style'=>'']) ?>
				    		<?php if($model->object->models): ?>
							<?= $state!='present' ? Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Naruči'), Url::to(), ['class'=>'btn btn-info margin-right-10', 'style'=>'color:#fff;', 'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#object-models-order-modal'.$model->id]) : null ?>
				            <?= $state!='order' ? Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Ponudi'), Url::to(), ['class'=>'btn btn-warning', 'style'=>'', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#object-models-present-modal'.$model->id]) : null ?>
				        <?php else: ?>
				            <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Naruči'), Url::to(['/add/'.slug($model->name), 'CsObjects[id]'=>$model->object->id]), ['class'=>'btn btn-info margin-right-10', 'style'=>'color:#fff;']) ?>

				        	<?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Ponudi'), ['/new-presentation'], [
				                'class'=>'btn btn-warning', 
				                'style'=>'', 
				                'data'=>[
				                    'method' => 'get',
				                    'params'=>['ProviderServices[object_model]'=>$model->object->id, 'ProviderServices[service_id]'=>$model->id, 'ProviderServices[id]'=>null],
				                ]
				            ]) ?>
				        <?php endif; ?>
				    	</div>	        
				    </div>
				</div>			
	<?php 
			endforeach;
		endif; ?>
	</div>
</div>

<?php Modal::begin([
        'id'=>'object-models-order-modal'.$model->id,
        'size'=>Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> $model->object->isPart() ? ($model->service_object==1 ? '<h3>Izaberite kakve vrste '.$model->object->parent->tNameGen.' Vas interesuju:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->parent->tNameGen.'</h3>') : ($model->service_object==1 ? '<h3>Izaberite kakve vrste '.$model->object->tNameGen.' Vas interesuju:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->tNameGen.'</h3>'),
    ]); ?>
   <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
<?php Modal::end(); ?>
<?php Modal::begin([
        'id'=>'object-models-present-modal'.$model->id,
        'size'=>Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> $model->object->isPart() ? ($model->service_object!=1 ? '<h3>Izaberite kakve vrste '.$model->object->parent->tNameGen.' imate u ponudi:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->parent->tNameGen.'</h3>') : ($model->service_object!=1 ? '<h3>Izaberite kakve vrste '.$model->object->tNameGen.' imate u ponudi:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->tNameGen.'</h3>'),
    ]); ?>
   <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
<?php Modal::end(); ?>