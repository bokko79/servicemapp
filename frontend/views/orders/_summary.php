<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Tabs;
use frontend\widgets\Stats;

$service = $model->orderServices[0]->service;
$valid = \russ666\widgets\Countdown::widget([
    'datetime' => $model->validity,
    'format' => '%d<span class=\"fs_11\">d</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> %S<span class=\"fs_11\">s</span>',
    'events' => [
        //'finish' => 'function(){location.reload()}',
    ],
]);
/*
?>
<div class="product-head" style="background:;">
	<?php if($model->orderServices[0]->images): ?>
    <div class="media-area">
    	<?php foreach ($model->orderServices[0]->images as $media):
    		$items[] = [
    			'img' => '../images/user_objects/'.$media->image->ime,
    			//'full' => '../images/user_objects/'.$media->image->ime,
    			'fit' => 'cover',
    		]; ?>
        <?php endforeach; ?>
    <?= \metalguardian\fotorama\Fotorama::widget(
            [
                'options' => [
                    'loop' => true,
                    'hash' => true,
                    'allowfullscreen' => 'native',
                    'width' => '100%',
                    'height' => '360',
                    'maxheight' => '100%',
                    'minwidth'=> '1380',
                    'ratio' => 1920/360,
                    'nav' => false,
                    'fit' => 'none',
                ],
                'items' => $items,
                //'tagName' => 'span',
                'useHtmlData' => false,
                'htmlOptions' => [
                    'style'=>'text-align:center; margin:0 auto;',
                    'class'=>'full-width-cover'
                ],
            ]
        ) ?>        
    </div>

    <?php endif; ?>
</div>	*/ ?>
    <div class="grid-container" style="padding-top: 20px; padding-bottom: 10px; margin-top:50px;">
        <div class="grid-row">
            <?php /*<div class="grid-left center">	
            	<?= Html::img('@web/images/industries/'.$model->industry->id.'.jpg', ['style'=>'width:100px; height:100px; border-radius:50px;']) ?>	         
				
        

			</div> */ ?>
			<div class="grid-leftacross summary">
				<div class="summary-first row">
					<div class=" fs_11 col-md-6"><div class="label label-primary" style=""><i class="fa fa-bookmark"></i></div> <span class="muted">Aukcijska porudžbina: <?= ' #'. sprintf("%'07d\n", $model->id) ?></span></div>
					<?php // CONTROLS/STATUS/VALIDITY ?>
					<div class="col-md-6 right">
						<div class="label label-success controls-box" style=""><i class="fa fa-refresh fa-spin"></i> Aktivno</div>
						<span class="cntd"><?= $valid ?></span>
					</div>						
				</div>

				<div class="summary-second row">
					<div class="col-md-12">
	            		<a href="#service-industry" class="label label-success fs_13 center float-left" style="background:<?= $model->industry->color ?>; letter-spacing:1px; font-weight:400"><i class="fa <?= $model->industry->icon ?>"></i> <?= c($model->industry->tName) ?></a>
	            		<div class="margin-left-15 muted float-left"><i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->activity->time]); ?></div>
	            	</div>
	            	
				</div>
            		
            	<div class="summary-head row" style="">
            		
	    			
	    			<?php 
	    				foreach($model->orderServices as $key=>$oService){
	    					echo '<div class="col-md-12">';
	    					echo '<h1>';
	    					//echo c($oService->service->action->tName). ' ';
	    					//echo ($oService->methods) ? $oService->methods[0] : ; // method
	    					//echo $oService->service->object->tNameGen;
	    					// object_model
	    					echo '<a href="#service-details'.$key.'">';
	    					echo 'Izdavanje';
	    					echo ' apartmana';
	    					echo ($oService->methods) ? '<div class="label label-success fs_13 center margin-left-10" style="background:#ddd; color:#777;">'.$oService->methods[0]->propertyModel->tName.'</div>' : null;
	    					echo '</a>';
	    					echo '</h1>';
	    					echo ($model->orderServices[0]->amount!=null) ? '<div class="title_details muted"><i class="fa fa-signal fa-rotate-270"></i> '.$model->orderServices[0]->amount.' '.$service->unit->oznaka.'</div>' : null;
	    					echo ($model->orderServices[0]->consumer!=null) ? '<div class="title_details muted"><i class="fa fa-user"></i> za '.$model->orderServices[0]->consumer.' osobe </div>' : null;	
	    					echo ($model->orderServices[0]->consumer_children!=null) ? '<div class="title_details muted"><i class="fa fa-child"></i> +'.$model->orderServices[0]->consumer_children.' dete </div>' : null;
	    					echo '</div>';
	    				}
	    			?>
	    			
	    			
            	</div>
	    			
				<div class="summary-data row">
						<?php // location ?>
						<?php if($model->loc!=null): ?>
						<div class="col-md-2">
							<table>
								<tr><td class="icon"><i class="fa fa-map-marker fa-2x"></i></td>
								<td class="data"><a href="#service-location"><?= $model->loc->city ?></a><br><span class="small muted normal-thin">Lokacija</span></td></tr>
							</table>
						</div>
						<?php endif; ?>
						<?php // time ?>
						<?php if($model->delivery_starts!=null): ?>
						<div class="col-md-3">
							<table>
								<tr>
									<td class="icon"><i class="fa fa-calendar fa-2x"></i></td>
									<td class="data"><a href="#service-time"><?= f_date_short($model->delivery_starts) ?></a><br><span class="small muted normal-thin">Vreme početka izvršenja</span></td>
								</tr>
							</table>
						</div>
						<?php endif; ?>
						<?php // frequency ?>
						<?php if($model->frequency!=null): ?>
						<div class="col-md-2">
							<table>
								<tr>
									<td class="icon"><i class="fa fa-history fa-2x"></i></td>
									<td class="data"><a href="#service-frequency"><?= $model->frequency ?>x <?= $model->frequency_unit ?></a><br><span class="small muted normal-thin">Učestalost</span></td>
								</tr>
							</table>
						</div>
						<?php endif; ?>
						<?php // budžet ?>
						<?php if($model->budget!=null): ?>
						<div class="col-md-3">
							<table>
								<tr>
									<td class="icon"><i class="fa fa-money fa-2x"></i></td>
									<td class="data"><a href="#service-budget"><?= $model->budget_operator. ' ' .Yii::$app->formatter->asCurrency($model->budget, $model->currency->code) ?></a><br><span class="small muted normal-thin">Budžet</span></td>
								</tr>
							</table>
						</div>
						<?php endif; ?>   						
					
				</div>
			</div>
			<div class="grid-right media_right_sidebar">
				<?php // WIDGET: STATS ?>
                <?= Stats::widget([
                    'boxData'=>$this->stats,
                ]); ?>	 				
				
				
				<?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-primary butn btn-lg margin-bottom-20']); ?>
				<div class="btn-group btn-group-sm btn-group-justified" role="group" aria-label="...">
	                <?= Html::a('<i class="fa fa-bookmark"></i>&nbsp;'.Yii::t('app', 'Obeleži'), Url::to(), ['class'=>'btn btn-default']); ?>
	                <?= Html::a('<i class="fa fa-envelope"></i>&nbsp;'.Yii::t('app', 'Poruka'), Url::to(), ['class'=>'btn btn-default ']); ?>
	                <?= Html::a('<i class="fa fa-at"></i>&nbsp;'.Yii::t('app', 'E-mail'), Url::to(), ['class'=>'btn btn-default ']); ?>
	            </div>
				
			</div>  
        </div>
    </div>
