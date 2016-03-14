<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use kartik\widgets\Select2;
use yii\web\View;
$session = Yii::$app->session;
 $data = \frontend\models\CsServices::find()
    ->select(['name as value', 'name as label','id as id'])
    ->asArray()
    ->all();
 //print_r(ArrayHelper::map(\frontend\models\CsServices::find()->all(), 'id', 'name')); die();
    $url = \yii\helpers\Url::to(['/auto/list-industries']);

$formatJs = <<< 'JS'
var formatRepo = function (element) {
    if (element.loading) {
        return element.service;
    }
    
    if (element.industry) {
      var markup =
'<div class="row">' + 
    '<div class="col-sm-12">' + 
        '<b style="margin-left:5px">' + element.industry + '</b>' + 
    '</div>' +
'</div>';
    }
    if (element.service) {
      var markup =
'<div class="row">' + 
    '<div class="col-sm-12">' + 
        '<b style="margin-left:5px">' + element.service + ' ' + element.industry + '</b>' + 
    '</div>' +
'</div>';
    }
    return '<div style="overflow:hidden;">' + markup + '</div>';
};
var formatRepoSelection = function (element) {
    return element.service;
}
JS;
 
// Register the formatting script
$this->registerJs($formatJs, View::POS_HEAD);
 
// script to parse the results into the format expected by Select2
$resultsJs = <<< JS
function (data, params) {
    params.page = params.page || 1;
    return {
        results: data.items,
        pagination: {
            more: (params.page * 30) < data.total_count
        }
    };
}
JS;
?>
<div class="container" style="">
	<div class="content" style="">
	<?php if($session->get("state") && !$getService): ?>
		<h3 style="margin:0; text-align:center"><?= ($session->get("state")=='order') ? 'Izaberite uslugu koju želite da poručite' : 'Izaberite uslugu koju želite da ponudite' ?></h3>
		<hr>
	<?php endif; ?>
		<div class="service_autocomplete_search" style="">
			<?php $form = kartik\widgets\ActiveForm::begin([
				'action' => ['/services'],
	        	'method' => 'get',
	        	'id' => 'autocomplete-search-form',
			]); ?>
				<?php /* $form->field(new \frontend\models\CsServicesSearch, 'name', [				
					'options' => ['class'=>((!$getService) ? 'form-group-lg' : '')],
					'addon' => [
						//'prepend' => ['content'=>'Usluge'],
						'append' => [
				            'content' => Html::button('<i class="fa fa-search"></i>', ['class'=>'btn btn-default '.((!$getService) ? 'btn-lg' : '')]), 
				            'asButton' => true
				        ],
					]
				])->input('text', ['placeholder' => 'Pretražite usluge pomoću ključih reči...'])->label(false) */ ?>

<?= Select2::widget([
    'model' => new \frontend\models\CsServicesSearch,
    'attribute' => 'id',
    //'data' => ArrayHelper::map(\frontend\models\CsServices::find()->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Select a state ...', /*'multiple' => true*/],
    'theme' => Select2::THEME_BOOTSTRAP,
    'size' => (!$getService) ? Select2::LARGE : Select2::MEDIUM,
    'pluginOptions' => [
		//'allowClear' => true,
		'minimumInputLength' => 3,
		//'minimumResultsForSearch' => -1,
		//'dropdownAdapter' => 'DropdownAdapter',
    	//'selectionAdapter' => 'SelectionAdapter',
        'language' => [
            'errorLoading' => new JsExpression("function () { return 'Waiting for results...'; }"),
            'sr-Rs'
        ],
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'delay' => 250,
            'data' => new JsExpression('function(params) { return {q:params.term}; }'),
            //'processResults' => new JsExpression($resultsJs),
            'cache' => true
        ],
        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('formatRepo'),
        'templateSelection' => new JsExpression('formatRepoSelection'),
    ],
    'pluginEvents' => [
	    "change" => "function() { $( '#autocomplete-search-form' ).submit(); }",
	],
    'addon' => [
        'append' => [
            'content' => Html::submitButton('<i class="fa fa-search"></i>', ['class'=>'btn btn-default '.((!$getService) ? 'btn-lg' : ''), 'title' => 'Mark on map', 
                'data-toggle' => 'tooltip']),
            'asButton' => true
        ],
    ],
  ])
     ?>

    <?php // Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'name')?>
			<?php ActiveForm::end(); ?>
		</div>
		<div class="linksqqqqq">
			Pretražite usluge pomoću: 
			<?= Html::a('Uslužnih delatnosti', null, ['class'=>((!$getService) ? 'industries-six-boxes-link' : 'industries-six-boxes-link-mini')]); ?>
			<?= Html::a('Predmeta usluga', null, ['class'=>'objects-six-boxes-link']); ?>
		</div>		
	</div>
</div>