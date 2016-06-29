<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\Session;
$session = Yii::$app->session;
$state = $session->get('state');
?>
<div class="card_container record-sm grid-item fadeInUp animated" id="card_container" style="">    
    <div class="media-area">
		<div class="image">
			<?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'']) ?>
		</div>
    </div>
    <div class="primary-context normal">
        <div class="head major"><?= Html::a(c($model->tName), Url::to('/s/'.slug($model->name)), ['class'=>'']) ?></div>
        <div class="subhead"><?= c($model->object_name) ?>
            <?php if(!Yii::$app->user->isGuest): ?>
                <a href="<?= Url::to() ?>"><div class="label label-default margin-left-10 regular"><i class="fa fa-bookmark"></i> Obeleži</div></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="secondary-context tease">
    	<span><i class="fa fa-globe"></i>&nbsp;<?= count($model->orders) ?></span>
		<span>&nbsp;<i class="fa fa-users"></i>&nbsp;<?= count($model->providerServices) ?></span>
		<span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;<?= count($model->presentations)  ?></span>
        <p><?= c($model->industry->tName) ?></p>
    </div>
    <div class="action-area">
		<div class="button float-right">
        <?php if($state==null or $state==''): ?>
            <?php if($model->object->models): ?>
    			<?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Poruči'), Url::to(), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;', 'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#object-models-order-modal'.$model->id]) ?>
                <?php // Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Ponudi'), Url::to(), ['class'=>'btn btn-warning', 'style'=>'', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#object-models-present-modal'.$model->id]) ?>
                <?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Ponudi'), Url::to('/presentation/'.slug($model->name)), ['class'=>'btn btn-warning', 'style'=>'']) ?>
            <?php else: ?>
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Poruči'), Url::to('/add/'.slug($model->name)), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;']) ?>
                <?= Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Ponudi'), ['/new-presentation'], [
                    'class'=>'btn btn-warning', 
                    'style'=>'', 
                    'data'=>[
                        'method' => 'post',
                        'params'=>['Presentations[service_id]'=>$model->id],
                    ]
                ]) ?>
            <?php endif; ?>
        <?php else: ?>
            <?php if($model->object->models): ?>
                <?= $state=='order' ? Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Poruči'), Url::to(), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;', 'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#object-models-order-modal'.$model->id]) : null ?>
                <?php // $state=='present' ? Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Ponudi'), Url::to(), ['class'=>'btn btn-warning', 'style'=>'', 'data-toggle'=>'modal', 'data-backdrop'=>false, 'data-target'=>'#object-models-present-modal'.$model->id]) : null ?>
                <?= $state=='present' ? Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Ponudi'), Url::to('/presentation/'.slug($model->name)), ['class'=>'btn btn-warning', 'style'=>'']) : null ?>
            <?php else: ?>
                <?= $state!='present' ? Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Poruči'), Url::to('/add/'.slug($model->name)), ['class'=>'btn btn-info order_service', 'style'=>'color:#fff;']) : Html::a('<i class="fa fa-plus-circle"></i>&nbsp;'.Yii::t('app', 'Present'), ['/new-presentation'], [
                    'class'=>'btn btn-warning', 
                    'style'=>'', 
                    'data'=>[
                        'method' => 'post',
                        'params'=>['Presentations[service_id]'=>$model->id],
                    ]
                ]) ?>
            <?php endif; ?>
        <?php endif; ?>
		</div>
    </div>    
</div>
<?php Modal::begin([
        'id'=>'object-models-order-modal'.$model->id,
        'size'=>Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> $model->object->isPart() ? ($model->object_ownership=='provider' ? '<h3>Izaberite kakve vrste '.$model->object->parent->tNameGen.' Vas interesuju:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->parent->tNameGen.'</h3>') : ($model->object_ownership=='provider' ? '<h3>Izaberite kakve vrste '.$model->object->tNameGen.' Vas interesuju:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->tNameGen.'</h3>'),
    ]); ?>
   <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
<?php Modal::end(); ?>
<?php Modal::begin([
        'id'=>'object-models-present-modal'.$model->id,
        'size'=>Modal::SIZE_SMALL,
        'class'=>'overlay_modal',
        'header'=> $model->object->isPart() ? ($model->object_ownership=='user' ? '<h3>Izaberite kakve vrste '.$model->object->parent->tNameGen.' imate u ponudi:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->parent->tNameGen.'</h3>') : ($model->object_ownership=='user' ? '<h3>Izaberite kakve vrste '.$model->object->tNameGen.' imate u ponudi:</h3>' :
        '<h3>Izaberite vrstu '. $model->object->tNameGen.'</h3>'),
    ]); ?>
   <div id="loading"><i class="fa fa-cog fa-spin fa-3x gray-color"></i></div>
<?php Modal::end(); ?>
