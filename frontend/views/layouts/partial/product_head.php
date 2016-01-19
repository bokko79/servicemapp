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

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$model = frontend\models\User::findOne(1);
$coord = new LatLng(['lat' => $model->userDetails->loc->lat, 'lng' => $model->userDetails->loc->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    
]);

$map->width = '100%';
$map->height = '225';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);

// Add marker to the map
$map->addOverlay($marker);
?>
<div class="product-head">

    <div class="grid-container margin-bottom-20 border-bottom">
		<div class="grid-row">
			<div class="grid-leftacross">
				<?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
			</div>
			<div class="grid-right right" style="padding-top: 10px;">
				<?= $this->render('share.php') ?>				
			</div>
		</div>
	</div>

	<div class="grid-container" style="">
		<div class="grid-row">	
			<div class="card_container record-full fadeInUp animated" id="card_container" style="float:none;">				        
	            <div class="header-context">
	            	<table>
	            		<tr>
	            			<td>
	            				<div class="avatar">
				                    <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
				                </div>
				                <div class="title">
				                    <div class="head second">Masterplan</div>
				                    <div class="subhead"><?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?></div> 
				                </div>
	            			</td>
	            			<td>
	            				<div class="avatar">
				                    <i class="fa fa-play fa-2x"></i>          
				                </div>
				                <div class="title">
				                    <div class="head second">Service order no. #00542177</div>
				                    <div class="subhead"><i class="fa fa-bookmark"></i> normal</div> 
				                </div>
				                
	            			</td>
	            			<td>
	            				<div class="subaction">
				                    status/validity    
				                </div>
	            			</td>
	            		</tr>
	            	</table>	                
	            </div>
	            <table class="main-context"> 
	                <tr>
	                    <td class="body-area">
	                    	<div class="header-context low-margin">                
				                <div class="avatar">
				                    <?= Html::img('@web/images/cards/info/info_docs3.jpg') ?>          
				                </div>
				                <div class="title">
				                	<div class="label label-success"><i class="fa fa-building"></i> Izdavanje nekretnina</div>
				                    <div class="head">Kratkoročno izdavanje apartmana<span style="font-weight: 400; color:#999; font-size: 14px; margin-left: 10px;" >65 m<sup>2</sup></span></div>
				                    <div class="head">Izdavanje apartmana</div>
				                     
				                </div>
				                <div class="subaction">
				                    <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?>    
				                </div>
				            </div>

	                        <div class="secondary-context cont">
	                        <hr>
	                        	<?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger']); ?>	                            
	                        </div>
	                        <div class="secondary-context cont">
	                        <hr>
	                        	<?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger']); ?>
	                            
	                        </div>
	                    </td>
	                    <td class="grid-profile-left media-screen">
	                        <?= $map->display() ?>
	                    </td>
	                </tr>                        
	            </table>
	    	</div>		
		</div>			
	</div>
	<div class="grid-container">
		<div class="grid-row">
			<div class="grid-profile-rightacross">								
				
					<div class="card_container record-full no-shadow fadeInUp animated" id="card_container" style="float:none;">
			            <div class="primary-context">
			            	<div class="subhead"><i class="fa fa-building"></i> Izdavanje nekretnina</div>
			                <div class="head major">Kratkoročno izdavanje apartmana</div>			                			                
			            </div>            
			    	</div>
			    	<div class="card_container record-full card-tile left-sidebar fadeInUp animated" id="card_container" style="float:none;">				        
			            
			            <div class="secondary-context cont">
			           		<p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat.</p>			                
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
				
			</div>
			<div class="grid-profile-left media-screen">
				<?= Html::img('@web/images/cards/info/info_docs4.jpg') ?>
			</div>
		</div>
	</div>

	<div class="grid-container">
		<div class="grid-row">
			<div style="float:none; height:50px;"></div>
			<?php /* WIDGET: TABS */ ?>
			<?= Tabs::widget([
				'tabs' => $this->tabs,
			]) ?>
		</div>
	</div>
</div>