<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use frontend\models\Notifications;
use yii\helpers\Url;
?>
<?php
$notification = $model->notifyText();
$icon = $notification['icon'];
$color = $notification['color'];
$notify_title = $notification['notify_title'];
$notify_text = $notification['notify_text']; 
$formatter = \Yii::$app->formatter;
$link = ($model->is_read==0) ? Url::to('site/index', array('notification'=>'', 'value'=>"1")) : Url::to('site/index', array('notification'=>'', 'value'=>"0"));
?>

<div class="card_container record-650 list-item" id="card_container" style="float:none;">
    <div class="primary-context small-margin">
        <div class="head lower" style="<?= ($model->is_read==0) ? '' : 'color:#bbb' ?>">
        	<span style="color:<?= ($model->is_read==0) ? $color : 'gray' ?>"><?php echo $icon; ?></span>
            <?= $notify_title ?>
            <?= ($model->cc>1) ? '&nbsp;('.$model->cc.')' : '' ?>
            <div class="subaction">
                <i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->notification_time]) ?>
            </div>
        </div>
        <div class="subhead"><?= $notify_title ?></div>
    </div>
    <div class="secondary-context tease">
        <?php echo $notify_text; ?>
    </div>
    <div class="action-area">
    	<?= Html::a(($model->is_read==0) ? Yii::t('app', 'Mark as read') : Yii::t('app', 'Mark as unread'), $link, ['class'=>'btn btn-link']); ?>
    </div>            
</div>