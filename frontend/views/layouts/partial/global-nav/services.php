<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\models\CsSectors;
?>
<span class="turn_off_glob" onclick="close_category();"><i class="fa fa-times"></i></span>
			
<div class="cart">
	<div class="industry_6box_head"></div>	

	<div class="industry_6box_container">
		<div class="industry_6box row-fluid"></div>	
	</div>

	<?php foreach (CsSectors::find()->all() as $key=>$sek) { ?>
		<div class="row-fluid subindustry<?php echo $key+1; ?>"></div>
	<?php } ?>

	<div class="subindustry0"></div>
</div>
