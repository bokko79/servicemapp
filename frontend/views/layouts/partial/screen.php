<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use yii\web\View;
use kartik\widgets\Typeahead;


$session = Yii::$app->session;


$formatJs = <<< 'JS'
var formatRepo = function (data) {                    
    	return '<div><strong>' + data.value + '</strong> - ' + data.id + '</div>';
    }
JS;
 
// Register the formatting script
$this->registerJs($formatJs, View::POS_HEAD);
?>
<div class="container" style="">
	<div class="content" style="">
	<?php if($session->get("state")!='global'): ?>
		<h3 style="margin:0; text-align:center"><?= ($session->get("state")=='order') ? 'Izaberite uslugu koju želite da poručite' : 'Izaberite uslugu koju želite da ponudite' ?></h3>
		<hr>
	<?php endif; ?>
		<div class="service_autocomplete_search" style="">
			<?php $form = kartik\widgets\ActiveForm::begin([
				'action' => ['/services'],
	        	'method' => 'get',
	        	'id' => 'autocomplete-search-form',
			]); ?>
			<?php echo $form->field(new \frontend\models\CsServicesSearch, 'name', [				
						'options' => ['class'=>((!$getService) ? 'form-group-lg' : '')],
						'addon' => [
							//'prepend' => ['content'=>'Usluge'],
							'append' => [
					            'content' => Html::submitButton('<i class="fa fa-search"></i>', ['class'=>'btn btn-default '.((!$getService) ? 'btn-lg' : '')]), 
					            'asButton' => true
					        ],
						]
					])->widget(Typeahead::classname(), [
					    //'name' => 'service',
					    'options' => ['placeholder' => 'Pretražite usluge, predmete, delatnosti ...'],
					    'pluginOptions' => ['highlight'=>true],
					    'dataset' => [
					        [
					            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
					            'display' => 'value',
					            'remote' => [
					                'url' => Url::to(['/auto/list-services']) . '?q=%QUERY',
					                'wildcard' => '%QUERY',
					            ],
					            'templates' => [
					            	'suggestion' => new JsExpression('formatRepo'),
					            ]
					        ],
					    ]
					])->label(false) ?>
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

<?php /* Select2::widget([
    'model' => new \frontend\models\CsServicesSearch,
    'attribute' => 'id',
    //'data' => ArrayHelper::map(\frontend\models\CsServices::find()->all(), 'id', 'name'),
    'options' => ['placeholder' => 'Select a state ...', /*'multiple' => true*//*],*/
    /*'theme' => Select2::THEME_BOOTSTRAP,
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
  ])*/
     ?>

    <?php // Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'name')?>
			<?php ActiveForm::end(); ?>
		</div>
		<div class="links">
			Pretražite usluge pomoću: 
			<?= Html::a('Uslužnih delatnosti', null, ['class'=>((!$getService) ? 'industries-six-boxes-link' : 'industries-six-boxes-link-mini')]); ?>
			<?= Html::a('Predmeta usluga', null, ['class'=>'objects-six-boxes-link']); ?>
		</div>		
	</div>
</div>