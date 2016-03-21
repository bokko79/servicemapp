<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php $user = $this->params['user']; ?>
<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="subnav-fixed">
    <?= $this->render('partial/subnav/user_profile.php', ['user'=>$user]) ?>
</div>
<div class="grid-container" style="margin-top:70px;">    
    <div class="grid-row">
        <div class="grid-left">
            
            
        </div>

        <div class="grid-rightacross" style="">   
            <?= $content ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>