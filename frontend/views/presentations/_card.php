<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\Session;

$service = $model->pService;
?>
<div class="card_container record-sm grid-item fadeInUp animated" id="card_container" style="">    
    <div class="media-area">
		<div class="image">
			<?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'']) ?>
		</div>
        <div class="primary-context in-media">
            <div class="head major"><?= Html::a(c($model->title), Url::to('/presentation/'.$model->id), ['class'=>'white text-shadow']) ?></div>
            <div class="subhead"><?= c($service->tName) ?>
                <?php if(!Yii::$app->user->isGuest): ?>
                    <a href="<?= Url::to() ?>"><div class="label label-default margin-left-10 regular"><i class="fa fa-bookmark"></i> Obeleži</div></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
        
    <div class="action-area">
		<div class="button float-right">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Poruči'), Url::to(['/add/'.slug($service->tName), 'Presentation[id]'=>$model->id]), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;']) ?>
		</div>
    </div>    
</div>
<?php /*Modal::begin([
        'id'=>'object-models-order-modal'.$model->id,
        'size'=>Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> $model->object->isPart() ? ($model->service_object==1 ? '<h3>Izaberite kakve vrste '.$model->object->parent->tNameGen.' Vas interesuju:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->parent->tNameGen.'</h3>') : ($model->service_object==1 ? '<h3>Izaberite kakve vrste '.$model->object->tNameGen.' Vas interesuju:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->tNameGen.'</h3>'),
    ]); ?>
   <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
<?php Modal::end();*/ ?>
