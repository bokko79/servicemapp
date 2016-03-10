<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php 
    $notify_count = \common\models\Notifications::find()->where(array('user_id'=>Yii::$app->user->id))->all();
    $notifications = \common\models\Notifications::find()->where(array('user_id'=>Yii::$app->user->id))->limit(5)->all();
?>
<?php if (count($notify_count)>0) { ?>
  <span class="title_holder_home"> 
      <h3><i class="fa fa-bell-o"></i>&nbsp;<?php echo Yii::t('app', 'Latest Notifications').'&nbsp;('.count($notify_count).')'; ?></h3>      
  </span>
  <?php foreach ($notifications as $notify) {

    $notification = $notify->notifyText();
    $icon = $notification['icon'];
    $color = $notification['color'];
    $notify_title = $notification['notify_title'];
    $notify_text = $notification['notify_text']; 
    $formatter = \Yii::$app->formatter; ?>
                      
    <li class="notification_list">
      <span class="marginalized">
        <h6 style="<?php echo ($notify->is_read==0) ? '' : 'color:#bbb'; ?>">
          <span style="color:<?php echo ($notify->is_read==0) ? $color : 'gray'; ?>"><?php echo $icon; ?></span>
            <?= $notify_title; ?>
            <?= ($notify->cc>1) ? '&nbsp;('.$notify->cc.')' : ''; ?>
          <span class="time" data-toggle="tooltip" title="<?php echo $formatter->asDate($notify->notification_time, 'short'); ?>"><i class="fa fa-clock-o"></i> <?php /* echo Yii::app()->format->timeago($notify->notification_time);*/ ?></span>
        </h6>
        <p class="clear" style="color:<?php echo ($notify->is_read==0) ? '' : '#bbb'; ?>"><?php echo $notify_text; ?></p>
      </span>                              
    </li> 
  <?php } // foreach ($notifications as $notify) ?>

  <li class="notification_list" style="text-align: center;"><?= Html::a('<i class="fa fa-wrench"></i>&nbsp;'.Yii::t('app','Notifications Settings'), Url::to('/'.Yii::$app->user->identity->username.'/notifications-setup'), ['style'=>'']); ?></li>

  <!--<li class="notifaction_list" style="text-align: center; border:none;"><?php /* echo CHtml::link('<i class="fa fa-bell-o"></i>&nbsp;'.Yii::t('main','See all notifications'), $this->createUrl(Yii::app()->user->getState('username').'/notifications'), array('style'=>'font-size:14px; font-weight:400;')); */ ?></li>-->
<?php } // if (count($notify_count)!=0) ?> 