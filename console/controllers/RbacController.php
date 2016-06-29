<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        //--------------RULES
        //Rule Presentation
        $presentationRule = new \common\rbac\PresentationRule();
        $auth->add($presentationRule);

        //Rule Order
        $orderRule = new \common\rbac\OrderRule();
        $auth->add($orderRule);

        //Rule Bid
        $bidRule = new \common\rbac\BidRule();
        $auth->add($bidRule);

        //Rule Post
        $postRule = new \common\rbac\PostRule();
        $auth->add($postRule);

        //Rule Booking
        $bookingRule = new \common\rbac\BookingRule();
        $auth->add($bookingRule);

        //Rule Promotion
        $promotionRule = new \common\rbac\PromotionRule();
        $auth->add($promotionRule);

        //Rule Event
        $eventRule = new \common\rbac\EventRule();
        $auth->add($eventRule);

        //Rule Message
        $messageRule = new \common\rbac\MessageRule();
        $auth->add($messageRule);

        //Rule Follow
        $followRule = new \common\rbac\FollowRule();
        $auth->add($followRule);

        //Rule User Profile
        $userProfileRule = new \common\rbac\UserProfileRule();
        $auth->add($userProfileRule);


        //-------------CREATE PERMISSIONS  
        //PROVIDERS
        //Permission to unfollow a provider
        $unfollowProvider = $auth->createPermission('unfollowProvider');
        $unfollowProvider->description = 'Unfollow Provider';
        $unfollowProvider->ruleName = $followRule->name;
        $auth->add($unfollowProvider);

        //PRESENTATIONS  
        //Permission to create a presentation
        $createPresentation = $auth->createPermission('createPresentation');
        $createPresentation->description = 'Create Presentations';
        $auth->add($createPresentation);

        //Permission to update a presentation
        $updatePresentation = $auth->createPermission('updatePresentation');
        $updatePresentation->description = 'Update Presentation';
        $auth->add($updatePresentation);

        //Permission to update own presentation
        $updateOwnPresentation = $auth->createPermission('updateOwnPresentation');
        $updateOwnPresentation->description = 'Update Own Presentation';
        $updateOwnPresentation->ruleName = $presentationRule->name;
        $auth->add($updateOwnPresentation);
        $auth->addChild($updateOwnPresentation, $updatePresentation);

        //Permission to unfollow a presentation
        $unfollowPresentation = $auth->createPermission('unfollowPresentation');
        $unfollowPresentation->description = 'Unfollow Presentation';
        $unfollowPresentation->ruleName = $followRule->name;
        $auth->add($unfollowPresentation);

        //ORDERS
        //Permission to create an order
        $createOrder = $auth->createPermission('createOrder');
        $createOrder->description = 'Create Orders';
        $auth->add($createOrder);

        //Permission to update an order
        $updateOrder = $auth->createPermission('updateOrder');
        $updateOrder->description = 'Update Order';
        $auth->add($updateOrder);

        //Permission to update own order
        $updateOwnOrder = $auth->createPermission('updateOwnOrder');
        $updateOwnOrder->description = 'Update Own Order';
        $updateOwnOrder->ruleName = $orderRule->name;
        $auth->add($updateOwnOrder);
        $auth->addChild($updateOwnOrder, $updateOrder);

        //Permission to unfollow an order
        $unfollowOrder = $auth->createPermission('unfollowOrder');
        $unfollowOrder->description = 'Unfollow Order';
        $unfollowOrder->ruleName = $followRule->name;
        $auth->add($unfollowOrder);

        //BIDS
        //Permission to update a bid
        $updateBid = $auth->createPermission('updateBid');
        $updateBid->description = 'Update Bid';
        $auth->add($updateBid);

        //Permission to update own bid
        $updateOwnBid = $auth->createPermission('updateOwnBid');
        $updateOwnBid->description = 'Update Own Bid';
        $updateOwnBid->ruleName = $bidRule->name;
        $auth->add($updateOwnBid);
        $auth->addChild($updateOwnBid, $updateBid);        

        //BOOKINGS
        //Permission to update a booking
        $updateBooking = $auth->createPermission('updateBooking');
        $updateBooking->description = 'Update Booking';
        $auth->add($updateBooking);

        //Permission to update own booking
        $updateOwnBooking = $auth->createPermission('updateOwnBooking');
        $updateOwnBooking->description = 'Update Own Booking';
        $updateOwnBooking->ruleName = $bookingRule->name;
        $auth->add($updateOwnBooking);
        $auth->addChild($updateOwnBooking, $updateBooking);

        //POSTS  
        //Permission to create a post
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create Posts';
        $auth->add($createPost);

        //Permission to update a post
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update Post';
        $auth->add($updatePost);

        //Permission to update own post
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update Own Post';
        $updateOwnPost->ruleName = $postRule->name;
        $auth->add($updateOwnPost);
        $auth->addChild($updateOwnPost, $updatePost);

        //Permission to unfollow a post
        $unfollowPost = $auth->createPermission('unfollowPost');
        $unfollowPost->description = 'Unfollow Post';
        $unfollowPost->ruleName = $followRule->name;
        $auth->add($unfollowPost);

        //PROMOTIONS  
        //Permission to create a promotion
        $createPromotion = $auth->createPermission('createPromotion');
        $createPromotion->description = 'Create Promotions';
        $auth->add($createPromotion);

        //Permission to update a promotion
        $updatePromotion = $auth->createPermission('updatePromotion');
        $updatePromotion->description = 'Update Promotion';
        $auth->add($updatePromotion);

        //Permission to update own promotion
        $updateOwnPromotion = $auth->createPermission('updateOwnPromotion');
        $updateOwnPromotion->description = 'Update Own Promotion';
        $updateOwnPromotion->ruleName = $promotionRule->name;
        $auth->add($updateOwnPromotion);
        $auth->addChild($updateOwnPromotion, $updatePromotion);

        //Permission to unfollow a promotion
        $unfollowPromotion = $auth->createPermission('unfollowPromotion');
        $unfollowPromotion->description = 'Unfollow Promotion';
        $unfollowPromotion->ruleName = $followRule->name;
        $auth->add($unfollowPromotion);

        //EVENTS  
        //Permission to create an event
        $createEvent = $auth->createPermission('createEvent');
        $createEvent->description = 'Create Events';
        $auth->add($createEvent);

        //Permission to update an event
        $updateEvent = $auth->createPermission('updateEvent');
        $updateEvent->description = 'Update Event';
        $auth->add($updateEvent);

        //Permission to update own event
        $updateOwnEvent = $auth->createPermission('updateOwnEvent');
        $updateOwnEvent->description = 'Update Own Event';
        $updateOwnEvent->ruleName = $eventRule->name;
        $auth->add($updateOwnEvent);
        $auth->addChild($updateOwnEvent, $updateEvent);

        //Permission to unfollow an event
        $unfollowEvent = $auth->createPermission('unfollowEvent');
        $unfollowEvent->description = 'Unfollow Event';
        $unfollowEvent->ruleName = $followRule->name;
        $auth->add($unfollowEvent);

        //SERVICES
        //Permission to unfollow a service
        $unfollowService = $auth->createPermission('unfollowService');
        $unfollowService->description = 'Unfollow Service';
        $unfollowService->ruleName = $followRule->name;
        $auth->add($unfollowService);

        //MESSAGES
        //Permission to manage messages
        $manageMessage = $auth->createPermission('manageMessage');
        $manageMessage->description = 'Manage Messages';
        $manageMessage->ruleName = $messageRule->name;
        $auth->add($manageMessage);

        //USER PROFILE
        //Permission to update a user profile
        $updateUserProfile = $auth->createPermission('updateUserProfile');
        $updateUserProfile->description = 'Update User Profile';
        $auth->add($updateUserProfile);

        //Permission to update own profile
        $updateOwnUserProfile = $auth->createPermission('updateOwnUserProfile');
        $updateOwnUserProfile->description = 'Update Own Profile';
        $updateOwnUserProfile->ruleName = $userProfileRule->name;
        $auth->add($updateOwnUserProfile);
        $auth->addChild($updateOwnUserProfile, $updateUserProfile);

        //CORE DATABASE
        //Permission to update the core database
        $manageCoreDatabase = $auth->createPermission('manageCoreDatabase');
        $manageCoreDatabase->description = 'Manage Core Database';
        $auth->add($manageCoreDatabase);

        //APPLICATION
        //Permission to update application
        $manageApplication = $auth->createPermission('manageApplication');
        $manageApplication->description = 'Manage Application';
        $auth->add($manageApplication);


        //---------------------ROLES
        //Role User
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $unfollowService);
        $auth->addChild($user, $unfollowEvent);
        $auth->addChild($user, $unfollowPromotion);
        $auth->addChild($user, $unfollowPost);
        $auth->addChild($user, $unfollowOrder);
        $auth->addChild($user, $unfollowPresentation);
        $auth->addChild($user, $unfollowProvider);
        $auth->addChild($user, $createOrder);
        $auth->addChild($user, $updateOwnOrder);
        $auth->addChild($user, $updateOwnBooking);
        $auth->addChild($user, $updateOwnUserProfile);
        $auth->addChild($user, $updateOwnPost);
        $auth->addChild($user, $manageMessage);


        //Role Provider
        $provider = $auth->createRole('provider');
        $auth->add($provider);
        $auth->addChild($provider, $user);
        $auth->addChild($provider, $createPresentation);
        $auth->addChild($provider, $createPromotion);
        $auth->addChild($provider, $createEvent);
        $auth->addChild($provider, $updateOwnPresentation);
        $auth->addChild($provider, $updateOwnPromotion);
        $auth->addChild($provider, $updateOwnBid);
        $auth->addChild($provider, $updateOwnEvent);

        //Role Editor
        $editor = $auth->createRole('editor');
        $auth->add($editor);
        $auth->addChild($editor, $provider);
        $auth->addChild($editor, $createPost);

        //Role Moderator
        $moderator = $auth->createRole('moderator');
        $auth->add($moderator);
        $auth->addChild($moderator, $editor);
        $auth->addChild($moderator, $updateOrder);
        $auth->addChild($moderator, $updateBooking);
        $auth->addChild($moderator, $updateBid);
        $auth->addChild($moderator, $updatePresentation);
        $auth->addChild($moderator, $updatePromotion);
        $auth->addChild($moderator, $updatePost);
        $auth->addChild($moderator, $updateEvent);

        //Role Admin
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $moderator);
        $auth->addChild($admin, $updateUserProfile);
        $auth->addChild($admin, $manageCoreDatabase);

        //Role Owner
        $owner = $auth->createRole('owner');
        $auth->add($owner);
        $auth->addChild($owner, $admin);  
        $auth->addChild($owner, $manageApplication);        
    }
}