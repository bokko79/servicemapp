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

<li class="notifaction_list">
	<span class="marginalized">
		<h6 style="<?php echo ($model->is_read==0) ? 'font-weight:900' : 'color:#bbb'; ?>">
			<span style="color:<?php echo ($model->is_read==0) ? $color : 'gray'; ?>"><?php echo $icon; ?></span>
				<?= $notify_title ?> 
				<?= ($model->cc>1) ? '&nbsp;('.$model->cc.')' : '' ?>
			<span class="time" data-toggle="tooltip" title="<?= $formatter->asDate($model->notification_time) ?>"><i class="fa fa-clock-o"></i> <?//= \yii\timeago\TimeAgo::widget(['timestamp' => $model->notification_time]); ?><?= $formatter->asDate($model->notification_time, 'long') ?></span>
		</h6>	
		<span class="content">
			<span style="color:<?php echo ($model->is_read==0) ? '' : '#bbb'; ?>"><?php echo $notify_text; ?></span><br>
			<a href="<?php echo $link; ?>">
				<span class="mark_as_read"><?php echo ($model->is_read==0) ? Yii::t('app', 'Mark as read') : Yii::t('app', 'Mark as unread'); ?></span>
			</a>
		</span>
	</span><!-- <span class="marginalized">-->
</li><!-- <li class="notifaction_list"> -->