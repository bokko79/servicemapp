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
        <div class="head major"><?= Html::a(c($model->tName), Url::to('/services/i/'.slug($model->tName)), ['class'=>'']) ?></div>
        <div class="subhead"><?= c($model->category->tName) ?>
            <?php if(!Yii::$app->user->isGuest): ?>
                <a href="<?= Url::to() ?>"><div class="label label-default margin-left-10 regular"><i class="fa fa-bookmark"></i> Obeleži</div></a>
            <?php endif; ?>
        </div>
    </div>
    <div class="action-area">
		
    </div>    
</div>
