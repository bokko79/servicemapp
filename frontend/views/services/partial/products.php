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
            <?= Html::img('@web/images/objects/car_logo_PNG16'.rand(67,67).'.png', ['style'=>'']) ?>
        </div>
        <div class="title">
            <div class="head grand"><?= c($product->name) ?><?= '<span class="head third thin muted margin-left-5">['.c($object->tName).']</span>' ?></div>
            <div class="subhead"><?= c($object->tName) ?> <i class="fa fa-caret-right"></i> <?= c($object->oType->tName) ?></div>
        </div>          
    </div>
    <div class="secondary-context avatar-padded cont col-md-6">
        <p>Stan označava dio neke građevine koji služi za, u pravilu trajni, smještaj odnosno stanovanje pojedinca, porodice ili grupe osoba. Zgrada koja se većim dijelom sastoji od zasebnih stanova se naziva stambena zgrada.</p>
    </div>
</div>
<?php
    $prod = [
            'label'=>'<i class="fa fa-dot-circle-o"></i> Usluge',
            'content'=>$this->render('//services/queryResults/_productResults.php', ['product'=>$product, 'object'=>$product->object])
        ];
    $prod_i = [
            'label'=>'<i class="fa fa-tag"></i> '.$product->name.' info',
            'content'=> '<p>Stan označava dio neke građevine koji služi za, u pravilu trajni, smještaj odnosno stanovanje pojedinca, porodice ili grupe osoba. Zgrada koja se većim dijelom sastoji od zasebnih stanova se naziva stambena zgrada.</p>',
        ];
    $prod_properties = [
            'label'=>'<i class="fa fa-tag"></i> Svojstva i karakteristike',
            'content'=> $this->render('//services/properties/products.php', ['product'=>$product, 'properties'=>$product->getProperties($product)]),
        ];
    $prod_parts = [
            'label'=>'<i class="fa fa-tag"></i> Delovi/celine',
            'content'=> 'Vrste izdavanja:',
        ];
    $items_prod = [ $prod, $prod_i, $prod_properties, $prod_parts ]; ?>
         <?= TabsX::widget([
                    'items' => $items_prod,
                    'position'=>TabsX::POS_ABOVE,
                    'encodeLabels'=>false,
                    'containerOptions' => ['class'=>'tab_track']
                ]) ?>