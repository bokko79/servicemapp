<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Tabs;
use frontend\widgets\Stats;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\tabs\TabsX;

$items = [
    [
        'label'=>'<i class="fa fa-hand-grab-o"></i> Veštine',
        'content'=>'<span><i class="fa fa-globe"></i>&nbsp;7.345</span>
			                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
			                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
			                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat.</p>',
        'active'=>true
    ],
    [
        'label'=>'<i class="fa fa-th"></i> Opcije',
        'content'=>'bbb',
    ],
    [
        'label'=>'<i class="fa fa-bars"></i> Karakteristike',
        'content'=>'ccc',
    ],
    [
        'label'=>'<i class="fa fa-question"></i> Problemi',
        'content'=>'ddd',
    ],
    
];
?>
<div class="profile_head product">
	<!-- HEADER -->
	<?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>

	<div class="grid-container">
		<div class="grid-row">			
			<div class="grid-profile-rightacross" style="">

				<div class="card_container record-full no-shadow fadeInUp animated" id="card_container" style="float:none;">				        
		            <div class="header-context low-margin">                
		                <div class="avatar">
		                    <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
		                </div>
		                <div class="title">
		                    <div class="head second">Service order no. #00542177</div>
		                    <div class="subhead"><i class="fa fa-bookmark"></i> normal</div> 
		                </div>
		                <div class="subaction">
		                    status/validity    
		                </div>
		            </div>		            
		    	</div>

				<div class="grid-profile-center" style="">				
				
					<div class="card_container record-full no-shadow fadeInUp animated" id="card_container" style="float:none;">				        
			            <div class="header-context gray">                
			                <div class="avatar">
			                    <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
			                </div>
			                <div class="title">
			                    <div class="head lower">Masterplan</div>
			                    <div class="subhead"><?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?></div> 
			                </div>
			                <div class="subaction">
			                    <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?>    
			                </div>
			            </div>
			            <div class="primary-context">
			            	<div class="subhead"><i class="fa fa-building"></i> Izdavanje nekretnina</div>
			                <div class="head major">Kratkoročno izdavanje apartmana</div>
			                
			            </div>            
			    	</div>
			    	<div class="card_container record-full card-tile left-sidebar fadeInUp animated" id="card_container" style="float:none;">				        
			            
			            <div class="action-area">
			                <?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger']); ?>
			            </div>
			            <div class="secondary-context cont">
			            <?php
			            	echo TabsX::widget([
							    'items'=>$items,
							    'position'=>TabsX::POS_ABOVE,
							    'encodeLabels'=>false,
							    'containerOptions' => ['class'=>'product-nav-tabs']
							]); ?>			                
			            </div>			            
			    	</div>
			    	<div style="float:none; height:50px;"></div>
				</div>

				<div class="grid-right">
					<div class="card_container record-full no-shadow fadeInUp animated" id="card_container" style="float:none;">				        
			            <div class="header-context">                
			                <div class="avatar">
			                    <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
			                </div>
			                <div class="title">
			                    <div class="head second">Masterplan</div>
			                    <div class="subhead"><?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?></div> 
			                </div>
			                <div class="subaction">
			                    <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?>    
			                </div>
			            </div>		            
			    	</div>
					<?php /* WIDGET: STATS */ ?>
					<?= Stats::widget([
						'boxData'=>$this->stats,
					]) ?>
				</div>


				
			</div>

			<div class="grid-profile-left media-screen">
				<?= Html::img('@web/images/cards/info/info_docs4.jpg') ?>
			</div>
			<?php /* WIDGET: TABS */ ?>
					<?= Tabs::widget([
						'tabs' => $this->tabs,
					]) ?>
		</div>			
	</div>
</div>