<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use kartik\select2\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use frontend\models\CsServices;
use frontend\widgets\ServiceBox;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

    <?php $form = kartik\widgets\ActiveForm::begin([

    ]); 
    $url = \yii\helpers\Url::to(['/auto/list-services']); ?>
    <?= $form->field(new CsServices, 'name')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(CsServices::find()->all(), 'id', 'name'),
            'options' => ['placeholder' => 'Search for a service ...'],
            'pluginLoading' => false,
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 3,
                'ajax' => [
                    'url' => $url,
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(city) { return city.text; }'),
                'templateSelection' => new JsExpression('function (city) { return city.text; }'),
            ],
        ]); ?>

    <?php ActiveForm::end(); ?>

<div class="grid js-masonry"
  data-masonry-options='{ "itemSelector": ".grid-item", "isFitWidth": true, "gutter": 26 }' style="">
    <?php 
        $query = \frontend\models\CsServices::find();
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        foreach ($models as $service) {
            echo ServiceBox::widget([
                'serviceId' => $service->id,
                'containerOptions' => '',
                'link' => '/s/'.mb_strtolower(str_replace(' ', '-', $service->csServicesTranslations[0]->name)),
                'image' => [
                    'source'=>'info_docs'.substr($service->id, -1).'.jpg',
                ],
                'name' => $service->csServicesTranslations[0]->name,
                'subhead' => $service->industry->csIndustriesTranslations[0]->name,
                'description' => $service->industry->csIndustriesTranslations[0]->description,
                'stats' => [
                    'orders'=> 346,
                    'providers' => 71,
                    'promotions' => 102,
                ],
                'price' => [
                    'amount'=> 450,
                    'currencyCode' => 'RSD',
                    'unit' => 'm',
                ],
                'actionButton' => '',
            ]);
        }  ?>
</div>    

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
