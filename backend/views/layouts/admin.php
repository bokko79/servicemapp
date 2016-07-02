<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\widgets\Breadcrumbs;
?>

<?php $this->beginContent('@app/views/layouts/html/html_simple.php'); ?>

<!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
<!-- End Page Loading -->
<div class="container-fluid">
    <div class="row">
        <?= $this->render('partial/left_sidebar.php') ?>


        <div id="main" class="col-md-10 col-md-offset-2">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                //'options' => ['class' => 'nav-wrapper'],
                //'tag' => 'div',    
                //'homeLink' => ['label' => 'Home', 'url' => ['/'], 'class'=>'breadcrumb'],
                //'itemTemplate' => '{link}',
            ]) ?>   
        

            <?= $content ?>

            
        </div>
    </div>
    <?= $this->render('partial/footer.php') ?>
</div>              
<?php $this->endContent(); // HTML ?>