<?php
use yii\helpers\Html;
use yii\helpers\Url;

if($medias){
	echo '<label class="control-label col-md-3" for="presentations-imagefiles">Izabrane slike</label>';
	echo '<div class="col-sm-9 margin-bottom-20">';
	foreach($medias as $media){
		echo Html::img('@web/images/presentations/thumbs/'.$media->file->ime, ['class' => 'margin-bottom-10 margin-right-10']);
	}
	echo '</div>';
} ?>