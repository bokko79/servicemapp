<?php

use yii\helpers\Html;
use yii\helpers\Url;
/*use yii\widgets\DetailView;*/
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-view">

    <div class="card_container record-full" id="card_container" style="float:none;">
        <a href="<?= Url::to('/services') ?>">
            <div class="header-context page-title">
                <h1><?= $model->title ?></h1>
                <h4><?= $model->postCategory->ime ?></h4>
            </div>
            <div class="media-area">                
                <div class="image">
                    <?= Html::img('@web/images/cards/info/info_docs'.rand(0, 9).'.jpg') ?>                    
                </div>
            </div>
            <div class="primary-context">
                <h1><?= $model->title ?></h1>
                <div class="subhead"><?= $model->postCategory->ime ?></div>
            </div>
            <div class="secondary-context cont">
                <span><i class="fa fa-globe"></i>&nbsp;7.345</span>
                <span>&nbsp;<i class="fa fa-users"></i>&nbsp;468</span>
                <span>&nbsp;<i class="fa fa-rss fa-rotate-270"></i>&nbsp;223</span>
                <?= $model->body ?>
            </div>
            <div class="action-area right">
                <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Order'), Url::to(), ['class'=>'btn btn-link']); ?>
            </div>            
        </a>
            <div class="action-area normal-case">
                <?= Html::a(Yii::t('app', 'Comments').'&nbsp;<i class="fa fa-caret-down"></i>', null, ['class'=>'btn btn-link comment-link']); ?>
            </div>
            <div class="comments-area animated fadeInDown">
                <div class="comment-wrap">
                    <table>
                        <tr>
                            <td class="avatar">
                                <?= Html::img('@web/images/cards/default_avatar.jpg') ?>          
                            </td>
                            <td class="body">
                                <table>
                                    <tr>
                                        <td class="head second">
                                            Masterplan
                                        </td>
                                        <td class="subaction">                                      
                                            <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?> 
                                        </td>                       
                                    </tr>                        
                                </table>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                            fugiat nulla pariatur.</p> 
                            </td>                       
                        </tr>                        
                    </table>
                </div>

                <div class="comment-wrap">
                    <table>
                        <tr>
                            <td class="avatar">
                                <?= Html::img('@web/images/cards/info/info_docs2.jpg') ?>          
                            </td>
                            <td class="body">
                                <table>
                                    <tr>
                                        <td class="head second">
                                            Tomislav
                                        </td>
                                        <td class="subaction">                                      
                                            <?= \yii\timeago\TimeAgo::widget(['timestamp' => date('U')]); ?> 
                                        </td>                       
                                    </tr>                        
                                </table>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua..</p> 
                            </td>                       
                        </tr>                        
                    </table>
                </div>                  
            </div> 
    </div>
    <?= DetailView::widget([
        'model'=>$model,
        'condensed'=>true,
        'hover'=>true,
        'mode'=>DetailView::MODE_VIEW,
        'panel'=>[
            'heading'=>'Book # ' . $model->id,
            'type'=>DetailView::TYPE_INFO,
        ],
        'attributes'=>[
            'id',
            'post_category_id',
            'title',
            'subtitle',
            'body:ntext',
            'status',
            'published',
            'time',
            'description',            
            ['attribute'=>'time', 'type'=>DetailView::INPUT_DATE],
        ]
    ]) ?>
<?php /*
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'post_category_id',
            'title',
            'subtitle',
            'body:ntext',
            'status',
            'published',
            'time',
            'description',
        ],
    ]) */ ?>

</div>



