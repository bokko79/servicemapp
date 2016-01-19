<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
      
<div class="card_container record-270 no-shadow" id="card_container" style="float:none;">
    <a href="<?= Url::to('/'.Yii::$app->user->username.'/setup') ?>">   
        <div class="header-context page-title side-widget">
            <h4><i class="fa fa-battery-3"></i> Setup progress meter</h4>
        </div>     
        <div class="primary-context">
            <div class="subhead">Setup progress meter</div>
        </div>
        <div class="secondary-context tease">
            <div class="progress">
              <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                60%
              </div>
            </div>
            <p>You have successfully created your Yii-powered application.</p>
        </div>
        <div class="action-area right">
            <?= Html::a('<i class="fa fa-cog"></i>&nbsp;'.Yii::t('app', 'Podešavanja'), Url::to('/'.Yii::$app->user->username.'/setup'), ['class'=>'btn btn-link']); ?>
        </div>        
    </a>
</div>