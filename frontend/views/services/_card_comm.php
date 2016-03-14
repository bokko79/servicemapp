<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use yii\web\Session;
$session = Yii::$app->session;
?>
<div class="card_container record-sm grid-item fadeInUp animated" id="card_container" style="margin:0 11px;">
    <a href="<?= Url::to('/s/'.slug($model->name)) ?>">
        <div class="media-area">                
            <div class="image">
                <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
            </div>
            <div class="primary-context in-media">
                <div class="head"><?= c($model->tName) ?></div>
            </div>
        </div>
        <div class="primary-context">
            <div class="subhead"><?= c($model->industry->tName) ?></div>
        </div>
        <div class="secondary-context">
            <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
            <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
            <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat.</p>
        </div>
        <div class="action-area right">
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