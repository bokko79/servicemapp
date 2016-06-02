<?php
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\CsServicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use kartik\tabs\TabsX;

$this->title = Yii::t('app', 'Index usluga');
$this->params['breadcrumbs'][] = $this->title;
$this->params['renderIndex'] = $renderIndex;
$this->params['industry'] = $industry;
$this->params['object'] = $object;
$this->params['product'] = $product;
$this->params['action'] = $action;

$items = [];
/* items */
$s = ($dataProvider and $dataProvider->totalCount>0) ? [
        'label'=>'<i class="fa fa-dot-circle-o"></i> Usluge <b>('.$countServicesResults.')</b>',
        'content'=>//'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:0px;">'.
        ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => Yii::$app->request->get('advanced-view')=='list' ? '_card_list' : '_card',
            'layout' => '{summary}{pager}{items}',
            'summary' => '',
        ])/* .
        '</div>'*/] : null;
$i = ($queryIndustries and $queryIndustries->totalCount>0) ? [
        'label'=>'<i class="fa fa-tag"></i> Delatnosti <b>('.$countIndustriesResults.')</b>',
        //'content'=>($queryIndustries) ? $this->render('//services/queryResults/_queryIndustries.php', ['queryIndustries'=>$queryIndustries]) : null,
        'content'=>//'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:0px;">'.
        ListView::widget([
            'dataProvider' => $queryIndustries,
            'itemView' => Yii::$app->request->get('advanced-view')=='list' ? 'cards/_industryCard' : 'queryResults/_queryIndustries',
            'layout' => '{summary}{pager}{items}',
            'summary' => '',
        ]),// .
        //'</div>',
        'active'=> $dataProvider->totalCount==0 ? true : false,
    ] : null;
$a = ($queryActions and $queryActions->totalCount>0) ? [
        'label'=>'<i class="fa fa-flag"></i> Akcije <b>('.$countActionsResults.')</b>',
        //'content'=>($queryActions) ? $this->render('//services/queryResults/_queryActions.php', ['queryActions'=>$queryActions]) : null,
        'content'=>//'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:0px;">'.
        ListView::widget([
            'dataProvider' => $queryActions,
            'itemView' => Yii::$app->request->get('advanced-view')=='list' ? 'cards/_industryCard' : 'queryResults/_queryActions',
            'layout' => '{summary}{pager}{items}',
            'summary' => '',
        ]),
        'active'=> $dataProvider->totalCount==0 and $queryIndustries->totalCount==0 ? true : false,
    ] : null;
$o = ($queryObjects and $queryObjects->totalCount>0) ? [
        'label'=>'<i class="fa fa-cube"></i> Predmeti usluga <b>('.$countObjectsResults.')</b>',
        //'content'=>($queryObjects) ? $this->render('//services/queryResults/_queryObjects.php', ['queryObjects'=>$queryObjects]) : null,
        'content'=>//'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:0px;">'.
        ListView::widget([
            'dataProvider' => $queryObjects,
            'itemView' => Yii::$app->request->get('advanced-view')=='list' ? 'cards/_industryCard' : 'queryResults/_queryObjects',
            'layout' => '{summary}{pager}{items}',
            'summary' => '',
        ]),
        'active'=> $dataProvider->totalCount==0 and $queryIndustries->totalCount==0 and $queryActions->totalCount==0 ? true : false,
    ] : null;
$p = ($queryProducts and $queryProducts->totalCount>0) ? [
        'label'=>'<i class="fa fa-barcode"></i> Proizvod <b>('.$countProductsResults.')</b>',
        //'content'=>($queryProducts) ? $this->render('//services/queryResults/_queryProducts.php', ['queryProducts'=>$queryProducts]) : null,
        'content'=>//'<div class="grid js-masonry overflow-hidden" data-masonry-options=\'{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 30 }\' style="margin-top:0px;">'.
        ListView::widget([
            'dataProvider' => $queryProducts,
            'itemView' => Yii::$app->request->get('advanced-view')=='list' ? 'cards/_industryCard' : 'queryResults/_queryProducts',
            'layout' => '{summary}{pager}{items}',
            'summary' => '',
        ]),
        'active'=> $dataProvider->totalCount==0 and $queryIndustries->totalCount==0 and $queryActions->totalCount==0 and $queryObjects->totalCount==0 ? true : false,
    ] : null;
//$items = [ $s, $i, $a, $o, $p ];
    if($s) $items[] = $s;
    if($i) $items[] = $i;
    if($a) $items[] = $a;
    if($o) $items[] = $o;
    if($p) $items[] = $p;

if(!$industry):
    if($searchString!=null): ?>
        <?= $this->render('//services/_searchHead.php', ['searchString'=>$searchString, 'countSearchResults'=>$countSearchResults, 'countServicesResults'=>$countServicesResults, 'countIndustriesResults'=>$countIndustriesResults, 'countProductsResults'=>$countProductsResults, 'countActionsResults'=>$countActionsResults, 'countObjectsResults'=>$countObjectsResults, 'object'=>$object, 'product'=>$product, 'action'=>$action]) ?>        
        <?= TabsX::widget([
                    'items' => $items,
                    'position'=>TabsX::POS_ABOVE,
                    'encodeLabels'=>false,
                    'containerOptions' => ['class'=>'tab_track']
                ]) ?>
    <?php endif; ?>
    <?php if($object): ?>
        <?= $this->render('//services/partial/objects.php', ['object'=>$object]) ?>
    <?php endif; ?>
    <?php if($product): ?>
        <?= $this->render('//services/partial/products.php', ['product'=>$product, 'object'=>$product->object]) ?>
    <?php endif; ?>
    <?php if($action): ?>
        <?= $this->render('//services/partial/actions.php', ['action'=>$action]) ?>    
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