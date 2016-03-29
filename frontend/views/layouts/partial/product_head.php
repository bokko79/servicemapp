<?php
/* @var $this \yii\web\View */
/* @var $content string */

use frontend\widgets\Tabs;
use frontend\widgets\Stats;
use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\tabs\TabsX;

$action = ['label'=>''];
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
$spec = ['label'=>''];
if($model->specs!=null){
	$content = '<table class="table table-condensed table-striped" style="margin:20px 0">';
	foreach($model->specs as $presenation_spec){
		if($spcf_models = $presenation_spec->models or $presenation_spec->value){
			$content .= '<tr>';
			$content .= '<td style="width:30%; vertical-align:top; color:#999">'.c($presenation_spec->spec->property->tName).'</td><td>';
			if($spcf_models){	
				$content .= '<ul class="column2">';	
								
					foreach($spcf_models as $spcf_model){
						$content .= '<li><b><i class="fa fa-check"></i> '.c($spcf_model->model->tName).'</b></li>';										
					}				
													
				$content .= '</ul>';			
			} else {
				if($presenation_spec->value){
					$content .= '<b>'.($presenation_spec->value_operator=='exact' ? null : $presenation_spec->value_operator).' ' .$presenation_spec->value . ($presenation_spec->spec->property->unit ? ' '.$presenation_spec->spec->property->unit->oznaka : null). '</b>';
				}			
			}
			$content .= '</td>';			
			$content .= '</tr>';
		}			
	}
	$content .= '</table>';
	$spec = [
        'label'=>'<i class="fa fa-cube"></i> Karakteristike '.$model->object->tNameGen,
        'content'=>$content,
    ];
}
$issues = [
        'label'=>'<i class="fa fa-stethoscope"></i> Apartman: Problemi',
        'content'=>'ddd',
    ];
$items = [
    
    $spec,
    $action,
    $issues
];

$map = $model->loc->map(400, 420, $model->coverage_within);

// Add marker to the map
$map->appendScript("google.maps.event.addDomListener(mapShowTrigger, 'click', function() {
        $(this).closest('.hidden-content-container').find('div.hidden-content').toggleClass('hidden');
        initialize();
	});");
$text_appear = ($imgs = $model->images) ? 'text-shadow white' : null;
?>
	
	<div class="grid-profile-leftacross" style="padding: 0;
    position: relative;
    z-index: 101;
    ">
		<div class="card_container record-full <?= $imgs ? 'opaque' : 'transparent' ?> no-shadow no-margin fadeInUp animated" id="card_container" style="float:none;">				        
	        <?php // title ?>
	        <div class="primary-context avatar-padded">  
	        	<div class="head <?= $imgs ? 'grand regular' : 'colos thin' ?> <?= $text_appear ?>"><?= c($model->title) ?></div>
            	<div class="subhead <?= $text_appear ?>"><div class="label" style="background:<?= $model->pService->industry->color ?>"><i class="fa <?= $model->pService->industry->icon ?>"></i> <?= c($model->pService->industry->tName) ?></div> | <?= $model->generatedServiceName() ?></div> 
	        </div> 	    
	        <?php // provider ?>
	        <div class="header-context">	        	
            	<div class="avatar round">
                    <?= $model->user->avatar() ?>          
                </div>
                <div class="title">
                    <div class="head major <?= $text_appear ?>"><?= $model->user->name ?><span class="fs_12 thin <?= $text_appear ?> margin-left-10"><?= $model->user->provider->location->cityLocation ?></span></div>
                    <div class="subhead <?= $text_appear ?>"><?= $model->user->quickVerificationPack() . ' | ' .  $model->user->starRating(3.7) . ' 3.7 | ' . $model->user->provider->quickCounts ?></div> 
                </div>
                <div class="subaction">
                    status/validity    
                </div>	           
			</div>
		</div>
		<div class="card_container record-full no-shadow bordered fadeInUp animated" id="card_container" style="float:none;border-top:none !important;">				        
	        <?php // price ?>
	        <div class="primary-context overflow-hidden">	        	
            	<div class="avatar gray-color">
                    <i class="fa fa-credit-card fa-3x"></i>
                </div>
                <div class="title">
                    <div class="head grand black">
                    	<?= Yii::$app->formatter->asCurrency($model->price, $model->currency->code) . ($model->price_operator=='total' ? null : '<span style="font-size:50%;">/'.$model->pService->unit->oznaka).'</span>' ?></div>
                    <div class="subhead grand">
                    	<?= $model->consumer_price ? 'Cena po osobi | ' : 'Ukupna cena | ' ?>
                    	<?= $model->fixed_price ? 'Fiksna cena' : 'Cena podložna promeni na upit' ?></div> 
                </div>
                <div class="subaction">
                    Dostupno: <b>od <?= Yii::$app->formatter->asDate($model->valid_from) ?> - <?= Yii::$app->formatter->asDate($model->valid_through) ?></b>
                </div>	           
			</div>				        
	        <?php // action ?>
	        <div class="secondary-context avatar-padded">  
	        	<?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Naruči uslugu'), Url::to(), ['class'=>'btn btn-danger']); ?>            	
            	<div class="subaction">
                    <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Prati prezentaciju'), Url::to(), ['class'=>'btn btn-link']); ?>
                </div>
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
				    'containerOptions' => ['class'=>'tab_track']
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
	<div class="media-area grid-profile-right">		
	<?php if($model->youtube_link): ?>
		<div class="margin-bottom-20">
	  		<?= \cics\widgets\VideoEmbed::widget(['url' => $model->youtube_link, 'show_errors' => true]); ?>
	  	</div>
	<?php endif; ?>
	<?php if($model->pdfs): ?>
		<div class="margin-bottom-20">
	  		<embed src="../images/presentations/docs/<?= $model->pdfs[0]->ime ?>" width="100%" height="420px">
	  	</div>
	<?php endif; ?>
	<?php if($model->images): ?>
		<div class="media">
		<?= $model->photos() ?>	    	
	    </div>
	<?php endif; ?>
		<div class="maps margin-top-20 margin-bottom-20">
	    	<?= $map->display() ?>
	    	<?php  $user = \frontend\models\User::findOne(Yii::$app->user->id); ?>
	    	<?php //print_r($user); die();  ?>
	    	<?php /* Rastojanje od vas <?= $model->loc->distanceTo($user->location) ?>km */ ?>
	    </div>
	</div>
	
        