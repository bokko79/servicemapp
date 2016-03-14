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
$presentation = $this->params['presentation'];
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>
<div class="grid-container">
    <div class="grid-row">
        <div class="grid-left margin-top-20">
            <?= $this->render('partial/side-menus/presentation-menu.php', ['service'=>$service, 'model'=>$presentation]) ?>
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
                        'icon' => 'cog',
                        'title' => 'Nova prezentacija usluge '.$service->tName.Html::a('<i class="fa fa-arrow-circle-left"></i>&nbsp;'.Yii::t('app', 'Nazad na profil'), Url::to(''), ['class' => 'btn btn-default btn-sm float-right']),
                        'description' => null,
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