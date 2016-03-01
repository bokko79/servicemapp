<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\Orders */
use yii\helpers\Html;
use yii\helpers\Url;
use frontend\widgets\Tabs;
use frontend\widgets\Stats;

$service = $model->orderServices[0]->service;
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
			<div class="grid-leftacross">
				<div class=" fs_11 col-md-6"><div class="label label-primary" style=""><i class="fa fa-bookmark"></i></div> <span class="muted">Aukcijska porudžbina: <?= ' #'. sprintf("%'07d\n", $model->id) ?></span></div>
            	<div class="col-md-6 right muted"><i class="fa fa-clock-o"></i> <?= \yii\timeago\TimeAgo::widget(['timestamp' => $model->activity->time]); ?></div>
            	<div class="summary-head col-md-12" style="">
            		
	    			<div class="float-left">
	    			<?php 
	    				foreach($model->orderServices as $oService){
	    					echo '<h1 style=" margin: 0; font-size:32px; font-weight:300; color:#444">';
	    					//echo c($oService->service->action->tName). ' ';
	    					//echo ($oService->methods) ? $oService->methods[0] : ; // method
	    					//echo $oService->service->object->tNameGen;
	    					// object_model
	    					echo '<a href="#service-details">';
	    					echo 'Izdavanje';
	    					echo ' apartmana';
	    					echo ($oService->methods) ? '<div class="label label-success fs_13 center margin-left-10" style="background:#ddd; color:#777;">'.$oService->methods[0]->propertyModel->tName.'</div>' : null;
	    					echo '</a>';
	    					echo '</h1>';	    					
	    				}
	    			?>
	    			</div>
	    			
            	</div>
	    			
				<div class="summary-data col-md-12">
					<div class="label label-success fs_13 center float-left" style="background:<?= $model->industry->color ?>; letter-spacing:1px; font-weight:400"><i class="fa <?= $model->industry->icon ?>"></i> <?= c($model->industry->tName) ?></div>
						<?php // amount ?>
						<?php if($model->orderServices[0]->amount!=null): ?>
						<div class="col-md-2">
							<table>
								<tr><td class="icon"><i class="fa fa-signal fa-rotate-270 fa-lg"></i></td></tr>
								<tr><td class="data"><?= $model->orderServices[0]->amount ?> <?= $service->unit->oznaka ?></td></tr>
							</table>
						</div>
						<?php endif; ?>
						<?php // consumer ?>
						<?php if($model->orderServices[0]->consumer!=null): ?>
						<div class="col-md-3">
							<table>
								<tr><td class="icon"><i class="fa fa-user fa-2x"></i></td></tr>
								<tr><td class="data"><?= $model->orderServices[0]->consumer ?> osobe</td></tr>
							</table>
						</div>
						<?php endif; ?>
						<?php // location ?>
						<?php if($model->loc!=null): ?>
						<div class="col-md-2">
							<table>
								<tr><td class="icon"><i class="fa fa-map-marker fa-2x"></i> Lokacija</td></tr>
								<tr><td class="data"><?= $model->loc->city ?></td></tr>
							</table>
						</div>
						<?php endif; ?>
						<?php // time ?>
						<?php if($model->delivery_starts!=null): ?>
						<div class="col-md-2">
							<table>
								<tr><td class="icon"><i class="fa fa-calendar fa-2x"></i></td></tr>
								<tr><td class="data"><?= f_date_short($model->delivery_starts) ?></td></tr>
							</table>
						</div>
						<?php endif; ?> 
						<?php // budžet ?>
						<?php if($model->budget!=null): ?>
						<div class="col-md-2">
							<table>
								<tr><td class="icon"><i class="fa fa-money fa-2x"></i></td></tr>
								<tr><td class="data"><?= $model->budget_operator. ' ' .Yii::$app->formatter->asCurrency($model->budget, $model->currency->code) ?></td></tr>
							</table>
						</div>
						<?php endif; ?>   						
					
				</div>
			</div>
			<div class="grid-right media_right_sidebar">
				 				
				<?php // CONTROLS/STATUS/VALIDITY ?>
				<div class="controls-box" style="">
					<table>
						<tr><td class="icon"><i class="fa fa-refresh fa-spin"></i> AKTIVNO</td></tr>
						<tr><td class="cntd muted"><?php $valid = \russ666\widgets\Countdown::widget([
				                    'datetime' => $model->validity,
				                    'format' => '%d<span class=\"fs_11\">d</span> %H<span class=\"fs_11\">h</span> %M<span class=\"fs_11\">m</span> %S<span class=\"fs_11\">s</span>',
				                    'events' => [
				                        //'finish' => 'function(){location.reload()}',
				                    ],
				                ]); ?>
				                <?= $valid ?></td></tr>
					</table>
				 
					
                
				</div>
				<?= Html::a('<i class="fa fa-sticky-note"></i>&nbsp;'.Yii::t('app', 'Pošalji ponudu'), Url::to(), ['class'=>'btn btn-primary butn btn-lg']); ?>
				<?= Html::a('<i class="fa fa-bookmark"></i>&nbsp;'.Yii::t('app', 'Obeleži porudžbinu'), Url::to(), ['class'=>'btn btn-default butn']); ?>
				
			</div>  
        </div>
    </div>
