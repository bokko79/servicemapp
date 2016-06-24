<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'baseUrl' => 'http://servicemapp/',
    'scriptUrl' => 'http://servicemapp/',
    'rules' => [
        // DEKTRIUM USER
        '<module:user>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
        '<module:user>/<action:\w+>' => '<module>/<controller>/<action>',

        'login' => 'user/security/login', // :page
        'logout' => 'user/security/logout',
        'register' => 'user/registration/register', // :page
        'register-provider' => 'user/registration/register-provider', // :page
        'recovery' => 'user/recovery/request', // :page  

        // ACTIVITIES
        'market' => 'activities/index', // :page
        '' => 'activities/index', // :page

        // BIDS
        'new-bid' => 'bids/create', // :page
        'bid/<id:\d+>' => 'bids/view', // :page
        'bid-setup/<id:\d+>' => 'bids/update', // :page

        // BOOKINGS
        'new-booking' => 'bookings/create', // :page
        'booking/<id:\d+>' => 'bookings/view', // :page
        'booking-setup/<id:\d+>' => 'bookings/update', // :page

        // FEEDBACK
        'feedback' => 'feedback/create', // :page

        // INDUSTRIES
        'industries' => 'industries/index', // :page
        'i/<title>' => 'industries/view', // :page

        // INTRO
        'intro' => 'intro/main', // :page

        // MESSAGES
        //'new-message' => 'message-threads/create', // :page
        '<username:\w+>/inbox' => 'messages/index', // :page
        //'message-thread/<id:\d+>' => 'message-threads/view', // :page

        // NOTIFICATIONS
        '<username:\w+>/notifications' => 'notifications/index', // :page

        // OBJECTS
        'objects' => 'objects/index', // :page
        'o/<title>' => 'objects/view', // :page

        // ORDERS
        'choose-models' => 'orders/models', // :page
        'add/<title>' => 'orders/add', // :page
        'new-order' => 'orders/create', // :page
        'order/<id:\d+>' => 'orders/view', // :page
        'order-setup/<id:\d+>' => 'orders/update', // :page        
        'empty-cart' => 'orders/empty-cart', // :action

        // POSTS             
        'info' => 'posts/index', // :page
        'new-post' => 'posts/create', // :page
        'post/<id:\d+>' => 'posts/view', // :page  
        'post-setup/<id:\d+>' => 'posts/update', // :page  
        'info-categories' => 'posts/categories', // :page
        'info-contents' => 'posts/contents', // :page

        // PRESENTATIONS
        'new-presentation' => 'presentations/create', // :page
        'presentation/<id:\d+>/object' => 'presentations/create-object', // :page
        'presentation/<id:\d+>/action' => 'presentations/create-action', // :page
        'presentations' => 'presentations/index', // :page
        'presentation/<id:\d+>/summary' => 'presentations/summary', // :page
        'presentation/<id:\d+>/setup' => 'presentations/update', // :page
        'presentation/<id:\d+>' => 'presentations/view', // :page
        'comment-presentation/<id:\d+>' =>'presentations/comment',
        'showThemSpecs' =>'presentations/show-them-specs', // ajax
        'showThemPics' =>'presentations/show-them-pics', // ajax
        'showThemMethods' =>'presentations/show-them-methods', // ajax
        
        // PRODUCTS
        'products' => 'products/index', // :page
        'product/<title>' => 'products/view', // :page
        'product-compare/<title>-<title2>' => 'products/compare', // :page

        // PROMOTIONS
        'new-promotion' => 'promotions/create', // :page
        'promotion/<id:\d+>' => 'promotions/view', // :page
        'promotion-setup/<id:\d+>' => 'promotions/update', // :page

        // PROVIDER
        'providers' => 'provider/index', // :page
        'p/<username:\w+>' =>'provider/view', // :page
        'recommend/<id:\d+>' =>'provider/recommend',
        'review/<id:\d+>' =>'provider/review',
        'rate/<id:\d+>' =>'provider/rate',
        '<username:\w+>/portfolio-setup' => 'provider/update', // :page
        '<username:\w+>/bids' => 'provider/bids', // :page
        '<username:\w+>/presentations' => 'provider/presentations', // :page
        '<username:\w+>/promotions' => 'provider/promotions', // :page

        // PROVIDER INDUSTRIES
        'new-industry' => 'provider-industries/create', // :page
        '<username:\w+>/industries' => 'provider-industries/index', // :page
        'industry-setup/<id:\d+>' => 'provider-industries/update', // :page

        // PROVIDER SERVICES
        //'new-service' => 'provider-services/create', // :page
        '<username:\w+>/services' => 'provider-services/index', // :page
        'my-service-setup/<id:\d+>' => 'provider-services/update', // :page
        'provider-industries' => 'provider-services/industries', // :page
        //'provider-industry-skills' => 'provider-services/skills', // :page
        //'provider-industry-services' => 'provider-services/services', // :page

        // PROVIDER SKILLS
        'new-skill' => 'provider-skills/create', // :page
        '<username:\w+>/skills' => 'provider-skills/index', // :page
        'skill-setup/<id:\d+>' => 'provider-skills/update', // :page

         // PROVIDER TERMS
        '<username:\w+>/terms' => 'provider-terms/index', // :page
        '<username:\w+>/terms-setup' => 'provider-terms/update', // :page

        // SERVICES
        'add-services' => 'services/add', // :page
        'services' => 'services/index', // :page
        'services/<entity>/<title>' => 'services/index', // :page
        's/<title>' => 'services/view', // :page
        'presentation-oms/<title>' => 'services/presentation-oms', // ajax
        'objectModelsOrder' => 'services/object-models-order', // ajax

        // SITE
        'index' => 'site/index',
        //'about-us' => 'site/about', // :page
        'alert' => 'site/alert', // :page
        'checkout' => 'site/checkout', // :page
        'contact-us' => 'site/contact', // :page
        'deposit' => 'site/deposit', // :page
        'referral' => 'site/invite', // :page
        'membership' => 'site/membership', // :page
        'suggest' => 'site/suggest', // :page
        'transfer' => 'site/transfer', // :page
        'withdraw' => 'site/withdraw', // :page

        // TRANSACTIONS
        'new-transaction' => 'transactions/create', // :page
        '<username:\w+>/transactions' => 'transactions/index', // :page
        'transaction/<id:\d+>' => 'transactions/view', // :page

        // USER
        '<username:\w+>/home' => 'users/view',
        '<username:\w+>/setup' => 'users/update',
        '<username:\w+>/account-setup' => 'users/account',
        '<username:\w+>/orders' => 'users/orders',
        '<username:\w+>/preorders' => 'users/preorders',
        '<username:\w+>/bookings' => 'users/bookings',
        '<username:\w+>/profile' => 'users/profile',
        '<username:\w+>/finances' => 'users/finances',

        // USER LOCATIONS
        'new-location' => 'user-locations/create', // :page
        '<username:\w+>/locations' => 'user-locations/index', // :page
        'location-setup/<id:\d+>' => 'user-locations/update', // :page

        // USER OBJECTS
        'new-object' => 'user-objects/create', // :page
        '<username:\w+>/objects' => 'user-objects/index', // :page
        'object-setup/<id:\d+>' => 'user-objects/update', // :page

        // USER NOTIFICATIONS
        '<username:\w+>/notifications-setup' => 'user-notifications/update', // :page       

        // USER PAYMENTS
        'new-payment' => 'user-payments/create', // :page
        'payment-setup/<id:\d+>' => 'user-payments/update', // :page
        '<username:\w+>/payments' => 'user-payments/index', // :page

        // USER SERVICES
        '<username:\w+>/follow-services' => 'user-services/index', // :page

        // GLOBAL-NAV
        'glob-ind-ser' => 'global-nav/glob-ind-ser',
        'glob-nav-events-body' => 'global-nav/glob-nav-events-body',
        'glob-nav-events-head' => 'global-nav/glob-nav-events-head',
        'glob-nav-market-body' => 'global-nav/glob-nav-market-body',
        'glob-nav-market-head' => 'global-nav/glob-nav-market-head',
        'glob-nav-providers-body' => 'global-nav/glob-nav-providers-body',
        'glob-nav-providers-head' => 'global-nav/glob-nav-providers-head',
        'glob-nav-services-body' => 'global-nav/glob-nav-services-body',
        'glob-nav-services-head' => 'global-nav/glob-nav-services-head',
        'ind/<id:\d+>' => 'global-nav/ind',
        'getid' => 'global-nav/getid',
        //'list-act-services' => 'global-nav/list-act-services',
        //'list-ind-actions' => 'global-nav/list-ind-actions',
        'glob-nav-act-services' => 'global-nav/act-services',
        'glob-nav-ser-objects' => 'global-nav/service-objects',

        // AUTOCOMPLETE
        'auto/list-act-services' => 'autocomplete/list-act-services',
        'auto/list-ind-actions' => 'autocomplete/list-ind-actions',
        'auto/list-services' => 'autocomplete/list-services',
        'auto/list-industries' => 'autocomplete/list-industries',
        'auto/list-actions' => 'autocomplete/list-actions',
        'auto/list-objects' => 'autocomplete/list-objects',
        'auto/list-products' => 'autocomplete/list-products',
        'auto/list-providers' => 'autocomplete/list-providers',
        'auto/list-tags' => 'autocomplete/list-tags',
        'auto/list-services-tags' => 'autocomplete/list-services-tags',
        'auto/list-industries-tags' => 'autocomplete/list-industries-tags',
        'auto/list-actions-tags' => 'autocomplete/list-actions-tags',
        'auto/list-objects-tags' => 'autocomplete/list-objects-tags',
        'auto/index' => 'autocomplete/index',
    ],
];