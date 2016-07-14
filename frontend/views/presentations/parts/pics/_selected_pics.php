<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php if($images = $model->files){
	echo '<label class="control-label col-md-3" for="presentations-imagefiles">Izabrane slike</label>';
	echo '<div class="col-sm-9 margin-bottom-20">';
	foreach($medias = $model->files as $media){
        if($media->file->type!='pdf'){
            $image = Html::img('@web/images/presentations/thumbs/'.$media->file->ime);
            echo Html::a($image, Url::to(), [
                'class' => 'margin-bottom-10 margin-right-10',
                'data-toggle'=>'modal', 'data-backdrop'=>false,  'data-target'=>'#file-delete'.$media->id
            ]);
        }    			
	}
	echo '</div>';
} ?>
<?php if($pdfs = $model->pdfs){
    echo '<label class="control-label col-md-3" for="presentations-imagefiles">Prikačene PDF datoteke</label>';
    echo '<div class="col-sm-9 margin-bottom-20">';
    foreach($pdfs = $model->files as $pdf){
        if($pdf->file->type=='pdf'){
            echo '<embed src="../images/presentations/docs/'.$pdf->file->ime.'" width="105" height="149px">';
            echo '<a href="#" data-toggle="modal" data-backdrop="false" data-target="#file-delete'.$pdf->id.'"><i class="fa fa-times"></i></a>';
        }
    }
    echo '</div>';
} ?>