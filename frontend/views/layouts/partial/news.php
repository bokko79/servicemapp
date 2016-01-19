<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
      
<div class="card_container record-270 no-shadow" id="card_container" style="float:none;">
    <a href="<?= Url::to('/post/11') ?>">        
        <div class="primary-context small-margin">
            <div class="head lower">Congratulations</div>
            <div class="subhead">Lorem ipsum</div>
        </div>
        <div class="secondary-context tease">
            <p>You have successfully created your Yii-powered application.</p>
        </div>
        <div class="action-area right">
            <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Read more'), Url::to(), ['class'=>'btn btn-link']); ?>
        </div>        
    </a>
</div>