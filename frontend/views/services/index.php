<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use yii\widgets\ListView;
use kartik\tabs\TabsX;

$this->title = Yii::t('app', 'Index usluga');
$this->params['breadcrumbs'][] = $this->title;
$this->params['renderIndex'] = $renderIndex;
$this->params['industry'] = $industry;
$this->params['object'] = $object;
$this->params['action'] = $action;

$this->cardData = [
    'pic' => ($industry) ? 'industries/'.$industry->id : null, 
];

$this->profileTitle = [
    'icon'          => ($industry) ? $industry->icon : null,
    'title'         => ($industry) ? Yii::$app->operator->sentenceCase($industry->tName) : null, 
    'description'   => ($industry) ? $industry->t[0]->description : null,
];

$this->stats = [
    ['title'=>'Porudžbine', 'value'=>163, 'sub'=>95, 'perc'=>'--'],
    ['title'=>'Provajderi', 'value'=>42, 'sub'=>'--', 'perc'=>'--'],
    ['title'=>'Promocije', 'value'=>17, 'sub'=>'--', 'perc'=>'--'],
];

/* items */
$s = $dataProvider->getTotalCount()>0 ? [
        'label'=>'<i class="fa fa-dot-circle-o"></i> Usluge ('.$dataProvider->getTotalCount().')',
        'content'=>'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:40px;">'.
        ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_card',
            'summary' => '',
        ]) .
        '</div>'] : ['label'=>''];
$i = $queryIndustries ? [
        'label'=>'<i class="fa fa-tag"></i> Delatnosti ('.count($queryIndustries).')',
        'content'=>($queryIndustries) ? $this->render('//services/queryResults/_queryIndustries.php', ['queryIndustries'=>$queryIndustries]) : null,
        'active'=> $dataProvider->getTotalCount()==0 ? true : false,
    ] : ['label'=>''];
$a = $queryActions ? [
        'label'=>'<i class="fa fa-flag"></i> Akcije ('.count($queryActions).')',
        'content'=>($queryActions) ? $this->render('//services/queryResults/_queryActions.php', ['queryActions'=>$queryActions]) : null,
        'active'=> $dataProvider->getTotalCount()==0 and !$queryIndustries ? true : false,
    ] : ['label'=>''];
$o = $queryObjects ? [
        'label'=>'<i class="fa fa-cube"></i> Predmeti usluga ('.count($queryObjects).')',
        'content'=>($queryObjects) ? $this->render('//services/queryResults/_queryObjects.php', ['queryObjects'=>$queryObjects]) : null,
        'active'=> $dataProvider->getTotalCount()==0 and !$queryIndustries and !$queryActions ? true : false,
    ] : ['label'=>''];
$items = [ $s, $i, $a, $o ];

if(!$industry):
    echo $this->render('//services/_searchHead.php', ['searchString'=>$searchString, 'dataProvider'=>$dataProvider, 'queryIndustries'=>$queryIndustries, 'queryActions'=>$queryActions, 'queryObjects'=>$queryObjects, 'object'=>$object, 'action'=>$action]) ?>
<?php if($searchString!=null): ?>
 <?= TabsX::widget([
                'items' => $items,
                'position'=>TabsX::POS_ABOVE,
                'encodeLabels'=>false,
                'containerOptions' => ['class'=>'tab_track']
            ]) ?>

<?php endif; ?>
<?php if($object): 
$objs = [
        'label'=>'<i class="fa fa-dot-circle-o"></i> Usluge',
        'content'=>$this->render('//services/queryResults/_objectResults.php', ['object'=>$object])
    ];
$objs_i = [
        'label'=>'<i class="fa fa-tag"></i> '.$object->tName.' info',
        'content'=> 'Vrste izdavanja:',
    ];
$items_obj = [ $objs, $objs_i ]; ?>
     <?= TabsX::widget([
                'items' => $items_obj,
                'position'=>TabsX::POS_ABOVE,
                'encodeLabels'=>false,
                'containerOptions' => ['class'=>'tab_track']
            ]) ?>
<?php endif; ?>
<?php if($action): 
/* items */
$acts = [
        'label'=>'<i class="fa fa-dot-circle-o"></i> Usluge',
        'content'=>$this->render('//services/queryResults/_actionResults.php', ['action'=>$action])
    ];
$acts_i = [
        'label'=>'<i class="fa fa-tag"></i> '.$action->tName.' info',
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
<?php endif; ?>
<?php else: ?>
<div class="grid js-masonry overflow-hidden" data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }' style="margin-top:40px;">
    <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_card',
            'summary' => '',
        ]) ?>
</div>
<?php endif; ?>