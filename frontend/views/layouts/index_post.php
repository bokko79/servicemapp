<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
?>

<?php $this->beginContent('@app/views/layouts/html/html_materialize.php'); ?>

<?php /* PROFILE HEADING */ ?>
<div class="subnav-fixed">
    <ul class="">
        <li><?= Html::a('Info', Url::to('/info'), ['class'=>'', 'onclick'=>'']) ?></li>
        <li><?= Html::a('Kako servicemapp.com radi', Url::to('/how-it-works'), []) ?></li>
        <li><?= Html::a('FAQ', Url::to('/faq'), []) ?></li>
        <li><?= Html::a('Članarina i troškovi', Url::to('/membership'), []) ?></li>
        <li><?= Html::a('Blog', Url::to('/blog'), []) ?></li>
        <li><?= Html::a('O nama', Url::to('/about-us'), []) ?></li>
        <li><?= Html::a('Kontakt', Url::to('/contact-us'), []) ?></li>
    </ul>

</div>
<div class="grid-container"  style="margin-top:70px;">
    <div class="grid-row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
    
    <div class="grid-row">
        <div class="grid-leftacross">
                
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Menu ?>
            <?= $this->render('partial/news.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>