<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;

?>
<div class="card_container record-full transparent no-shadow no-margin fadeInUp animated" id="card_container" style="">
    <div class="primary-context overflow-hidden">
        <div class="avatar">
            <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg', ['style'=>'']) ?>
        </div>
        <div class="title">
            <div class="head grand"><?= c($object->tName) ?> <?= ($object->parent) ? '<span class="head major thin">['.c($object->parent->tName).']</span>' : null ?></div>
            <div class="subhead"><?= c($object->oType->tName) ?></div>
        </div>          
    </div>
    <div class="secondary-context avatar-padded cont col-md-6">
        <p>Stan označava dio neke građevine koji služi za, u pravilu trajni, smještaj odnosno stanovanje pojedinca, porodice ili grupe osoba. Zgrada koja se većim dijelom sastoji od zasebnih stanova se naziva stambena zgrada.</p>
    </div>
</div>
    <?php
    $objs = [
            'label'=>'<i class="fa fa-dot-circle-o"></i> Usluge',
            'content'=>$this->render('//services/queryResults/_objectResults.php', ['object'=>$object])
        ];
    $objs_info = [
            'label'=>'<i class="fa fa-tag"></i> '.$object->tName.' info',
            'content'=> 'Vrste izdavanja:',
        ];
    $objs_properties = [
            'label'=>'<i class="fa fa-tag"></i> Svojstva i karakteristike',
            'content'=> 'Vrste izdavanja:',
        ];
    $objs_models = [
            'label'=>'<i class="fa fa-tag"></i> Vrste',
            'content'=> 'Vrste izdavanja:',
        ];
    $objs_parts = [
            'label'=>'<i class="fa fa-tag"></i> Delovi/celine',
            'content'=> 'Vrste izdavanja:',
        ];
    $items_obj = [ $objs, $objs_info, $objs_properties, $objs_models, $objs_parts ]; ?>
         <?= TabsX::widget([
                    'items' => $items_obj,
                    'position'=>TabsX::POS_ABOVE,
                    'encodeLabels'=>false,
                    'containerOptions' => ['class'=>'tab_track']
                ]) ?>
    