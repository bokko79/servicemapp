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
$spec = ['label'=>''];
$issues = ['label'=>''];
if($model->methods){
	$contentM = '<table class="table table-condensed" style="margin:10px 0">';
	foreach($model->methods as $presenation_method){
		if($mthd_models = $presenation_method->models or $presenation_method->value){
			$contentM .= '<tr>';
			$contentM .= '<td style="width:30%; vertical-align:top; color:#999">'.c($presenation_method->method->property->tName).'</td><td>';
			if($mthd_models){	
				$contentM .= '<ul class="column2">';								
					foreach($mthd_models as $mthd_model){
						$contentM .= '<li><b><i class="fa fa-check"></i> '.c($mthd_model->model->tName).'</b></li>';										
					}			
				$contentM .= '</ul>';			
			} else if($presenation_method->value){				
				$contentM .= '<b>'.($presenation_method->value_operator=='exact' ? null : $presenation_method->value_operator).' ' .$presenation_method->value . ($presenation_method->method->property->unit ? ' '.$presenation_method->method->property->unit->oznaka : null). '</b>';			
			}
			$contentM .= '</td></tr>';
		}
	}
	$contentM .= '</table>';
	$action = [
        'label'=>'<i class="fa fa-th"></i> '.c($model->pService->action->tName),
        'content'=>$contentM,
    ];
}

if($model->specs){
	$content = '<table class="table table-condensed" style="margin:10px 0">';
	foreach($model->specs as $presenation_spec){
		if($spcf_models = $presenation_spec->models or $presenation_spec->value){
			$content .= '<tr>';
			$content .= '<td style="width:30%; vertical-align:top; color:#777">'.c($presenation_spec->spec->property->tName).'</td><td>';
			if($spcf_models){	
				$content .= '<ul class="column2">';								
					foreach($spcf_models as $spcf_model){
						$content .= '<li><b><i class="fa fa-check"></i> '.c($spcf_model->model->tName).'</b></li>';										
					}			
				$content .= '</ul>';			
			} else if($presenation_spec->value){				
				$content .= '<b>'.($presenation_spec->value_operator=='exact' ? null : $presenation_spec->value_operator).' ' .$presenation_spec->value . ($presenation_spec->spec->property->unit ? ' '.$presenation_spec->spec->property->unit->oznaka : null). '</b>';			
			}
			$content .= '</td></tr>';
		}			
	}
	$content .= '</table>';
	$spec = [
        'label'=>'<i class="fa fa-cube"></i> Karakteristike '.$model->object->tNameGen,
        'content'=>$content,
    ];
}

if($model->issues){
	$contentIssue = '<table class="table table-condensed" style="margin:10px 0">';
	foreach($model->issues as $presenation_issue){
		$contentIssue .= '<tr>';		
		$contentIssue .= '<td><b>'.$presenation_issue->issue->tName. '</b>';			
		$contentIssue .= '</td></tr>';			
	}
	$content .= '</table>';
	$issues = [
        'label'=>'<i class="fa fa-stethoscope"></i> Apartman: Problemi',
        'content'=>$contentIssue,
    ];
}
	
$items = [    
    $spec,
    $action,
    $issues
];

$map = $model->location->map(400, 420, $model->coverage_within);

// Add marker to the map
$map->appendScript("google.maps.event.addDomListener(mapShowTrigger, 'click', function() {
        $(this).closest('.hidden-content-container').find('div.hidden-content').toggleClass('hidden');
        initialize();
	});");
$text_appear = ($imgs = $model->images) ? 'text-shadow white' : null;

// title
// subtitle, generated title, object model+ part, action method
// service
// industry, category, color, icon
// id, status, type
// share
// provider name, username, provider locationHQ, verifications, ratings, score, reviews, recommends++
// message provider
// time availability of provider, online status
// availability
// price, price_per, price unit, per consumer, fixed, constraint quantity, constraint consumers
// validity, valid from, valid through++
// description++
// min consumers, max consumers++
// min quantity, max quantity++
// quick order form
// map++
// locationHQ++
// coverage, coverage_within++
// location from++
// location to++
// pics, cover pic++
// pdf++
// youtube++
// action methods
// duration, unit, operator++
// object specs ++
// issues++
// skills
// object_models
// timetable / opening hours
// terms
// controls: order, follow, update, delete, quick order, message provider, share, promote
?>
	
<div class="grid-profile-leftacross" style="padding: 0;position: relative; z-index: 101;">
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
            	<?php if($model->user->id==Yii::$app->user->id): ?>
                <?= Html::a('<i class="fa fa-cog"></i> Uredi', Url::to('/presentation-setup/'.$model->id), ['class'=>'btn btn-default btn-sm']) ?>
            	<?php else: ?>
            		<?= Html::a('<i class="fa fa-envelope-o"></i> Pošalji poruku', Url::to(), ['class'=>'btn btn-default btn-sm']) ?>
            	<?php endif; ?>
            </div>	           
		</div>
	</div>
	<div class="card_container record-full no-shadow bordered fadeInUp animated" id="card_container" style="float:none;border-top:none !important;">				        
        <?php // price ?>
        <div class="primary-context overflow-hidden">
        	<div class="avatar gray-color">
                <i class="fa fa-tag fa-3x"></i>
            </div>
            <div class="title">
                <div class="head grand black">
                	<?= Yii::$app->formatter->asCurrency($model->price, $model->currency->code, [\NumberFormatter::MIN_FRACTION_DIGITS => 2]) . ($model->price_operator=='total' ? null : '<span style="font-size:50%;">/'.$model->pService->unit->oznaka).'</span>' ?></div>
                <div class="subhead">                	
                	<?= $model->consumer_price ? 'Cena po osobi | ' : 'Ukupna cena | ' ?><?= $model->fixed_price ? 'Fiksna cena' : 'Cena podložna promeni na upit' ?>
                </div> 
            </div>
            <div class="subaction">
                <?= $model->validityStatus() ?>
            </div>	           
		</div>				        
        <?php // action ?>
        <div class="secondary-context avatar-padded">  
        	<?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Naruči uslugu'), Url::to(['/add/'.slug($model->pService->tName), 'Presentations[id]'=>$model->id]), ['class'=>'btn btn-danger']); ?>            	
        	<div class="subaction">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Prati prezentaciju'), Url::to(), ['class'=>'btn btn-link']); ?>
            </div>
        </div>
	<?php if($model->pService->service_object==1 and $model->pService->location==5): ?>
		<div class="secondary-context avatar-padded">
			<?= $this->render('quick-direct-order.php', ['presentation'=>$model]) ?>
		</div>		
	<?php endif; ?>
	</div>

    <div class="card_container record-full no-shadow transparent fadeInUp animated" id="card_container" style="float:none;border-top:none !important;">
        <?php /* service */ ?>
        <div class="secondary-context border-bottom">
        	<div class="head lower regular">Opis ponude</div>
        	<?= $model->description ?>                
        </div>
        <?php if($model->methods): ?>
        <div class="secondary-context border-bottom">
        	<div class="head lower regular">Opcije usluge</div>
        	<?= $contentM ?>
        <?php /*
        	echo TabsX::widget([
			    'items'=>$items,
			    'position'=>TabsX::POS_ABOVE,
			    'encodeLabels'=>false,
			    'containerOptions' => ['class'=>'tab_track']
			]); */ ?>			                
        </div>
        <?php endif; ?>
        <?php if($model->specs): ?>
        <div class="secondary-context border-bottom">
        	<div class="head lower regular">Karakteristike <?= $model->object->tNameGen ?></div>
        	<?= $content ?>			                
        </div>
        <?php endif; ?>
        <?php if($model->issues): ?>
        <div class="secondary-context border-bottom">
        	<div class="head lower regular">Problemi/kvarovi koje rešavamo/otklanjamo</div>
        	<?= $contentIssue ?>			                
        </div>
    	<?php endif; ?>
        <div class="secondary-context">
        	Lokacija: <?= ($model->location) ? $model->location->streetLocation : null ?><br>
        	Lokacija do: <?= ($model->locationTo) ? $model->locationTo->streetLocation : null ?><br>
        	Pokrivenost: <?= ($model->coverage) ? $model->coverage : null ?><br>
        	Pokrivenost od sedišta u krugu od: <?= ($model->coverage_within) ? $model->coverage_within.'km' : null ?><br>
        	Uobičajeno trajanje izvršenja usluge: <?= ($model->duration) ? $model->duration_operator.' '.$model->duration.$model->duration_unit : null ?><br>
        	Minimalan broj korisnika: <?= ($model->consumer_min) ? $model->consumer_min.' osoba' : null ?><br>
        	Makrimalan broj korisnika: <?= ($model->consumer_max) ? $model->consumer_max.' osoba' : null ?><br>
        	Minimalna količina porudžbine: <?= ($model->quantity_min) ? $model->quantity_min.' '.$model->price_unit->unit->oznaka : null ?><br>
        	Maksimalna količina porudžbine: <?= ($model->quantity_max) ? $model->quantity_max.' '.$model->price_unit->unit->oznaka : null ?><br>	                
        </div>
	</div>
	
</div>
<div class="media-area grid-profile-right">
<?php if($model->youtube_link!=''): ?>
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
    	
    	<?php  $user = \frontend\models\User::findOne(Yii::$app->user->id); ?>
    	<?php //print_r($user); die();  ?>
    	<?php /* Rastojanje od vas <?= $model->loc->distanceTo($user->location) ?>km */ ?>
    </div>
    <div class="card_container record-full  no-shadow no-margin fadeInUp animated" id="card_container" style="float:none;">				        
        <?php // title ?>
        <div class="media-context">  
        	<?= $map->display() ?>
        </div> 	    
        <?php // provider ?>
        <div class="header-context">	        	
        	<div class="avatar round">
                <?= $model->user->avatar() ?>          
            </div>
            <div class="title">
                <div class="head major"><?= $model->user->name ?><span class="fs_12 thin margin-left-10"><?= $model->user->provider->location->cityLocation ?></span></div>
                <div class="subhead"><?= $model->user->quickVerificationPack() . ' | ' .  $model->user->starRating(3.7) . ' 3.7 | ' . $model->user->provider->quickCounts ?></div> 
            </div>
            <div class="subaction">
                status/validity    
            </div>	           
		</div>
	</div>
</div>
	
        