<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Tabs;
use frontend\widgets\Stats;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\tabs\TabsX;

use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;

$items = [
    [
        'label'=>'<i class="fa fa-tag"></i> Izdavanje nekretnina: Veštine',
        'content'=>'<span><i class="fa fa-globe"></i>&nbsp;7.345</span>
			                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
			                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
			                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat.</p>',
    ],
    [
        'label'=>'<i class="fa fa-th"></i> Izdavanje: Opcije',
        'content'=>'bbb',
    ],
    [
        'label'=>'<i class="fa fa-cube"></i> Apartman: Karakteristike',
        'content'=>'<table class="table table-striped">
					<tr>
						<td>Površina</td>
						<td>65 m<sup>2</sup></td>
					</tr>
					<tr>
						<td>Broj soba</td>
						<td>3</sup></td>
					</tr>
					<tr>
						<td>Broj kupatila</td>
						<td>1</td>
					</tr>
					</table>',
    ],
    [
        'label'=>'<i class="fa fa-question"></i> Apartman: Problemi',
        'content'=>'ddd',
    ],    
];



$model = frontend\models\User::findOne(1);
$coord = new LatLng(['lat' => $model->userDetails->loc->lat, 'lng' => $model->userDetails->loc->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 14,
    
]);

$map->width = '100%';
$map->height = '420';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);


// Add marker to the map
$map->addOverlay($marker);
$map->appendScript("google.maps.event.addDomListener(mapShowTrigger, 'click', function() {
        $(this).closest('.hidden-content-container').find('div.hidden-content').toggleClass('hidden');
        initialize();
	});");
?>

			
			<div class="grid-profile-rightacross">
				<div class="card_container record-full no-shadow bordered no-margin fadeInUp animated" id="card_container" style="float:none;">				        
		            <div class="header-context">
		            	<div class="">
			            	<div class="avatar">
			                    <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
			                </div>
			                <div class="title">
			                    <div class="head second">Masterplan</div>
			                    <div class="subhead"><?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?></div> 
			                </div>
			            </div>
			            <div class="">
			            	<div class="avatar">
			                    <i class="fa fa-play fa-2x"></i>          
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
		    	</div>
				<div class="card_container record-full transparent no-margin no-shadow fadeInUp animated" id="card_container" style="float:none;">		   
		       		<div class="preheader-context">  
						<div class="label label-success"><i class="fa fa-building"></i> Izdavanje nekretnina</div>			                
		            </div>
		            <?php /* service */ ?>
		            <div class="hidden-content-container" style="position:relative;">
			            <div class="header-context">              
			                <div class="avatar">
			                    <?= Html::img('@web/images/cards/info/info_docs3.jpg') ?>          
			                </div>
			                <div class="title">				                	
			                    <div class="head major">Kratkoročno izdavanje apartmana</div>
			                    <div class="subhead"><i class="fa fa-signal fa-rotate-90"></i> 7 dana | <i class="fa fa-user"></i> 3</div>				                     
			                </div>
			                <div class="subaction">
			                    <?= Html::a('<i class="fa fa-chevron-down"></i>', null, ['class'=>'btn btn-link float-right show-more']); ?>    
			                </div>
			            </div>
			            <div class="secondary-context cont avatar-padded hidden hidden-content fadeInDown animated">
			            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat.</p>		                
			            </div>
			            <div class="secondary-context cont avatar-padded hidden hidden-content fadeInDown animated">
			            <?php
			            	echo TabsX::widget([
							    'items'=>$items,
							    'position'=>TabsX::POS_ABOVE,
							    'encodeLabels'=>false,
							    'containerOptions' => ['class'=>'product-nav-tabs']
							]); ?>			                
			            </div>
			        </div>
			        <?php /* service 
			        <div class="hidden-content-container" style="position:relative;">
			            <div class="header-context">              
			                <div class="avatar">
			                    <?= Html::img('@web/images/cards/info/info_docs3.jpg') ?>          
			                </div>
			                <div class="title">				                	
			                    <div class="head major">Izdavanje sobe</div>
			                    <div class="subhead"><i class="fa fa-signal fa-rotate-90"></i> 3 dana | <i class="fa fa-user"></i> 4</div>				                     
			                </div>
			                <div class="subaction">
			                    <?= Html::a('<i class="fa fa-chevron-down"></i>', null, ['class'=>'btn btn-link float-right show-more']); ?>    
			                </div>
			            </div>
			            <div class="secondary-context cont avatar-padded hidden hidden-content fadeInDown animated">
			            <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
			                    ex ea commodo consequat.</p>		                
			            </div>
			            <div class="secondary-context cont avatar-padded hidden hidden-content fadeInDown animated">
			            <?php
			            	echo TabsX::widget([
							    'items'=>$items,
							    'position'=>TabsX::POS_ABOVE,
							    'encodeLabels'=>false,
							    'containerOptions' => ['class'=>'product-nav-tabs']
							]); ?>			                
			            </div>
			        </div> */ ?>    
		    	</div>
		    	<?php /* price/action */ ?>
		    	<div class="card_container record-full transparent no-margin no-shadow top-bordered fadeInUp animated" id="card_container" style="float:none;">
	                <div class="secondary-context avatar-padded">                   
	                	<?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-danger']); ?>	                            
	                </div>                    		                    
		    	</div>
		    	<?php /* time/loc */ ?>
		    	<div class="card_container record-full transparent no-margin no-shadow top-bordered hidden-content-container fadeInUp animated" id="card_container" style="float:none;">
	                <div class="secondary-context cont  avatar-padded">                   
	                	<table>
	                		<tr>
	                			<td>	                				
	                				<table>
	                					<tr>
	                						<td class="section-subtitle">
	                							time
	                						</td>
	                					</tr>
	                					<tr>
	                						<td>
	                							pon 27. mart @<b>18:30</b><?php /* <i class="fa fa-long-arrow-right"></i> sre 29. mart @<b>11:00</b> */ ?>
	                						</td>
	                					</tr>
	                				</table>
	                			</td>
	                			<td>
	                				<table>
	                					<tr>
	                						<td class="section-subtitle">
	                							delivery location
	                						</td>
	                					</tr>
	                					<tr>
	                						<td>
	                							Novi Sad (SRB), Šekspirova 7<?php /*<i class="fa fa-long-arrow-right"></i> Čazma (HR), Kralja Tomislava 3 */ ?>
	                							<?= Html::a('<i class="fa fa-chevron-down"></i>', null, ['class'=>'btn btn-link float-right show-more', 'id'=>'mapShowTrigger']); ?>    
	                						</td>
	                					</tr>
	                				</table>	                				
	                			</td>
	                		</tr>
	                	</table>
	                </div>
	                <div class="media-screen hidden hidden-content" id="map_container">                   
	                	<?= $map->display() ?>
	                </div>                    		                    
		    	</div>

			</div>
			<div class="media-area grid-profile-left">
                <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>
            </div>
        