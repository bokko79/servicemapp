<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\helpers\Url;
?>          
<div class="card_container record-xl grid-item fadeInUp animated" id="card_container<?= $model->id ?>" style="float:none;">

<?php 
    switch ($model->activity) {
        case 'order':
            echo $this->render('/orders/_card_compact.php', ['model'=>\common\models\Orders::find('activity='.$model->id)->one()]);
            break;

        case 'promotion':
            echo $this->render('/promotions/_card_compact.php', ['model'=>\common\models\Promotions::find('activity='.$model->id)->one()]);
            break;

        case 'presentation':
            echo $this->render('/presentations/_card_compact.php', ['model'=>\common\models\Presentations::find('activity='.$model->id)->one()]);
            break;
        
        default:
            //echo $this->render('/orders/_card_compact.php', ['model'=>\common\models\Orders::findOne('activity='.$model->id)]);
            break;
    } ?>
<?php if($model->activity=='order' && $model->bid): ?>
    <div class="action-area normal-case">
        <?= Html::a(Yii::t('app', 'Bids').'&nbsp;<i class="fa fa-caret-down"></i>', null, ['class'=>'btn btn-link bid-link']); ?>
    </div>
    <div class="bids-area animated fadeInDown">
        <?php foreach($model->order->bids as $bid): ?>
            <?= $this->render('/bids/_card.php', ['model'=>$bid]) ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php if($model->activityComments): ?>
    <div class="action-area normal-case">
        <?= Html::a(Yii::t('app', 'Comments').'&nbsp;<i class="fa fa-caret-down"></i>', null, ['class'=>'btn btn-link comment-link']); ?>
    </div>

    <div class="comments-area animated fadeIn closed">
        <?php foreach($model->activityComments as $comment): ?>
            <?= $this->render('_comment.php', ['comment'=>$comment, 'class'=>'']) ?>
        <?php endforeach; ?>                              
    </div> 
<?php endif; ?>         
</div>