<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\widgets\PageTitle;
?>
<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>
<div class="subnav-fixed">
    <?= $this->render('partial/subnav/user_profile.php', ['user'=>$this->params['user']]) ?>
</div>

<div class="grid-container" style="margin-top:70px;">   

    <div class="grid-row">
        <div class="grid-left margin-top-20">
            <?= $this->render('partial/side-menus/services-menu.php', ['user'=>$this->params['user']]) ?>
        </div>
        <div class="grid-rightacross">
            <div class="grid-row">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => ['class' => 'breadcrumb inverted bg-blue-gray-900'],
                ]) ?>
            </div>
            <?php /* WIDGET: PAGETITLE */ ?>
                <?php /* PageTitle::widget([
                    'titleData'=>[
                        'background' => 'bg-blue-100',
                        'icon' => 'flag-o',
                        'title' => 'Moje usluge',
                        'description' => null,                        
                    ],
                    'invert' => true,
                ]); */ ?>
            <?php /* WIDGET: PAGETITLE */ ?>
                <?= PageTitle::widget([
                    'titleData'=>$this->pageTitle,
                    'invert' => true,
                ]); ?> 
            <?= $content ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>