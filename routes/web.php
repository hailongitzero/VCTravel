<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/home', 'HomeController@index');

/* Index page route*/
Route::get('', 'IndexController@index');

/* Not found page route*/
Route::get('404', 'IndexController@notFoundPage');

/* About us page route*/
Route::get('pages/{id}', 'PagesController@getPagesRedirect');


/* Tour list page route*/
Route::get('tours', 'TourController@getTourList');

/* Tour group list page route*/
Route::get('tours/{id}', 'TourController@getTourListByGroup');

/* Tour detail page route*/
Route::get('tour-detail/{id}', 'TourController@getTourDetail');

/* News List */
Route::get('news', 'NewsController@getNewsList');

/* News Group List */
Route::get('news/{id}', 'NewsController@getNewsListGroup');

/* News Detail */
Route::get('news-detail/{id}', 'NewsController@getNewsDetail');

/* Guide List */
Route::get('guide', 'GuideController@getGuideList');

/* Guide List */
Route::get('guide-detail/{id}', 'GuideController@getGuideDetail');

/* Subscribe Email */
Route::post('/subsEmail', 'IndexController@regSubscribeEmail')->middleware('email');

/* Tour booking */
Route::post('tourBooking', 'TourController@tourBooking')->middleware('booking');

/* Tour review */
Route::post('/tourReview', 'TourController@tourReview')->middleware('review');

/* Admin Route */
Route::get('admin', function (){
    return view('admin.pages.dashboard');
});

Route::get('admin/tour-list', 'Admin\AdminTourController@getTourList');

//Insert Tour
Route::get('admin/tour-edit', 'Admin\AdminTourController@createTour');
//Update tour
Route::get('admin/tour-edit/{id}', 'Admin\AdminTourController@getTourDetail')->middleware('auth', 'admin');
//Tour Image Management
Route::get('admin/tour-image/{id}', 'Admin\AdminTourController@getTourImage');

//Edit tour
Route::POST('admin/tourEditor', 'Admin\AdminTourController@tourEditor');
//Update tour
Route::POST('admin/tourUpdate', 'Admin\AdminTourController@tourUpdate');