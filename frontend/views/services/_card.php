<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\Session;
$session = Yii::$app->session;
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
		<div class="button float-right">
        <?php if($model->object->models): ?>
			<?= $session['state']!='present' ? Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;', 'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#object-models-modal'.$model->id]) : null ?>
            <?= $session['state']!='order' ? Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Present'), Url::to(), ['class'=>'btn btn-warning', 'style'=>'', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#object-models-modal'.$model->id]) : null ?>
        <?php else: ?>
            <?= $session['state']!='present' ? Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to('/add/'.slug($model->name)), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;']) : Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Present'), ['/new-presentation'], [
                'class'=>'btn btn-warning', 
                'style'=>'', 
                'data'=>[
                    'method' => 'post',
                    'params'=>['Presentations[service_id]'=>$model->id],
                ]
            ]) ?>
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