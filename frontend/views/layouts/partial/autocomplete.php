<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\widgets\ActiveForm;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use yii\web\View;
use kartik\widgets\Typeahead;

/*$onSelectJs = <<< 'JS'
var onSelect = function(event, data) { return $('#csservicessearch-id').val(data.id); }
JS;
 
// Register the formatting script
$this->registerJs($onSelectJs, View::POS_HEAD);*/
$template = '<div class="card_container record-full no-shadow no-border no-margin">'.
    '<div class="header-context low-margin">'.
        '<div class="avatar round">'.
        	Html::img('@web/images/cards/default_avatar.jpg').
            //'<i class="fs_12 fa {{icon}} fa-3x" style="color:{{color}}"></i>'.
        '</div>'.
        '<div class="title">'.
            '<div class="head second regular capitalize">{{name}}</div>'.
            '<div class="subhead capitalize">{{industry}}</div>'.
        '</div>'.
       	'<div class="subaction">'.
            '<a href="'.
            Url::to(['/add/'.slug('{{name}}')]).
            '"><i class="fa fa-shopping-cart fa-2x"></i></div>'.
        '</div>'.
    '</div>'.
'</div>';
$template_ind = '<div class="card_container record-full no-shadow no-border no-margin">'.
    '<div class="primary-context low-margin">'.
        '<div class="avatar center">'.
            '<i class="fa {{icon}} fa-2x" style="color:{{color}}"></i>'.
        '</div>'.
        '<div class="title">'.
            '<div class="head second regular capitalize">{{name}}</div>'.
            '<div class="fs_11 gray-color capitalize">{{category}}</div>'.
        '</div>'.
    '</div>'.
'</div>';
//$template_ind = '<div><p class="fs_14" style="width:100%"><i class="fa {{icon}}" style="color:{{color}}"></i>  {{name}}</p></div>';
$template_act = '<div class="capitalize">{{name}}</div>';
$template_obj = '<div class="card_container record-full no-shadow no-border no-margin">'.
    '<div class="header-context low-margin">'.
        '<div class="avatar round">'.
        	Html::img('@web/images/cards/default_avatar.jpg').
            //'<i class="fs_12 fa {{icon}} fa-3x" style="color:{{color}}"></i>'.
        '</div>'.
        '<div class="title">'.
            '<div class="head second regular capitalize">{{name}}</div>'.
            '<div class="subhead capitalize">{{parent}}</div>'.
        '</div>'.
    '</div>'.
'</div>';
$template_tag = '<div class="capitalize">{{name}} <i class="fa fa-caret-right"></i> <span class="fs_11 gray-color">{{service}}{{industry}}{{action}}{{object}}</span></div>';
?>
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
			    	'minLength' => 2,
			    	'accentMap'=> '',
				],

				//'scrollable' => true,
			    'dataset' => [
			        [
			            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
			            'display' => 'name',
			            'remote' => [
			                'url' => Url::to(['/auto/list-services']) . '?q=%QUERY',
			                'wildcard' => '%QUERY',
			                // kartik-v/yii2-widget-typeahead/assets/js/typeahead.bundle.js line 344 set max to 8
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
			                'url' => Url::to(['/auto/list-services-tags']) . '?q=%QUERY',
			                'wildcard' => '%QUERY',
			            ],
			            'templates' => [
			            	'header' => '<div class="fs_14 gray-color border-bottom" style="padding: 15px 15px 2px">Tagovi usluga</div>',
			                'suggestion' => new JsExpression("Handlebars.compile('{$template_tag}')")
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
			                'url' => Url::to(['/auto/list-industries-tags']) . '?q=%QUERY',
			                'wildcard' => '%QUERY',
			            ],
			            'templates' => [
			            	'header' => '<div class="fs_14 gray-color border-bottom" style="padding: 15px 15px 2px">Tagovi delatnosti</div>',
			                'suggestion' => new JsExpression("Handlebars.compile('{$template_tag}')")
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
			                'url' => Url::to(['/auto/list-objects-tags']) . '?q=%QUERY',
			                'wildcard' => '%QUERY',
			            ],
			            'templates' => [
			            	'header' => '<div class="fs_14 gray-color border-bottom" style="padding: 15px 15px 2px">Tagovi predmeta usluga</div>',
			                'suggestion' => new JsExpression("Handlebars.compile('{$template_tag}')")
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
			                'url' => Url::to(['/auto/list-actions-tags']) . '?q=%QUERY',
			                'wildcard' => '%QUERY',
			            ],
			            'templates' => [
			            	'header' => '<div class="fs_14 gray-color border-bottom" style="padding: 15px 15px 2px">Tagovi akcija</div>',
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
				    		} else if(data.object_id){
				    			$('#csservicessearch-object_id').val(data.object_id); 
				    		} else if(data.tag_id){
				    			$('#csservicessearch-tag_id').val(data.tag_id); 
				    		}
				    		$('#autocomplete-search-form').submit();						    		
				    	}",
				]
			])->label(false) ?>
    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'id')?>
    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'industry_id')?>
    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'action_id')?>
    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'object_id')?>
    <?= Html::activeHiddenInput(new \frontend\models\CsServicesSearch, 'tag_id')?>
	<?php ActiveForm::end(); ?>
</div>