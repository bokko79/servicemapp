<?php
use yii\helpers\Html;
use yii\helpers\Url;

$daysOfWeekFull = [1=>'Ponedeljak', 2=>'Utorak', 3=>'Sreda', 4=>'Četvrtak', 5=>'Petak', 6=>'Subota', 7=>'Nedelja'];
?>
<table class="table table-striped">
 <?php foreach($provider_openingHours as $key=>$provider_openingHour): ?>
    <tr>
        <td><?= $provider_openingHour->day_of_week ?></td>
        <td><?= $provider_openingHour->open ?></td>
        <td><?= $provider_openingHour->closed ?></td>
    </tr> 
<?php endforeach; ?>    
</table>
<?= Html::a('<i class="fa fa-wrench"></i> Podesi', null, ['class'=>'btn btn-warning shadow']) ?>
