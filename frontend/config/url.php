<?php

return [
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'baseUrl' => '',
    'scriptUrl' => 'http://servicemappadv.localhost',
    'rules' => [
        'intro' => 'intro/main',    
        'index' => 'site/index',
        'about-us' => 'site/about', // :page
        'contact-us' => 'site/contact', // :page
        'invite-friends' => 'site/invite', // :page
        'membership' => 'site/membership', // :page
        'search' => 'site/search', // :page

        // 2. POSTS             
        'info' => 'posts/index', // :page
        'post/<id:\d+>' => 'posts/view', // :page  

        // 3. USER
        'users' => 'user/index',
        '<username:\w+>/home' => 'user/view',
        '<username:\w+>/setup' => 'user/update',        

        // 4 PROVIDER
        'providers' => 'provider/index', // :page
        'p/<proname:\w+>' =>'provider/view', // :page
        'recommend/<id:\d+>' =>'provider/recommend',
        'review/<id:\d+>' =>'provider/review',
        'rate/<id:\d+>' =>'provider/rate',

        // 5 PROVIDERSERVICES
        'new-providerService' => 'provider-services/create', // :page
        '<providername:\w+>/my-services' => 'provider-services/index', // :page
        'my-service-setup/<id:\d+>' => 'provider-services/update', // :page
        '<providername:\w+>/service/<id:\d+>' => 'provider-services/view', // :page
        'comment-proservice/<id:\d+>' =>'provider-services/comment',

        // 6 USERLOCATIONS
        'new-location' => 'user-locations/create', // S-16:page
        '<username:\w+>/locations' => 'user-locations/index', // S-16:page
        'location-setup/<id:\d+>' => 'user-locations/update', // S-16:page

        // 7 USEROBJECTS
        'new-object' => 'user-objects/create', // S-16:page
        '<username:\w+>/objects' => 'user-objects/index', // S-16:page
        'object-setup/<id:\d+>' => 'user-objects/update', // S-16:page

        // 8 USER NOTIFICATIONS
        '<username:\w+>/notifications-setup' => 'user-notifications/update', // S-16:page
        '<username:\w+>/notifications' => 'notifications/index', // S-16:page

        // 9 USER PAYMENTS
        'new-payment' => 'user-payments/create', // S-16:page
        'payment-setup/<id:\d+>' => 'user-payments/update', // S-16:page
        '<username:\w+>/payments' => 'user-payments/index', // S-16:page

        // 10 TRANSACTIONS
        'new-transaction' => 'transactions/create', // S-16:page
        '<username:\w+>/transactions' => 'transactions/index', // S-16:page
        'transaction/<id:\d+>' => 'transactions/view', // S-16:page

        // 11 MESSAGE THREADS
        'new-message' => 'message-threads/create', // S-16:page
        '<username:\w+>/messages' => 'message-threads/index', // S-16:page
        'message-thread/<id:\d+>' => 'message-threads/view', // S-16:page

        // 12 SERVICES
        'add-services' => 'services/add', // :page
        'services' => 'services/index', // :page
        's/<title>' => 'services/view', // :page

        // 13 OBJECTS
        'add-objects' => 'objects/add', // :page

        // 14 ACTIVITIES AND FEEDBACK
        'market' => 'activities/index', // E-31:page
        '' => 'activities/index', // E-31:page
        'new-feedback' => 'feedback/create', // :page
        'feedback/<id:\d+>' => 'feedback/view', // :page

        // 15 ORDERS
        'add/<title>' => 'orders/add', // :page
        'new-order' => 'orders/create', // :page
        'order/<id:\d+>' => 'orders/view', // :page
        'order-setup/<id:\d+>' => 'orders/update', // :page        

        // 16 BIDS
        'new-bid' => 'bids/create', // S-16:page
        'bid/<id:\d+>' => 'bids/view', // S-16:page
        'bid-setup/<id:\d+>' => 'bids/update', // S-16:page

        // 17 PROMOTIONS
        'new-promotion' => 'promotions/create', // S-16:page
        'promotion/<id:\d+>' => 'promotions/view', // S-16:page
        'promotion-setup/<id:\d+>' => 'promotions/update', // S-16:page

        // 18 AGREEMENTS
        'new-agreement' => 'agreements/create', // S-16:page
        'agreement/<id:\d+>' => 'agreements/view', // S-16:page
        'agreement-setup/<id:\d+>' => 'agreements/update', // S-16:page

        // 19 GLOBAL-NAV
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

        // 20 AUTOCOMPLETE
        'auto/list-act-services' => 'autocomplete/list-act-services',
        'auto/list-ind-actions' => 'autocomplete/list-ind-actions',
        'auto/list-services' => 'autocomplete/list-services',
    ],
];