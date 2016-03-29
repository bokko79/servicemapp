<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\widgets\Tabs;
use frontend\widgets\PageTitle;
use frontend\widgets\ProfileSubNav;

$service = $this->params['service'];
$object_model = $this->params['object_model'];
$presentation = $this->params['presentation'];
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>
<div class="grid-container">
    <div class="grid-row">
        <div class="grid-left margin-top-20">
            <?= $this->render('partial/side-menus/presentation-menu.php', ['service'=>$service, 'model'=>$presentation, 'object_model'=>$object_model, 'data'=>$presentation]) ?>
        </div>
        <div class="grid-rightacross">
            <div class="grid-row">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class' => 'breadcrumb inverted bg-blue-gray-900'],
                ]) ?>
            </div>
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData'=>[
                        'background' => 'bg-blue-gray-900',
                        'icon' => 'plus-square',
                        'title' => 'Ponuda usluge<br><br><span class="fs_42 thin">' . c($service->action->tName) . (count($object_model)==1 ? ' '.$object_model[0]->tNameGen.' <span class="head regular gray-color fs_20">['.$service->object->tNameGen.']</span>' : ' '.$service->object->tNameGen). '</span>' .Html::a('<i class="fa fa-arrow-circle-left"></i>&nbsp;'.Yii::t('app', 'Nazad na profil'), Url::to(''), ['class' => 'btn btn-default btn-sm float-right']),
                        'description' => '<p class="fs_12">Ponudite svojim klijentima uslugu tako što ćete opisati njene detalje i omogućite im da direktno naruče od Vas!</p>',
                        'h' => 2,
                    ],
                    'invert' => true,
                ]); ?>
            <?= $content ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>
<?php $this->endContent(); // HTML ?>
