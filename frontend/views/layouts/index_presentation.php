<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<div class="subnav-fixed">
    <?= $this->render('partial/subnav/presentations.php', []) ?>
</div>

<div class="grid-container" style="margin-top:70px;">
    <div class="grid-row">
        <div class="grid-left">
            <?php // Details Widget ?>
            <?= $this->render('//presentations/_filters.php', [
                    'model'=>$this->params['searchModel'], 
                    'service'=>$this->params['service'], 
                    'model_specs' => $this->params['model_specs'], 
                    'model_methods' => $this->params['model_methods'], 
                    'location' => $this->params['location'],
                ]) ?>
        </div>

        <div class="grid-center" style="">   
            <?= $content ?>
        </div>
                
        <div class="grid-right">
            <?= $this->render('partial/news.php') ?>
            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<div style="background:#f8f8f8">
    <?= $this->render('//services/_commercial.php', ['services'=>false]) ?>
    <?= $this->render('partial/footer.php') ?>
</div>

<?php $this->endContent(); // HTML ?>