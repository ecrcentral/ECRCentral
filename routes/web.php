<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| Middleware options can be located in `app/Http/Kernel.php`
|
*/


// Authentication Routes
Auth::routes();

// sitemap Routes
Route::get('sitemap', function() {
    // create new sitemap object
    $sitemap = App::make('sitemap');

    // set cache key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean)
    // by default cache is disabled
    $sitemap->setCache('ecrcental.sitemap', 60);

    // check if there is cached sitemap and build new only if is not
    if (!$sitemap->isCached()) {
        // add item to the sitemap (url, date, priority, freq)
        $sitemap->add(URL::to('/'), '2019-01-25T20:10:00+02:00', '1.0', 'daily');
        $sitemap->add(URL::to('forum'), '2019-01-25T20:10:00+02:00', '1.0', 'hourly');
        $sitemap->add(URL::to('funders'), '2019-01-25T20:10:00+02:00', '1.0', 'monthly');

        $sitemap->add(URL::to('resources'), '2019-01-25T20:10:00+02:00', '1.0', 'weekly');
        // get all resources from db
        $resources = DB::table('resources')->where('status', 1)->orderBy('created_at', 'desc')->get();
        // add every resource to the sitemap
        foreach ($resources as $resource) {
            $sitemap->add(URL::to('resources')."/".$resource->slug, $resource->updated_at, '0.5', 'monthly');
        }

        $sitemap->add(URL::to('travel-grants'), '2019-01-25T20:10:00+02:00', '1.0', 'weekly');
        // get all travelgrants from db
        $travelgrants = DB::table('travel_grants')->where('status', 1)->orderBy('created_at', 'desc')->get();
        // add every travelgrants to the sitemap
        foreach ($travelgrants as $travelgrant) {
            $sitemap->add(URL::to('travel-grants')."/".$travelgrant->slug, $travelgrant->updated_at, '0.5', 'monthly');
        }

        $sitemap->add(URL::to('fundings'), '2019-01-25T20:10:00+02:00', '1.0', 'weekly');
        // get all funding from db
        $fundings = DB::table('fundings')->where('status', 1)->orderBy('created_at', 'desc')->get();
        // add every funding to the sitemap
        foreach ($fundings as $funding) {
            $sitemap->add(URL::to('fundings')."/".$funding->slug, $funding->updated_at, '0.5', 'monthly');
        }
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');
});

Route::get('resources/feed', function(){

    // create new feed
    $feed = App::make("feed");

    // multiple feeds are supported
    // if you are using caching you should set different cache keys for your feeds

    // cache the feed for 60 minutes (second parameter is optional)
    $feed->setCache(60, 'ECRcentralResourcesFeedKey');

    // check if there is cached feed and build new only if is not
    if (!$feed->isCached())
    {
       // creating rss feed with our most recent 20 resources
       $resources = \DB::table('resources')->where('status',1)->orderBy('created_at', 'desc')->take(20)->get();

       // set your feed's title, description, link, pubdate and language
       $feed->title = 'Resources for ECRs - ECRcentral ';
       $feed->description = 'A community curated catalog of useful resources for early career researchers';
       $feed->logo = 'https://ecrcentral.org/images/logo.png';
       $feed->link = url('feed');
       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
       $feed->pubdate = $resources[0]->created_at;
       $feed->lang = 'en';
       $feed->setShortening(true); // true or false
       $feed->setTextLimit(100); // maximum length of description text

       foreach ($resources as $resource)
       {
           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add($resource->name, 'ECRcentral', URL::to('resources/'.$resource->slug), $resource->created_at, $resource->description, $resource->description);
       }

    }

    // first param is the feed format
    // optional: second param is cache duration (value of 0 turns off caching)
    // optional: you can set custom cache key with 3rd param as string
    return $feed->render('atom');

    // to return your feed as a string set second param to -1
    // $xml = $feed->render('atom', -1);
});

Route::get('fundings/feed', function(){

    // create new feed
    $feed = App::make("feed");

    // multiple feeds are supported
    // if you are using caching you should set different cache keys for your feeds

    // cache the feed for 60 minutes (second parameter is optional)
    $feed->setCache(60, 'ECRcentralFundingsFeedKey');

    // check if there is cached feed and build new only if is not
    if (!$feed->isCached())
    {
       // creating rss feed with our most recent 20 funding
       $fundings = \DB::table('fundings')->where('status',1)->orderBy('created_at', 'desc')->take(20)->get();

       // set your feed's title, description, link, pubdate and language
       $feed->title = 'Funding schemes and fellowships for ECRs - ECRcentral ';
       $feed->description = 'A community curated catalog of funding schemes and fellowships for early career researchers';
       $feed->logo = 'https://ecrcentral.org/images/logo.png';
       $feed->link = url('feed');
       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
       $feed->pubdate = $fundings[0]->created_at;
       $feed->lang = 'en';
       $feed->setShortening(true); // true or false
       $feed->setTextLimit(100); // maximum length of description text

       foreach ($fundings as $funding)
       {
           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add($funding->name, 'ECRcentral', URL::to('fundings/'.$funding->slug), $funding->created_at, $funding->description, $funding->funder_name);
       }

    }

    // first param is the feed format
    // optional: second param is cache duration (value of 0 turns off caching)
    // optional: you can set custom cache key with 3rd param as string
    return $feed->render('atom');

    // to return your feed as a string set second param to -1
    // $xml = $feed->render('atom', -1);

});

Route::get('travel-grants/feed', function(){

    // create new feed
    $feed = App::make("feed");

    // multiple feeds are supported
    // if you are using caching you should set different cache keys for your feeds

    // cache the feed for 60 minutes (second parameter is optional)
    $feed->setCache(60, 'ECRcentralTravelgrantsFeedKey');

    // check if there is cached feed and build new only if is not
    if (!$feed->isCached())
    {
       // creating rss feed with our most recent 20 funding
       $travelgrants = \DB::table('travel_grants')->where('status',1)->orderBy('created_at', 'desc')->take(20)->get();

       // set your feed's title, description, link, pubdate and language
       $feed->title = 'Travel grants for ECRs - ECRcentral ';
       $feed->description = 'A community curated catalog of travel grants for early career researchers';
       $feed->logo = 'https://ecrcentral.org/images/logo.png';
       $feed->link = url('feed');
       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
       $feed->pubdate = $travelgrants[0]->created_at;
       $feed->lang = 'en';
       $feed->setShortening(true); // true or false
       $feed->setTextLimit(100); // maximum length of description text

       foreach ($travelgrants as $travelgrant)
       {
           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
           $feed->add($travelgrant->name, 'ECRcentral', URL::to('travel-grants/'.$travelgrant->slug), $travelgrant->created_at, $travelgrant->description, $travelgrant->funder_name);
       }

    }

    // first param is the feed format
    // optional: second param is cache duration (value of 0 turns off caching)
    // optional: you can set custom cache key with 3rd param as string
    return $feed->render('atom');

    // to return your feed as a string set second param to -1
    // $xml = $feed->render('atom', -1);

});


// Public Routes
Route::group(['middleware' => ['web', 'activity']], function () {

    // Static pages routes
    Route::get('/', 'PagesController@index')->name('index');
    Route::get('/about', 'PagesController@about')->name('about');
    Route::get('/team', 'PagesController@team')->name('team');
    Route::get('/privacy', 'PagesController@privacy')->name('privacy');
    Route::get('/terms', 'PagesController@terms')->name('terms');

    Route::get('/contact', 'PagesController@contact')->name('contact');
    Route::get('/get-involved', 'PagesController@get_involved')->name('getinvolved');

    Route::get('/community', 'PagesController@community_all')->name('community_all');
    Route::get('community/{rolename}s', [
        'as'   => '{rolename}',
        'uses' => 'PagesController@community',
    ]);
    Route::get('/moderators', 'PagesController@moderators')->name('moderators');

    // Route::get('/{slug}', [
    //     'as'   => '{slug}',
    //     'uses' => 'PagesController@show',
    // ]);


    // Activation Routes
    Route::get('/activate', ['as' => 'activate', 'uses' => 'Auth\ActivateController@initial']);

    Route::get('/activate/{token}', ['as' => 'authenticated.activate', 'uses' => 'Auth\ActivateController@activate']);
    Route::get('/activation', ['as' => 'authenticated.activation-resend', 'uses' => 'Auth\ActivateController@resend']);
    Route::get('/exceeded', ['as' => 'exceeded', 'uses' => 'Auth\ActivateController@exceeded']);

    // Socialite Register Routes
    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\SocialController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses' => 'Auth\SocialController@getSocialHandle']);

    // Route to for user to reactivate their user deleted account.
    Route::get('/re-activate/{token}', ['as' => 'user.reactivate', 'uses' => 'RestoreUserController@userReActivate']);

    // Fundings Route
    Route::resource(
        'fundings',
        'FundingsController', [
            'only' => [
                'show',
                //'edit',
                //'update',
                'create',
            ],
        ]
    );

    Route::get('/fundings', 'FundingsController@index')->name('fundings');
    Route::get('fundings/{id}', [
        'as'   => '{id}',
        'uses' => 'FundingsController@show',
    ]);

    Route::post('fundings/create','FundingsController@store')->name('fundings.store');

    
    // Funders Route
    Route::get('/funders', 'FundersController@index')->name('funders');
    Route::get('funders/{id}', [
        'as'   => '{id}',
        'uses' => 'FundersController@show',
    ]);



    // Travel grants Route
    Route::resource(
        'travel-grants',
        'TravelGrantsController', [
            'only' => [
                'show',
                //'edit',
                //'update',
                'create',
            ],
        ]
    );

    Route::get('/travel-grants', 'TravelGrantsController@index')->name('travelgrants');
    Route::get('travel-grants/{id}', [
        'as'   => '{id}',
        'uses' => 'TravelGrantsController@show',
    ]);

    Route::post('travel-grants/create','TravelGrantsController@store')->name('travelgrants.store');



     // Resources Route
    Route::resource(
        'resources',
        'ResourcesController', [
            'only' => [
                'show',
                //'edit',
                //'update',
                'create',
            ],
        ]
    );

    Route::get('/resources', 'ResourcesController@index')->name('resources');
    Route::get('resources/{id}', [
        'as'   => '{id}',
        'uses' => 'ResourcesController@show',
    ]);

    Route::post('resources/create','ResourcesController@store')->name('resources.store');


    // Blog Route

    Route::get('/blog', 'PostsController@index')->name('posts');

    Route::get('blog/category/{category_slug}', [
        'as'   => '{category_slug}',
        'uses' => 'PostsController@index_category',
    ]);

    Route::get('blog/{id}', [
        'as'   => '{id}',
        'uses' => 'PostsController@show',
    ]);


    // Route to show user avatar
    Route::get('images/profile/{id}/avatar/{image}', [
        #'uses' => 'ProfilesController@userProfileAvatar',
        'uses' => 'PagesController@userProfileAvatar',
    ]);

    Route::get('storage/images/profile/{id}/avatar/{image}', [
        #'uses' => 'ProfilesController@userProfileAvatar',
        'uses' => 'PagesController@userProfileAvatar',
    ]);

});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity']], function () {

    // Activation Routes
    Route::get('/activation-required', ['uses' => 'Auth\ActivateController@activationRequired'])->name('activation-required');
    Route::get('/logout', ['uses' => 'Auth\LoginController@logout'])->name('logout');
});

// Registered and Activated User Routes
Route::group(['middleware' => ['auth', 'activated', 'activity', 'twostep']], function () {

    //  Homepage Route - Redirect based on user role is in controller.
    #Route::get('/home', ['as' => 'public.home',   'uses' => 'UserController@index']);
    Route::get('/home', ['as' => 'public.home',   'uses' => 'PagesController@index']);

    // Show users profile - viewable by other users.
    Route::get('profile/{username}', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@show',
    ]);
});

// Registered, activated, and is current user routes.
Route::group(['middleware' => ['auth', 'activated', 'currentUser', 'activity', 'twostep']], function () {

    // User Profile and Account Routes
    Route::resource(
        'profile',
        'ProfilesController', [
            'only' => [
                'show',
                'edit',
                'update',
                'create',
            ],
        ]
    );
    Route::put('profile/{username}/updateUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserAccount',
    ]);
    Route::put('profile/{username}/updateUserPassword', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@updateUserPassword',
    ]);
    Route::delete('profile/{username}/deleteUserAccount', [
        'as'   => '{username}',
        'uses' => 'ProfilesController@deleteUserAccount',
    ]);

    

    // Route to upload user avatar.
    Route::post('avatar/upload', ['as' => 'avatar.upload', 'uses' => 'ProfilesController@upload']);
    

});

// Registered, activated, and is admin routes.
Route::group(['middleware' => ['auth', 'activated', 'role:admin', 'activity', 'twostep']], function () {
#Route::group(['middleware' => ['role:admin']], function () {

    Route::resource('/users/deleted', 'SoftDeletesController', [
        'only' => [
            'index', 'show', 'update', 'destroy',
        ],
    ]);

    Route::resource('users', 'UsersManagementController', [
        'names' => [
            'index'   => 'users',
            'destroy' => 'user.destroy',
        ],
        'except' => [
            'deleted',
        ],
    ]);

    Route::resource('themes', 'ThemesManagementController', [
        'names' => [
            'index'   => 'themes',
            'destroy' => 'themes.destroy',
        ],
    ]);

    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
    Route::get('routes', 'AdminDetailsController@listRoutes');
    Route::get('active-users', 'AdminDetailsController@activeUsers');


    #Fundings route
    Route::get('fundings/{id}/edit', [
        'as'   => '{id}',
        'uses' => 'FundingsController@edit',
    ]);

    Route::put('fundings/{id}/update', [
        'as'   => '{id}',
        'uses' => 'FundingsController@update',
    ]);

    Route::delete('fundings/{id}', [
        'as'   => '{id}',
        'uses' => 'FundingsController@destroy',
    ]);

    #Funders route
    Route::get('funders/{id}/edit', [
        'as'   => '{id}',
        'uses' => 'FundersController@edit',
    ]);

    Route::put('funders/{id}/update', [
        'as'   => '{id}',
        'uses' => 'FundersController@update',
    ]);

    Route::delete('funders/{id}', [
        'as'   => '{id}',
        'uses' => 'FundersController@destroy',
    ]);


    #Travel grants route
    Route::get('travel-grants/{id}/edit', [
        'as'   => '{id}',
        'uses' => 'TravelGrantsController@edit',
    ]);

    Route::put('travel-grants/{id}/update', [
        'as'   => '{id}',
        'uses' => 'TravelGrantsController@update',
    ]);

    Route::delete('travel-grants/{id}', [
        'as'   => '{id}',
        'uses' => 'TravelGrantsController@destroy',
    ]);
  
});

//Route::redirect('/php', '/phpinfo', 301);

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});


