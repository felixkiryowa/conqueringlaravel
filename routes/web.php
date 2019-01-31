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

/*Route::get('/', function () {
    return view('welcome');
});
*/

/*
Route::get('/hello', function () {
    return '<h1>Hello World</h1>';
});
Route::get('/about',function(){
    return view ('pages/about');
});

*/

Route::get('/','pagesController@index'); 
Route::get('/about','pagesController@about');
Route::get('/services','pagesController@services');
Route::resource('posts','postsController');
Route::get('/current','postsController@getcurrentUser');
Route::get('/try','postsController@try');
//ajax
Route::get('/ajax','ajaxdataController@ajax');
Route::get('ajaxdata/getdata', 'ajaxdataController@getdata')->name('ajaxdata.getdata');
Route::post('ajaxdata/postdata', 'ajaxdataController@postdata')->name('ajaxdata.postdata');
Route::get('ajaxdata/fetchdata', 'ajaxdataController@fetchdata')->name('ajaxdata.fetchdata');
Route::post('ajaxdata/update_data', 'ajaxdataController@update_data')->name('ajaxdata.update_data');
Route::get('ajaxdata/remove_student', 'ajaxdataController@remove_student')->name('ajaxdata.remove_student');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
