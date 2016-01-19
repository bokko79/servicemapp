<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">
    <div class="grid-row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>

    <div class="grid-row">
        <div class="grid-left" style="margin-top:20px;">
            <?php // Filters ?>
            
            <?= $this->render('../activities/filters/location.php', ['model' => new \frontend\models\Activities]) ?>
            <?= $this->render('../activities/filters/industry.php', ['model' => new \frontend\models\Activities]) ?>
        </div>

        <div class="grid-center" style="margin-top:20px;">
            <?= $this->render('partial/quick-forms.php') ?>
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Stats ?>
            <?= $this->render('partial/news-feed.php') ?>
            <?= $this->render('partial/news.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>