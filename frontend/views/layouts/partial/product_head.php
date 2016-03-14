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
use dosamigos\google\maps\overlays\Circle;

$action = [];
if($model->methods!=null){
	$content = '<table class="table table-striped" style="margin:20px 0">';

	foreach($model->methods as $method){

		$content .= '<tr>
					<td>'.c($method->method->property->tName).'</td>
					<td>'.$method->value.($method->method->property->unit ? ' '.$method->method->property->unit->oznaka : null).'</td>
				</tr>';
	}
	$content .= '</table>';
	$action = [
        'label'=>'<i class="fa fa-th"></i> '.c($model->pService->action->tName),
        'content'=>$content,
    ];
}
$spec = [];
if($model->specs!=null){
	$content = '<table class="table table-striped" style="margin:20px 0">';
	foreach($model->specs as $spec){
		$content .= '<tr>
					<td>'.c($spec->spec->property->tName).'</td>
					<td>'.$spec->value.($spec->spec->property->unit ? ' '.$spec->spec->property->unit->oznaka : null).'</td>
				</tr>';
	}
	$content .= '</table>';
	$spec = [
        'label'=>'<i class="fa fa-cube"></i> Karakteristike '.($model->objectModel!=null ? $model->objectModel->tNameGen : $model->object->tNameGen),
        'content'=>$content,
    ];
}
$issues = [
        'label'=>'<i class="fa fa-question"></i> Apartman: Problemi',
        'content'=>'ddd',
    ];
$items = [
    $action,
    $spec,
    $issues
];



$user = frontend\models\User::findOne(1);
$coord = new LatLng(['lat' => $user->location->lat, 'lng' => $user->location->lng]);
$map = new Map([
    'center' => $coord,
    'zoom' => 12,
    
]);

$map->width = '400';
$map->height = '320';


// Lets add a marker now
$marker = new Marker([
    'position' => $coord,
    'title' => 'My Home Town',
]);

// Add marker to the map
$map->addOverlay($marker);

if($model->loc_within){
	// Lets add a marker now
	$circle = new Circle([
	    'center' => $coord,
	    'radius' => $model->loc_within*100,
	    /*'strokeWeight' => '5px',
	    'strokeOpacity' => .0,*/
	    'strokeColor' => '#2196F3',
	    'strokeWeight' => 1,
	    'fillOpacity' => 0.08,
	    'editable' => true,
	]);
	$map->addOverlay($circle);
}
// Add marker to the map
$map->appendScript("google.maps.event.addDomListener(mapShowTrigger, 'click', function() {
        $(this).closest('.hidden-content-container').find('div.hidden-content').toggleClass('hidden');
        initialize();
	});");
?>
	<div class="media-area grid-profile-right">
	<?php if($model->images): ?>
		<div class="media">
		<?php foreach ($model->images as $media){
            	$media_items[] = [
					'img' => '../images/presentations/'.$media->image->ime,
					'thumb' => '../images/presentations/thumbs/'.$media->image->ime,
					'full' => '../images/presentations/full/'.$media->image->ime, // Separate image for the fullscreen mode.
	    		]; 
	    		} ?>
	    	<?= \metalguardian\fotorama\Fotorama::widget(
	                [
	                    'options' => [
	                        'loop' => true,
	                        'hash' => true,
	                        'allowfullscreen' => true,
	                        'width' => '400',
	                        'height' => '300',
	                        //'ratio' => 4/3,
	                        'nav' => 'thumbs',
	                        'thumbwidth' => 80,
	                        'thumbheight' => 64,
	                        //'fit' => 'cover',
	                    ],
	                    //'tagName' => 'span',
	                    'useHtmlData' => false,
	                    'htmlOptions' => [
	                        'style'=>'',
	                        'class'=>'card-width-cover'
	                    ],
	                    'items' => $media_items,

	                ]);  ?>
	    </div>
	  <?php endif; ?>
	  <h4 class="border-bottom margin-top-20 gray-color">Lokacija</h4>
	    <div class="maps margin-top-20 margin-bottom-20 drop-shadow">

	    	<?= $map->display() ?>
	    </div>
	</div>
	<div class="grid-profile-rightacross">
		<div class="card_container record-full transparent no-shadow fadeInUp animated" id="card_container" style="float:none;">				        
	        <?php // title ?>
	        <div class="primary-context">  
	        	<div class="head black"><?= c($model->name) ?></div>
            	<div class="subhead"><div class="label" style="background:<?= $model->pService->industry->color ?>"><i class="fa <?= $model->pService->industry->icon ?>"></i> <?= c($model->pService->industry->tName) ?></div> | <?= $model->pService->tName ?></div> 
	        </div> 
	        <?php // provider ?>
	        <div class="header-context">	        	
            	<div class="avatar">
                    <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
                </div>
                <div class="title">
                    <div class="head second"><?= $model->user->username ?></div>
                    <div class="subhead"><?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?></div> 
                </div>
                <div class="subaction">
                    status/validity    
                </div>	           
			</div>
		</div>
		<hr style="margin-top:0">
		<div class="card_container record-full transparent no-shadow fadeInUp animated" id="card_container" style="float:none;">				        
	        <?php // price ?>
	        <div class="header-context">	        	
            	<div class="avatar gray-color">
                    <i class="fa fa-credit-card fa-3x"></i>
                </div>
                <div class="title">
                    <div class="head grand black"><?= Yii::$app->formatter->asCurrency($model->price, $model->currency->code) ?></div>
                    <div class="subhead"><?= $model->fixed_price ? 'Fiksna cena' : 'Cena podložna promeni na upit' ?></div> 
                </div>
                <div class="subaction">
                    Dostupno: <b>od <?= Yii::$app->formatter->asDate($model->available_from) ?> - <?= Yii::$app->formatter->asDate($model->available_until) ?></b>
                </div>	           
			</div>	        	        
		</div>
		<hr style="margin-top:0">
		<div class="card_container record-full transparent no-shadow fadeInUp animated" id="card_container" style="float:none;">				        
	        <?php // action ?>
	        <div class="secondary-context avatar-padded">  
	        	<?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Naruči uslugu'), Url::to(), ['class'=>'btn btn-danger']); ?>
            	
            	<div class="subaction">
                    <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Prati prezentaciju'), Url::to(), ['class'=>'btn btn-link']); ?>
                </div>
	        </div>
		</div>
		<hr style="margin-top:0">
		<div class="card_container record-full transparent no-shadow fadeInUp animated" id="card_container" style="float:none;">		   
	   		<div class="preheader-context">  
							                
	        </div>
	        <?php /* service */ ?>
            <div class="secondary-context avatar-padded fadeInDown animated">
            <p><?= $model->description ?></p>		                
            </div>
            <div class="secondary-context cont avatar-padded fadeInDown animated">
            <?php
            	echo TabsX::widget([
				    'items'=>$items,
				    'position'=>TabsX::POS_ABOVE,
				    'encodeLabels'=>false,
				    'containerOptions' => ['class'=>'product-nav-tabs']
				]); ?>			                
            </div>
		</div>
		<hr style="margin-top:0">
		<?php /* time/loc */ ?>
		<div class="card_container record-full transparent no-margin no-shadow hidden-content-container fadeInUp animated" id="card_container" style="float:none;">
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
		</div>

	</div>
	
        