<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\widgets;

use Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Cart displays a card on the left sidebar.
 *
 * To use Cart, you need to configure its [[links]] property, which specifies the links to be displayed. For example,
 *
 * ~~~
 * // $this is the view object currently being used
 * echo Cart::widget([
 *     
 * ]);
 * ~~~
 *
 * @author Bojan Grozdanic <bojan.grozdanic@gmail.com>
 * @since 2.0
 */
class Cart extends Widget
{
    public $cart=[];
    public $card_class;


    /**
     * Renders the widget
     */
    public function run()
    { 
    	if($this->cart['session']!=null): ?>
		<div class="card_container <?= $this->card_class ?>" id="card_container" style="float:none;">		       
	        <div class="header-context">
	            <div class="head lower gray-color regular">Vaša korpa</div>
	            <div class="subhead">Lorem ipsum</div>
	            <?= Html::a('<i class="fa fa-trash-o"></i>', Url::to(['/empty-cart']), ['class'=>'btn btn-link', 'style'=>'width:100%']); ?>
	        </div>
	        <?php 
	        	foreach ($this->cart['session'] as $s){
	        		$service = \frontend\models\CsServices::findOne($s['service']); ?>
			        <div class="secondary-context tease">
			            <p><?= c($service->tName) ?></p>
			        </div>
	        <?php } ?>
	        
	        <div class="action-area center">
	            <?= Html::a('<i class="fa fa-shopping-cart"></i>&nbsp;'.Yii::t('app', 'Poruči'), Url::to(['/new-order', 'industry'=>$this->cart['industry']]), ['class'=>'btn btn-info', 'style'=>'width:100%']); ?>
	        </div>		   
		</div>
<?php
		endif;
    }
}
