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
*/

//public routes in order of appearance in nav

Route::get('/home#_=_', function(){return redirect('home'); });
Route::get('/', function(){return redirect('home'); });
Route::get('/home', 'PublicController@home')->name('home');

Route::get('/search',function(){ return View('search'); })->name('search');
Route::get('/search-results','PublicController@search')->name('search-results');

Route::get('/users', 'PublicController@poets', function(){return redirect()->route('poets');});
Route::get('/poets', 'PublicController@poets')->name('poets');
Route::get('/poetry', 'PublicController@poetry')->name('poetry');
Route::get('/popular', 'PublicController@popular')->name('popular-poetry');
Route::get('/controversial', 'PublicController@controversial')->name('controversial-poetry');

Route::get('/genre','PublicController@showAllGenre')->name('genre');
Route::get('/genre/show/{tag}','PublicController@showPoemsInGenre')->name('genre-show');

Route::get('/poem/{id}', 'PublicController@poem')->name('poem-individual');
Route::get('/poet/{id}', 'PublicController@poet')->name('poet-individual');

Route::get('/eula', function(){ return view('license'); })->name('license');

//social logins

Route::get('/facebook', 'SocialAccountController@redirectToProvider')->name('facebook');
Route::get('/facebook/callback', 'SocialAccountController@handleProviderCallback');

Route::get('/linkedin', 'SocialAccountController@redirectToProvider')->name('linkedin');
Route::get('/linkedin/callback', 'SocialAccountController@handleProviderCallback');

//Private routes

Route::get('/mine','LoggedInController@showMine')->name('mine');
Route::get('/write', function () { return view('write'); })->name('write');
Route::get('/profile', 'LoggedInController@showProfile')->name('profile');
Route::any('/logout', 'LoggedInController@logout')->name('logout');

//Money routes
Route::get('/pay/{id}', 'MoneyController@licenseGet')->name('buy');
Route::post('/pay/complete', 'MoneyController@license')->name('pay');
Route::get('/paid/{id}', 'MoneyController@license')->name('paid');
Route::get('/paid/download/{id}', 'MoneyController@redownloadLicense')->name('redownload');

Route::get('/sponsor/{poet}/{amount}', 'MoneyController@sponsorGet')->name('sponsor');
Route::get('/sponsorship/complete', 'MoneyController@sponsor')->name('sponsored');
Route::get('/sponsorship/cancel/{id?}', 'MoneyController@cancelSponsor')->name('cancel');

//edit
Route::get('/poem/edit/{poem}', 'LoggedInController@editPoem')->name('poem-edit');
Route::put('/poem/edit/{poem}', "PoemController@update" )->name('poem-updater');
Route::get('/profile/edit', 'LoggedInController@editProfile')->name('profile-edit');
Route::get('/profile/stripe/connect', 'MoneyController@getAuthFromStripe')->name('connect-stripe');
Route::get('/profile/stripe/disconnect', 'MoneyController@deauthorizeStripe')->name('disconnect-stripe');

//complex routes
Route::feeds(); //rss

Route::resource('user', 'UserController');
Route::resource('poem', 'PoemController');
Auth::routes();

Route::stripeWebhooks('/stripe/webhooks');
