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


/* BACKEND(ADMIN) ROUTE*/
/*
Route::get('admin/panel', 'Back\dashboard@index')->name('admin.dashboard');
Route::get('admin/giris', 'Back\AuthController@login')->name('admin.login');
Route::post('admin/giris', 'Back\AuthController@loginpost')->name('admin.login.post');
Route::get('admin/cikis', 'Back\AuthController@logout')->name('admin.logout'); */

// route group yapısı ile her seferinde admin yazmaktan kurtulduk
// kullanici giris yapmamissa
Route::prefix('admin')->name('admin.')->middleware('isLogin')->group(function (){
    Route::get('giris', 'Back\AuthController@login')->name('login');
    Route::post('giris', 'Back\AuthController@loginpost')->name('login.post');
});

// route group yapısı ile her seferinde admin yazmaktan kurtulduk
// Kullanıcı giris yapmıssa
Route::prefix('admin')->name('admin.')->middleware('isAdmin')->group(function (){

    Route::get('panel', 'Back\dashboard@index')->name('dashboard');
    Route::get('makaleler/silinenler','Back\ArticleController@trashed')->name('trashed.article');
    Route::resource('makaleler','Back\ArticleController');
    Route::get('switch','Back\ArticleController@switch')->name('switch');
    Route::get('/recoverarticle/{id}','Back\ArticleController@recover')->name('recover.article');
    Route::get('/harddeletearticle/{id}','Back\ArticleController@hardDelete')->name('hard.delete.article');
    Route::get('cikis', 'Back\AuthController@logout')->name('logout');
});


/********************************************************************************/
                                /* FRONT ROUTE*/
// controller klasöründe front klasötü içerisinde homegag controlundeki index methoduna git
Route::get('/','Front\Homepage@index')->name('homepage');
Route::get('/sayfa', 'Front\Homepage@index');
Route::get('/iletisim', 'Front\Homepage@contact')->name('contact');
Route::post('/iletisim', 'Front\Homepage@contactpost')->name('contact.post');
Route::get('/kategori/{category}','Front\Homepage@category')->name('category');
Route::get('/{category}/{slug}', 'Front\Homepage@single')->name('single');
Route::get('/{sayfa}', 'Front\Homepage@page')->name('page');

