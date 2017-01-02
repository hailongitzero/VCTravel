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

/* Change locale code*/
Route::get('lang/{id}', 'IndexController@setLang');

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

Route::get('admin/tour-list', 'Admin\AdminTourController@getTourList')->middleware('auth', 'admin');
//Insert Tour
Route::get('admin/tour-edit', 'Admin\AdminTourController@createTour')->middleware('auth', 'admin');
//Update tour
Route::get('admin/tour-edit/{id}', 'Admin\AdminTourController@getTourDetail')->middleware('auth', 'admin');
//Edit tour
Route::POST('admin/tourEditor', 'Admin\AdminTourController@tourEditor')->middleware('auth', 'admin');
//Update tour
Route::POST('admin/tourUpdate', 'Admin\AdminTourController@tourUpdate')->middleware('auth', 'admin');

//News List
Route::get('admin/news-list', 'Admin\AdminNewsController@getNewsList')->middleware('auth', 'admin');
//News -- Add new
Route::get('admin/news-edit', 'Admin\AdminNewsController@createNews')->middleware('auth', 'admin');
//News -- Edit
Route::get('admin/news-edit/{id}', 'Admin\AdminNewsController@newsDetail')->middleware('auth', 'admin');
//News Editor
Route::POST('admin/newsEditor', 'Admin\AdminNewsController@newsEditor')->middleware('auth', 'admin');
//News Update
Route::POST('admin/newsUpdate', 'Admin\AdminNewsController@newsUpdate')->middleware('auth', 'admin');

//Slide List
Route::get('admin/slide-list', 'Admin\SlideController@getSlideList')->middleware('auth', 'admin');
//Slide -- Add new
Route::get('admin/slide-edit', 'Admin\SlideController@createSlide')->middleware('auth', 'admin');
//Slide -- Edit
Route::get('admin/slide-edit/{id}', 'Admin\SlideController@slideDetail')->middleware('auth', 'admin');
//Slide Editor
Route::POST('admin/slideEditor', 'Admin\SlideController@slideEditor')->middleware('auth', 'admin');
//Slide Update
Route::POST('admin/slideUpdate', 'Admin\SlideController@slideUpdate')->middleware('auth', 'admin');

//Page List
Route::get('admin/page-list', 'Admin\PagesController@getPagesList')->middleware('auth', 'admin');
//page edit
Route::get('admin/page-edit/{id}', 'Admin\PagesController@pageDetail')->middleware('auth', 'admin');
//page create
Route::get('admin/page-edit', 'Admin\PagesController@createPage')->middleware('auth', 'admin');
//page review
Route::get('page-review', 'Admin\PagesController@pageReview');

Auth::routes();


