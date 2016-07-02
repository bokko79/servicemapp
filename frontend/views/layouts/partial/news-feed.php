<?php

use yii\helpers\Html;
use yii\helpers\Url;
?>
<?php 
		// TICKER se podešava u javascript easy-ticker.js, a vidljivost u _javascript.php
		// izvuci sve logove (poslednjih deset)
		$logs = \common\models\UserLog::find()->orderBy('id DESC')->limit(10)->all(); ?>		

	    <div id="live_feed">

		    <ul>				
			<?php 
		    	foreach ($logs as $log) {
		    		$user = \common\models\User::findOne($log->user_id);
		    		$detail = $user->details;					    									    		

		    		// ubaci _log.php


// user_registered--+++
// provider_registered--+++
// registered as provider--+++

// profile_updated--+++

// order_created--+++
// order_updated--+++
// order_deleted--+++
// order_comment--+++
// order_successful--+++

// provider_selected (bidder awarded)--+++

// bid_sent--+++
// bid_updated--+++
// bid_deleted--+++
// bid_rejected--+++

// promotion_created--+++
// promotionl_updated--
// promotion_deleted--
// promotion_subscription--
// promotion_comment--+++

// presentation_created--+++
// presentation_updated--
// presentation_deleted--
// presentation_comment--+++

// user_rated (order sender - client)--+++
// provider_rated (bidder)--+++

// provider_reviewed--+++
// provider_recommended--+++

        // korisnik o kojem se radi u logu
        $user = \common\models\User::findOne($log->user_id);

        // korisnik kojem je LOG Korisnik nešto uradio
        if ($log->alias!=null) {
             $user1 = \common\models\User::findOne($log->alias);
        }
       
        // ako je na srpskom ili hrvatskom, dodaj sufix
        if (Yii::$app->language == 'SR' || Yii::$app->language == 'HR') {
            if ($detail->gender=='f') {$suff='la';} else {$suff='o';}
        } 
        // dodaj sufixe na drugim jezicima
        else {
            $suff = '';
        }
        

        // user_registered
        if ($log->action=='user_registered') 
            {
                $icon = '<i class="fa fa-upload fa-lg"></i>'; 
                $color = '#a8518a;'; 
                $pre = Yii::t('app', 'New User!'); 
                $log_text = Yii::t('app', 'registered').$suff.' '.Yii::t('app', 'on servicemapp.com');
            } // if ($log->action=='user_registered')

        // become_provider
        if ($log->action=='become_provider') 
            {
                $icon = '<i class="fa fa-users fa-lg"></i>'; 
                $color = '#e66021;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'registered').$suff.' kao <a href="'.Url::to('provider/'.$user->username.'/i').'">pružalac usluga.</a>';
            } // if ($log->action=='become_provider')

        // provider_registered
        if ($log->action=='provider_registered') 
            {
                $icon = '<i class="fa fa-users fa-lg"></i>'; 
                $color = '#e66021';  
                $pre = Yii::t('app', 'New Service Provider!'); 
                $log_text = Yii::t('app', 'registered').$suff.' kao <a href="'.Url::to('provider/'.$user->username.'/i').'">pružalac usluga.</a>';
            } // if ($log->action=='provider_registered') 
        
        // profile_updated
        if ($log->action=='profile_updated') 
            {
                $icon = '<i class="fa fa-cog fa-lg"></i>'; 
                $color = '#455A64'; $pre = ''; 
                $log_text = Yii::t('app', 'updated').$suff.' '.Yii::t('app', 'the profile');
            } // if ($log->action=='profile_updated') 
        
        // order_created
        if ($log->action=='order_created') 
            {
                $icon = '<i class="fa fa-check-square fa-lg"></i>'; 
                $color = '#00aff0;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'sent').$suff.' <a href="'.Url::to('order/'.$log->alias.'').'">'.Yii::t('app', 'an order').' <i class="fa fa-file"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='order_created') 

        // order_updated
        if ($log->action=='order_updated') 
            {
                $icon = '<i class="fa fa-edit fa-lg"></i>'; 
                $color = '#00aff0;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'updated').$suff.' <a href="'.Url::to('order/'.$log->alias.'').'">'.Yii::t('app', 'the order').' <i class="fa fa-file"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='order_updated') 

        // order_deleted
        if ($log->action=='order_deleted') 
            {
                $icon = '<i class="fa fa-times fa-lg"></i>';
                $color = '#00aff0;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'deleted').$suff.' <a href="'.Url::to('order/'.$log->alias.'').'">'.Yii::t('app', 'the request').' <i class="fa fa-file"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='order_deleted') 

        // order_comment
        if ($log->action=='order_comment') 
            {
                $icon = '<i class="fa fa-comment fa-lg"></i>'; 
                $color = '#00aff0;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'commented').$suff.' <a href="'.Url::to('order/'.$log->alias.'').'">'.Yii::t('app', 'on the request').' <i class="fa fa-file"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='order_comment') 

        // order_successful
        if ($log->action=='order_successful') 
            {
                $icon = '<i class="fa fa-trophy fa-lg"></i>'; 
                $color = '#00aff0;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'successfully closed').$suff.' <a href="'.Url::to('order/'.$log->alias.'').'">'.Yii::t('app', 'the request').' <i class="fa fa-file"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='order_successful') 

        // provider_selected
        if ($log->action=='provider_selected') 
            {
                $icon = '<i class="fa fa-trophy fa-lg"></i>'; 
                $color = 'purple'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'selected').$suff.' <a href="'.Url::to('provider/'.$user1->username.'/i').'"><i class="fa fa-user"></i> '.Yii::t('app', 'a service provider').'</a> '.Yii::t('app', 'for the request').' #<a href="'.Url::to('order/'.$log->alias2.'').'">'.$log->alias2.'</a>';
            } // if ($log->action=='provider_selected') 



    if ($log->alias!=null) 
    {
        $bid = \common\models\Bids::findOne($log->alias);

        // bid_sent
        if ($log->action=='bid_sent') 
            {
                $icon = '<i class="fa fa-check-square fa-lg"></i>'; 
                $color = '#00cc00;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'sent').$suff.' <a href="'.Url::to('order/'.$bid->order_id.'').'">'.Yii::t('app', 'a bid').' <i class="fa fa-share-square-o"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='bid_sent') 
        

        // bid_updated
        if ($log->action=='bid_updated') 
            {
                $icon = '<i class="fa fa-edit fa-lg"></i>'; 
                $color = '#00cc00;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'updated').$suff.' <a href="'.Url::to('order/'.$bid->order_id.'').'">'.Yii::t('app', 'the bid').' <i class="fa fa-share-square-o"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='bid_updated') 
        

        // bid_rejected
        if ($log->action=='bid_rejected') 
            {
                $icon = '<i class="fa fa-ban fa-lg"></i>'; 
                $color = '#00cc00;'; 
                $pre = ''; 
                $log_text = Yii::t('notify', 'rejected').$suff.' <a href="'.Url::to('order/'.$bid->order_id.'').'">'.Yii::t('app', 'the bid').' <i class="fa fa-share-square-o"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='bid_rejected') 
        

        // bid_deleted
        if ($log->action=='bid_deleted') 
            {
                $icon = '<i class="fa fa-times fa-lg"></i>'; 
                $color = '#00cc00;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'deleted').$suff.' <a href="'.Url::to('order/'.$bid->order_id.'').'">'.Yii::t('app', 'the bid').' <i class="fa fa-share-square-o"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='bid_deleted') 

    } // if ($log->alias!=null)                

        
        // presentation_created
        if ($log->action=='presentation_created') 
            {
                $icon = '<i class="fa fa-check-square fa-lg"></i>'; 
                $color = '#a8518a;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'created').$suff.' <a href="'.Url::to('/presentation/'.$log->alias.'').'">'.Yii::t('app', 'a new presentation').' <i class="fa fa-flag"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='deal_created')
        
        // presentation_updated
        if ($log->action=='presentation_updated') 
            {
                $icon = '<i class="fa fa-edit fa-lg"></i>'; 
                $color = '#a8518a;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'updated').$suff.' <a href="'.Url::to('/presentation/'.$log->alias.'').'">'.Yii::t('app', 'the presentation').' <i class="fa fa-flag"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='deal_updated') 
        
        // presentation_deleted
        if ($log->action=='presentation_deleted') 
            {
                $icon = '<i class="fa fa-times fa-lg"></i>'; 
                $color = '#a8518a;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'deleted').$suff.' '.Yii::t('app', 'the presentation').' <i class="fa fa-flag"></i> #'.$log->alias;
            } // if ($log->action=='deal_deleted')
        
        // presentation_comment
        if ($log->action=='presentation_comment') 
            {
                $icon = '<i class="fa fa-comment fa-lg"></i>'; 
                $color = '#a8518a;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'commented').$suff.' <a href="'.Url::to('/presentation/'.$log->alias.'').'">'.Yii::t('app', 'on the presentation').' <i class="fa fa-flag"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='deal_comment') 

        // promotion_created
        if ($log->action=='promotion_created') 
            {
                $icon = '<i class="fa fa-check-square fa-lg"></i>'; 
                $color = 'orange;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'created').$suff.' <a href="'.Url::to('/promotion/'.$log->alias.'').'">'.Yii::t('app', 'a new deal').' <i class="fa fa-rss fa-rotate-270"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='deal_created')
        
        // promotion_updated
        if ($log->action=='promotion_updated') 
            {
                $icon = '<i class="fa fa-edit fa-lg"></i>'; 
                $color = 'orange;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'updated').$suff.' <a href="'.Url::to('/promotion/'.$log->alias.'').'">'.Yii::t('app', 'the promotion').' <i class="fa fa-rss fa-rotate-270"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='deal_updated') 
        
        // promotion_deleted
        if ($log->action=='promotion_deleted') 
            {
                $icon = '<i class="fa fa-times fa-lg"></i>'; 
                $color = 'orange;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'deleted').$suff.' '.Yii::t('app', 'the promotion').' <i class="fa fa-rss fa-rotate-270"></i> #'.$log->alias;
            } // if ($log->action=='deal_deleted') 
       
        // promotion_subscription
        if ($log->action=='promotion_subscription') 
            {
                $icon = '<i class="fa fa-plus fa-lg"></i>'; 
                $color = 'orange;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'subscribed').$suff.' <a href="'.Url::to('/promotion/'.$log->alias.'').'">'.Yii::t('app', 'on the promotion').' <i class="fa fa-rss fa-rotate-270"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='deal_subscription') 
        
        // promotion_comment
        if ($log->action=='promotion_comment') 
            {
                $icon = '<i class="fa fa-comment fa-lg"></i>'; 
                $color = 'orange;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'commented').$suff.' <a href="'.Url::to('/promotion/'.$log->alias.'').'">'.Yii::t('app', 'on the promotion').' <i class="fa fa-rss fa-rotate-270"></i> #'.$log->alias.'</a>';
            } // if ($log->action=='deal_comment')   

        
        // user_rated
        if ($log->action=='user_rated') 
            {
                $icon = '<i class="fa fa-star fa-lg"></i>'; 
                $color = '#a8518a;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'rated').$suff.' <i class="fa fa-user"></i> '.Yii::t('app', 'a user').'';
            } // if ($log->action=='user_rated') 
        

        // provider_rated
        if ($log->action=='provider_rated') 
            {
                $icon = '<i class="fa fa-star-o fa-lg"></i>'; 
                $color = '#a8518a;'; 
                $pre = ''; 
                $pro = \common\models\Provider::findOne($log->alias);
                $log_text = Yii::t('app', 'rated').$suff.' <a href="'.Url::to('provider/'.$pro->user->username.'/i').'"><i class="fa fa-users"></i> '.Yii::t('app', 'a service provider').'</a>';
            } // if ($log->action=='provider_rated') 

        /*
        client_reviewed smo izbacili jer useri nemaju profil i ne mogu biti reviewed / 21/01/15
        if ($log->action=='client_reviewed') {$icon = '<i class="fa fa-pencil-square fa-lg"></i>'; $color = '#4d575f;'; $pre = ''; $log_text = 'je pregleda'.$suff.' <i class="fa fa-user></i> korisnika</a>';}*/
        

        // provider_reviewed
        if ($log->action=='provider_reviewed') 
            {
                $icon = '<i class="fa fa-pencil-square fa-lg"></i>'; 
                $color = '#e66021;'; 
                $pre = ''; 
                $log_text = Yii::t('app', 'reviewed').$suff.' <a href="'.Url::to('provider/'.$user1->username.'/i').'"><i class="fa fa-users"></i> '.Yii::t('app', 'a service provider').'</a>';
            } // if ($log->action=='provider_reviewed') 
        
        // provider_recommended
        if ($log->action=='provider_recommended') 
            {
                $icon = '<i class="fa fa-thumbs-o-up fa-lg"></i>'; 
                $color = '#e66021;'; 
                $pre = ''; 
                $pro = \common\models\Provider::findOne($log->alias);
                $log_text = Yii::t('app', 'recommended').$suff.' <a href="'.Url::to('provider/'.$pro->user->username.'/i').'"><i class="fa fa-users"></i> '.Yii::t('app', 'a service provider').'</a>';
            } // if ($log->action=='provider_recommended') 
      


					// renderuj ticker
		            echo '<li>
				            <table>
				            	<tr>
						            <td class="feed-icon" style="background: '.$color.' ">
						            	<span>'.$icon.'</span>
						            </td>
						            <td class="feed-content">
						            	<b>'.$pre.' '.$user->username.'</b> '.$log_text.' | <span><i class="fa fa-clock-o"></i> '.\yii\timeago\TimeAgo::widget(['timestamp' => $log->time]).'</span>
						            </td>
						        </tr>
					        </table>
			            </li>';

	            } // foreach ($logs as $log) ?>	
			</ul>

		</div>