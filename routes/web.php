<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'App\Http\Controllers'
], function(){

    // non logged in
    Route::group([
        'middleware' => ['guest']
    ], function() {

        // registration
        Route::get('/register', 'Auth\RegisterController@show')->name('register');
        Route::post('/register', 'Auth\RegisterController@register')->name('register.perform');

        // logging in
        Route::get('/login', 'Auth\LoginController@show')->name('login');
        Route::post('/login', 'Auth\LoginController@login')->name('login.perform');

    });

    // only authenticated
    Route::group([
        'middleware' => ['auth']
    ], function() {

        // Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');

        Route::get('/pages', 'Admin\PagesController@show')->name('pages');

        Route::get('/pages/generate', 'Admin\GenerateController@page')->name('generate.page');
        Route::get('/pages/generate/batch', 'Admin\GenerateController@batch')->name('generate.batch');
        Route::post('/pages/generate/start', 'Admin\GenerateController@start')->name('generate.start');

        Route::get('/pages/humanize', 'Admin\HumanizeController@page')->name('humanize.page');
        Route::post('/pages/humanize/start', 'Admin\HumanizeController@start')->name('humanize.start');

        Route::get('/pages/translate', 'Admin\TranslateController@page')->name('translate.page');
        Route::post('/pages/translate/start', 'Admin\TranslateController@start')->name('translate.start');

        Route::get('/pages/image', 'Admin\ImageController@page')->name('image.page');
        Route::post('/pages/image/start', 'Admin\ImageController@start')->name('image.start');

        // Route::get('/pages/progress', 'Admin\GenerateController@progress')->name('generate.progress');


        // crud of PAGES
        // Route::resource('pages', Admin\PageController::class);


        Route::get('/gemini', 'GeminiController@show');
        Route::get('/amazon', 'AmazonController@show');

    });

    Route::get('/sitemap.xml', 'SitemapController@show');

    // localized
    Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeCookieRedirect', 'localizationRedirect' ]
    ], function() {

        Route::get('/', 'HomeController@show')->name('home');
        Route::get('/privacy', 'GeneralController@privacy')->name('privacy');
        Route::get('/search', 'SearchController@show')->name('search');
        Route::get('/category/{slug}', 'CategoryController@show')->name('category');
        Route::get('/tag/{slug}', 'TagController@show')->name('tag');
        Route::get('/{slug}', 'PageController@show')->name('page');

    });

    // ajax

});



