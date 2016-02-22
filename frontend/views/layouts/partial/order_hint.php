<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
      
<div class="card_container record-270 no-shadow" id="card_container" style="float:none; margin-top:40px">
    
        <div class="header-context page-title side-widget" style="background-color:#0FB84D; color:white;">
            <h4>NARUČIVANJE USLUGA ĆE UVEK BITI BESPLATNO!</h4>
        </div>     
        <div class="primary-context">
            <div class="head">Naručite odmah!</div>
        </div>
        <div class="secondary-context cont">
            <p class="margin-bottom-10"><i class="fa fa-check"></i> Get bids from skilled freelancers in minutes.</p>
            <p class="margin-bottom-10"><i class="fa fa-check"></i> View freelancer profiles and feedback, then instantly chat with them!</p>
            <p class="margin-bottom-10"><i class="fa fa-check"></i> With only a 3%* commission fee, your favorite freelancer can start working for you today!</p>
            <p class="margin-bottom-10"><i class="fa fa-check"></i> Pay the freelancer once you're 100% satisfied. *Minimum fees may apply.</p>
        </div>
        <div class="action-area">
            <?= Html::a('<i class="fa fa-info-circle"></i>&nbsp;'.Yii::t('app', 'Info'), Url::to('/posts'), ['class'=>'btn btn-link']); ?>
            
        </div>    
   
</div>