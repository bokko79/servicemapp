<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\widgets\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;
?>

<?php $this->beginContent('@app/views/layouts/html/html_servicemapp.php'); ?>

<?php /* PROFILE HEADING */ ?>

<div class="grid-container">
    <div class="grid-row" style="margin-bottom:20px;">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </div>

    <div class="grid-row">
        <div class="grid-leftacross">
            <?php // Title Widget ?>
            <?= $content ?>
        </div>
                
        <div class="grid-right media_right_sidebar">
            <?php // Menu ?>
            <?php // News/Ads ?>
            
            <div class="card_container record-270 no-shadow fadeInUp animated" id="card_container" style="float:none;">
                <a href="<?= Url::to('/posts') ?>">
                    
                    <table class="main-context"> 
                        <tr>
                            <td class="body-area">
                                <div class="primary-context">
                                    <div class="head">Kantarion Networks</div>
                                    <div class="subhead">Beograd, Srbija</div>                                   
                                </div>                                
                            </td>
                            <td class="media-area">
                                <div >                
                                    <div class="image">
                                        <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>
                                    </div>
                                </div> 
                            </td>
                        </tr>                        
                    </table>
                    <div class="secondary-context tease">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore magna aliqua.</p>
                    </div>
                    <div class="action-area right">
                        <?= Html::a('<i class="fa fa-bookmark"></i>&nbsp;'.Yii::t('app', 'Read more'), Url::to(), ['class'=>'btn btn-link']); ?>
                    </div>
                </a>
            </div>

            <?= $this->render('partial/footer.php') ?>
        </div>
    </div>
</div>

<?php $this->endContent(); // HTML ?>