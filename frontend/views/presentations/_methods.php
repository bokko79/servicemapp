<?php
use yii\helpers\Html;
use yii\helpers\Url;

if($methods){	
	echo '<label class="control-label col-md-3" for="presentations-provider_presentation_methods">Opcije usluge</label>';
	echo '<div class="col-sm-9 margin-bottom-20"><table class="table table-condensed table-striped">';
	foreach($methods as $method){
		echo '<tr>';
		if($method_models = $method->models){
			echo '<td style="width:30%; vertical-align:top;">'.c($method->method->property->tName).'</td><td>';
			foreach($method_models as $method_model){
				echo '<b>'.c($method_model->model->tName).'</b><br>';
			}
			echo '</td>';
		} else {
			echo '<td style="width:30%;">'.c($method->method->property->tName). '</td><td><b>'.$method->value_operator.' ' .$method->value .' ' . (($method->method->property->unit) ? $method->method->property->unit->oznaka : null). '</b></td>';
		}
		echo '</tr>';		
	}
	echo '</table></div>';
} ?>