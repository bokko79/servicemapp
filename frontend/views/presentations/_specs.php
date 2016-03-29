<?php
use yii\helpers\Html;
use yii\helpers\Url;

if($specs){
	echo '<label class="control-label col-md-3" for="presentations-provider_presentation_specs">Izabrane karakteristike</label>';
	echo '<div class="col-sm-9 margin-bottom-20"><table class="table table-condensed table-striped">';
	foreach($specs as $spec){
		echo '<tr>';
		if($spcf_models = $spec->models){
			echo '<td style="width:30%; vertical-align:top;">'.c($spec->spec->property->tName).'</td><td>';
			foreach($spcf_models as $spcf_model){
				echo '<b>'.c($spcf_model->model->tName).'</b><br>';
			}
			echo '</td>';
		} else {
			echo '<td style="width:30%;">'.c($spec->spec->property->tName). '</td><td><b>'.$spec->value_operator.' ' .$spec->value .' ' . (($spec->spec->property->unit) ? $spec->spec->property->unit->oznaka : null). '</b></td>';
		}
		echo '</tr>';		
	}
	echo '</table></div>';
} ?>