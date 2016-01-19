<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
      
<div class="card_container record-270 no-shadow" id="card_container" style="float:none;">
    
        <div class="header-context page-title side-widget">
            <h4><i class="fa fa-life-ring"></i> Pomoć</h4>
        </div>     
        <div class="primary-context">
            <div class="subhead">Setup progress meter</div>
        </div>
        <div class="secondary-context cont">            
            <p>You have successfully created your Yii-powered application.</p>
        </div>
        <div class="action-area">
            <?= Html::a('<i class="fa fa-info-circle"></i>&nbsp;'.Yii::t('app', 'Info'), Url::to('/posts'), ['class'=>'btn btn-link']); ?>
            <?= Html::a('<i class="fa fa-chevron-down"></i>', null, ['class'=>'btn btn-link float-right show-more']); ?>
        </div>
        <div class="secondary-context cont hidden hidden-content fadeInDown animated">
            <ul>
                <!--POMOĆ ZA PRETRAGU UOPŠTE-->
                <li style=""><h4><?= Yii::t('app', 'Search help'); ?></h4></li>
                <li style="line-height:15px;"><?= Yii::t('app', 'Quickly and easily find any service category, industry, service itself or its object, relevant tags or important localities. Just type desired word or part of the word into the big white search box on top of the main menu and browse through search results to find the best possible match.'); ?></li>

                <!--POMOĆ ZA KATEGORIJE-->
                <li style="margin-top: 10px;"><h5><i class="fa fa-list"></i> <?= Yii::t('app', 'Categories'); ?></h5></li>
                <li style="line-height:15px;"><?= Yii::t('app', 'If the Search found any Service Category, click on a desired Category to go to the Category\'s Index Page and browse through available Industries within that Category.'); ?></li>

                <!--POMOĆ ZA DELATNOSTI -->
                <li style="margin-top: 10px;"><h5><i class="fa fa-tags"></i> <?= Yii::t('app', 'Industries'); ?></h5></li>
                <li style="line-height:15px;"><?= Yii::t('app', 'If the Search found any Service Industry, click on a desired Industry to go to the Industry\'s Home Page.'); ?></li>

                <!--POMOĆ ZA USLUGE-->
                <li style="margin-top: 10px;"><h5><i class="fa fa-dot-circle-o"></i> <?= Yii::t('app', 'Services'); ?></h5></li>
                <li style="line-height:15px;"><?= Yii::t('app', 'If the Search found any Services, select as many desired objects (if any) as you like, then proceed to the Service Request Maker and send the Request to Servicemapp Market.'); ?></li>

                <!--POMOĆ ZA OBJEKTE-->
                <li style="margin-top: 10px;"><h5><i class="fa fa-cube"></i> <?= Yii::t('app', 'Service Objects'); ?></h5></li>
                <li style="line-height:15px;"><?= Yii::t('app', 'If the Search found any Service Objects, select as many desired actions as you like and proceed to Service Request Maker and send the Request to the Servicemapp Market.'); ?></li>

                <!--POMOĆ ZA TAGOVE-->
                <li style="margin-top: 10px;"><h5><i class="fa fa-tags"></i> <?= Yii::t('app', 'Tags'); ?></h5></li>
                <li style="line-height:15px;"><?= Yii::t('app', 'If the Search found any Tags, click on the desired Term to proceed with the desired process.'); ?></li>

                <!--POMOĆ ZA LOKACIJE-->
                <li style="margin-top: 10px;"><h5><i class="fa fa-map-marker"></i> <?= Yii::t('app', 'Locations'); ?></h5></li>
                <li style="line-height:15px;"><?= Yii::t('app', 'If the Search found any Locations, click on desired Location to filter your future search of Service Providers, their Hot Deals and/or Service Requests.'); ?></li>
            </ul>
        </div>       
   
</div>