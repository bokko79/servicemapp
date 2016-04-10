<?php
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;

$message = 'Proces.';
?>
<div class="wrapper headline" style="">
    <label class="head">
    	<span class="badge"><?= $model->noProcess ?></span>&nbsp;
        <i class="fa fa-shopping-basket fa-lg"></i>&nbsp;
        <?= Yii::t('app', 'Da li Vam uz {service} treba i...', ['service'=>$service->tNameAkk]) ?>
    </label>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper body fadeIn animated" style="border-top:none;;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>

</div>