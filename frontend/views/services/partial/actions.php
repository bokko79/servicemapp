<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;

?>
<div class="card_container record-full transparent no-shadow fadeInUp animated" id="card_container" style="">
    <div class="primary-context overflow-hidden">
        <div class="avatar">
            <i class="fa fa-flag-o"></i>
        </div>
        <div class="title">
            <div class="head grand"><?= c($action->tName) ?></div>
            <div class="subhead"><?= count($action->services) ?></div>      
        </div>          
    </div>
    <div class="secondary-context avatar-padded cont col-md-6">
        <p>Stan označava dio neke građevine koji služi za, u pravilu trajni, smještaj odnosno stanovanje pojedinca, porodice ili grupe osoba. Zgrada koja se većim dijelom sastoji od zasebnih stanova se naziva stambena zgrada.</p>
    </div>
</div>
<?php
/* items */
$acts = [
        'label'=>'<i class="fa fa-dot-circle-o"></i> Usluge',
        'content'=>$this->render('//services/queryResults/_actionResults.php', ['action'=>$action])
    ];
$acts_i = [
        'label'=>'<i class="fa fa-tag"></i> ' . $action->tName . ' info',
        'content'=> 'Vrste/modeli predmeta:',
    ];
$items_act = [ $acts, $acts_i ];
?>
     <?= TabsX::widget([
                'items' => $items_act,
                'position'=>TabsX::POS_ABOVE,
                'encodeLabels'=>false,
                'containerOptions' => ['class'=>'tab_track']
            ]) ?>

    