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


/*$onSelectJs = <<< 'JS'
var onSelect = function(event, data) { return $('#csservicessearch-id').val(data.id); }
JS;
 
// Register the formatting script
$this->registerJs($onSelectJs, View::POS_HEAD);*/

/*$template = '<div><p class="fs_14" style="width:100%">{{name}}</p>' .
    '<i class="fs_12 fa {{icon}}" style="color:{{color}}"></i>' .
    '<span class="fs_11 gray-color" style="">  {{industry}}</span></div>';*/
$template = '<div class="card_container record-full no-shadow no-border no-margin">'.
    '<div class="header-context low-margin">'.
        '<div class="avatar round">'.
        	Html::img('@web/images/cards/default_avatar.jpg').
            //'<i class="fs_12 fa {{icon}} fa-3x" style="color:{{color}}"></i>'.
        '</div>'.
        '<div class="title">'.
            '<div class="head second regular">{{name}}</div>'.
            '<div class="subhead">{{industry}}</div>'.
        '</div>'.
    '</div>'.
'</div>';
$template_ind = '<div class="card_container record-full no-shadow no-border no-margin">'.
    '<div class="primary-context low-margin">'.
        '<div class="avatar">'.
            '<i class="fa {{icon}} fa-3x" style="color:{{color}}"></i>'.
        '</div>'.
        '<div class="title">'.
            '<div class="head second regular">{{name}}</div>'.
            '<div class="subhead fs_10">{{category}}</div>'.
        '</div>'.
    '</div>'.
'</div>';
//$template_ind = '<div><p class="fs_14" style="width:100%"><i class="fa {{icon}}" style="color:{{color}}"></i>  {{name}}</p></div>';
$template_act = '<div>{{name}}</div>';
$template_obj = '<div class="card_container record-full no-shadow no-border no-margin">'.
    '<div class="header-context low-margin">'.
        '<div class="avatar round">'.
        	Html::img('@web/images/cards/default_avatar.jpg').
            //'<i class="fs_12 fa {{icon}} fa-3x" style="color:{{color}}"></i>'.
        '</div>'.
        '<div class="title">'.
            '<div class="head second regular">{{name}}</div>'.
            '<div class="subhead">{{parent}}</div>'.
        '</div>'.
    '</div>'.
'</div>';
$template_tag = '<div>{{name}}</div>';
?>


<div class="container" style="">
	<div class="content" style="">
	<?php if($session->get("state")!='global' && $renderIndex): ?>
		<h3 style="margin:0; text-align:center"><?= ($session->get("state")=='order') ? 'Izaberite uslugu koju želite da poručite' : 'Izaberite uslugu koju želite da ponudite' ?></h3>
		<hr>
	<?php endif; ?>
		<div class="service_autocomplete_search" style="">
			<?php $form = kartik\widgets\ActiveForm::begin([
				'action' => ['/auto/index'],
	        	//'method' => 'get',
	        	'id' => 'autocomplete-search-form',
			]); ?>
			<?php echo $form->field(new \frontend\models\CsServicesSearch, 'name', [				
						'options' => ['class'=>($renderIndex ? 'form-group-lg' : '')],
						'addon' => [
							//'prepend' => ['content'=>'Usluge'],
							'append' => [
					            'content' => Html::submitButton('<i class="fa fa-search"></i>', ['class'=>'btn btn-default '.($renderIndex ? 'btn-lg' : '')]), 
					            'asButton' => true
					        ],
						]
					])->widget(Typeahead::classname(), [
					    //'name' => 'service',
					    'options' => ['placeholder' => 'Pretražite usluge, predmete, delatnosti ...'],
					    'pluginOptions' => [
					    	'highlight'=>true,	
						],
					    'dataset' => [
					        [
					            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
					            'display' => 'name',
					            'remote' => [
					                'url' => Url::to(['/auto/list-services']) . '?q=%QUERY',
					                'wildcard' => '%QUERY',
					            ],
					            'templates' => [
					            	'header' => '<div class="fs_16 gray-color border-bottom" style="padding: 15px 15px 2px">Usluge</div>',
					                'notFound' => '<div class="text-danger" style="padding:0 8px">Nema rezultata za usluge.</div>',
					                'suggestion' => new JsExpression("Handlebars.compile('{$template}')")
					            ]
					        ],
					        [
					            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
					            'display' => 'name',
					            'remote' => [
					                'url' => Url::to(['/auto/list-industries']) . '?q=%QUERY',
					                'wildcard' => '%QUERY',
					            ],
					            'templates' => [
					            	'header' => '<div class="fs_16 gray-color border-bottom" style="padding: 15px 15px 2px">Delatnosti</div>',
					                'suggestion' => new JsExpression("Handlebars.compile('{$template_ind}')")
					            ]
					        ],
					        [
					            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
					            'display' => 'name',
					            'remote' => [
					                'url' => Url::to(['/auto/list-actions']) . '?q=%QUERY',
					                'wildcard' => '%QUERY',
					            ],
					            'templates' => [
					            	'header' => '<div class="fs_16 gray-color border-bottom" style="padding: 15px 15px 2px">Akcije</div>',
					                'suggestion' => new JsExpression("Handlebars.compile('{$template_act}')")
					            ]
					        ],
					        [
					            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
					            'display' => 'name',
					            'remote' => [
					                'url' => Url::to(['/auto/list-objects']) . '?q=%QUERY',
					                'wildcard' => '%QUERY',
					            ],
					            'templates' => [
					            	'header' => '<div class="fs_16 gray-color border-bottom" style="padding: 15px 15px 2px">Predmeti usluga</div>',
					                'suggestion' => new JsExpression("Handlebars.compile('{$template_obj}')")
					            ]
					        ],
					        [
					            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
					            'display' => 'name',
					            'remote' => [
					                'url' => Url::to(['/auto/list-tags']) . '?q=%QUERY',
					                'wildcard' => '%QUERY',
					            ],
					            'templates' => [
					            	'header' => '<div class="fs_16 gray-color border-bottom" style="padding: 15px 15px 2px">Tagovi</div>',
					                'suggestion' => new JsExpression("Handlebars.compile('{$template_tag}')")
					            ]
					        ],
					    ],
					    'pluginEvents' => [
						    "typeahead:select" => "function(event, data) {
						    		if(data.id){
						    			$('#csservicessearch-id').val(data.id); 
						    		} else if(data.industry_id){
						    			$('#csservicessearch-industry_id').val(data.industry_id); 
						    		} else if(data.action_id){
						    			$('#csservicessearch-action_id').val(data.action_id); 
						    		}
						    		else if(data.object_id){
						    			$('#csservicessearch-object_id').val(data.object_id); 
						    		}
						    		$('#autocomplete-search-form').submit();						    		
						    	}",
						]
					])->label(false) ?>
				<?php /* $form->field(new \frontend\models\CsServicesSearch, 'name', [				
					'options' => ['class'=>($renderIndex ? 'form-group-lg' : '')],
					'addon' => [
						//'prepend' => ['content'=>'Usluge'],
						'append' => [
				            'content' => Html::button('<i class="fa fa-search"></i>', ['class'=>'btn btn-default '.($renderIndex ? 'btn-lg' : '')]), 
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
    'size' => $renderIndex ? Select2::LARGE : Select2::MEDIUM,
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
            'content' => Html::submitButton('<i class="fa fa-search"></i>', ['class'=>'btn btn-default '.($renderIndex ? 'btn-lg' : ''), 'title' => 'Mark on map', 
                'data-toggle' => 'tooltip']),
            'asButton' => true
        ],
    ],
  ])*/
     ?>

    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'id')?>
    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'industry_id')?>
    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'action_id')?>
    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'object_id')?>
    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'tag_id')?>
			<?php ActiveForm::end(); ?>
		</div>
		<div class="links">
			Pretražite usluge pomoću: 
			<?= Html::a('Uslužnih delatnosti', null, ['class'=>($renderIndex ? 'industries-six-boxes-link' : 'industries-six-boxes-link-mini')]); ?>
			<?= Html::a('Predmeta usluga', null, ['class'=>'objects-six-boxes-link']); ?>
		</div>		
	</div>
</div>