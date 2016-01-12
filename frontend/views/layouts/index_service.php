<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\widgets\Breadcrumbs;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>
<?= $this->render('partial/service_head.php') ?>

<div class="grid-container">
    <div class="grid-row">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>
    <div class="grid-row">
        <div class="grid-full">           
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>