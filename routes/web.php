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

<<<<<<< HEAD
    Route::get('/community', 'PagesController@community')->name('community');
=======
    Route::get('/community', 'PagesController@community_all')->name('community_all');
    Route::get('community/{rolename}s', [
        'as'   => '{rolename}',
        'name' => 'community',
        'uses' => 'PagesController@community',
    ]);
>>>>>>> f7a1f6ea2146becbbe2e2ecd5bf998585a68c503
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


