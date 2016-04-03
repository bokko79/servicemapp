<?php
use yii\helpers\Html;
if(Yii::$app->controller->action->id=='update'): ?>
	<div class="right overflow-hidden" style="margin:20px 20px 0;">
        <?= Html::submitButton(Yii::t('app', '<i class="fa fa-save"></i> Sačuvaj izmene'), ['class' => 'btn btn-success shadow form-presentation', 'style'=>'']) ?>
    </div>
<?php endif; ?>