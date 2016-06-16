<?php

use yii\helpers\Html;
use kartik\widgets\ActiveField;
use yii\helpers\ArrayHelper;
use kartik\builder\Form;

$property = $industry->skills->property;
$model_list = ArrayHelper::map($property->models, 'id', 'tNameWithHint');

$message = 'Za obavljanje pojedinih usluga, pružalac usluge bi trebalo da poseduje neophodan pribor, određeno stručno znanje i veštine ili neke druge osobine, karakteristične za usluge koje obavlja.';
?>
<div class="wrapper headline" style="">
    <label class="head">
        <span class="badge">1</span>&nbsp;
        <i class="fa fa-industry fa-lg"></i>&nbsp;
        <?php echo Yii::t('app', 'Zahtevate određenu vrstu {industry}?', ['industry'=>$industry->tNameGen]); ?>
    </label>
    <?= ' <span class="optional">(opciono)</span>' ?>
    <i class="fa fa-chevron-right chevron"></i>
</div>

<div class="wrapper notshown body fadeIn animated" style="border-top:none;">
<?= $this->render('../_hint.php', ['message'=>$message]) ?>

<?php foreach($model_skills as $model_skill) {
        $skill = $model_skill->serviceSkill;
        $property = $model_skill->property;
        $serviceSkill = $skill->serviceSkill($service->id);
        echo ($serviceSkill and $serviceSkill->readOnly==0) ? $this->render('skills/'.$property->formType($object_ownership).'.php', ['form'=>$form, 'key'=>$property->id, 'model_skill'=>$model_skill, 'skill'=>$skill, 'property'=>$property, 'service'=>$service]) : null;
    } ?>  
</div>