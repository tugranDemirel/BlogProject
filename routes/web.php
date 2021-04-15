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

// controller klasöründe front klasötü içerisinde homegag controlundeki index methoduna git
Route::get('/','Front\Homepage@index')->name('homepage');
Route::get('/{category}/{slug}', 'Front\Homepage@single')->name('single');
