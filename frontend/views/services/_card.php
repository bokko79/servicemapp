<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
?>
<div class="card_container record-sm grid-item fadeInUp animated" id="card_container" style="">
<a href="<?= Url::to('/s/'.mb_strtolower(str_replace(' ', '-', $model->name))) ?>">
    <div class="media-area">
		<div class="image">
			<?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'']) ?>
		</div>
    </div>
    <div class="primary-context normal">
        <div class="head major"><?= c($model->tName) ?></div>
        <div class="subhead"><?= $model->object_name ?></div>
    </div>
    <div class="secondary-context tease">
    	<span><i class="fa fa-globe"></i>&nbsp;<?= count($model->orderServices) ?></span>
		<span>&nbsp;<i class="fa fa-users"></i>&nbsp;<?= count($model->providerServices) ?></span>
		<span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;<?= count($model->promotionServices)  ?></span>
        <p><?= $model->industry->name ?></p>
    </div>
    <div class="action-area">
        <?php if($model->averagePrice) { ?>
		<div class="price left float-left fs_16">
			<?= '<span class="label label-default">'.$model->averagePrice.'</span>' ?> 
		</div>
		<?php } ?>		

		<div class="button right float-right">
        <?php if($model->object->models): ?>
			<?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;', 'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#object-models-modal'.$model->id]); ?>
        <?php else: ?>
            <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to('/add/'.mb_strtolower(str_replace(' ', '-', $model->name))), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;']); ?>
        <?php endif; ?>
		</div>
    </div>
</a>
</div>

<?php Modal::begin([
        'id'=>'object-models-modal'.$model->id,
        'size'=>Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> ($model->service_object==1) ? '<h3>Izaberite kakve vrste '.$model->object->tNameGen.' Vas interesuju:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->tNameGen.'</h3>',
    ]); ?>

   <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <?= $this->render('_object_models.php', ['object'=>$model->object, 'model'=>$model]) ?>
      </div>
    </div>
  </div>

<?php Modal::end(); ?>