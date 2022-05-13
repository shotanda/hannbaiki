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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/resisterpro',function(){
    return view('resisterpro');
});
Auth::routes();



//ホーム画面
Route::get('home', 'HomeController@index')->name('home');

Auth::routes();



//登録画面
Route::get('resisterpro','HomeController@create')->name('create');

Auth::routes();

//登録
Route::post('resisterpro/store','HomeController@exestore')->name('store');

Auth::routes();

//検索機能
Route::get('home/search','HomeController@getSearch');


//商品詳細表示
Route::get('product/{id}','HomeController@showDetail')->name('detail');

Auth::routes();

//商品編集画面表示
Route::get('/product/edit/{id}','HomeController@showEdit');

Route::post('/product/update','HomeController@exeUpdate')->name('update');

Auth::routes();

//削除
Route::delete('product/delete/{id}', 'HomeController@delete');

 


Route::get('com','HomeController@com');
