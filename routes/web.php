<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

use App\Budget;
use App\LargeServiceArea;
use App\ServiceArea;
use App\LargeArea;
use App\MiddleArea;
use App\SmallArea;
use App\Genre;
use App\CreditCard;
use App\Special;
use App\SpecialCategory;

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
  // $s = new LargeServiceArea;
  // $s->syncApiMaster();
  // $s = new ServiceArea;
  // $s->syncApiMaster();
  // $s = new LargeArea;
  // $s->syncApiMaster();
  // $s = new MiddleArea;
  // $s->syncApiMaster();
  // $s = new SmallArea;
  // $s->syncApiMaster();
  // $s = new Genre;
  // $s->syncApiMaster();
  $s = new Budget;
  $s->syncApiMaster();
  $s = new CreditCard;
  $s->syncApiMaster();
  $s = new SpecialCategory;
  $s->syncApiMaster();
  $s = new Special;
  $s->syncApiMaster();
});

Auth::routes();

Route::get('/search', 'SearchController@index')->name('search');
Route::get('/search/{smallArea}', 'SearchController@smallAreaSearch')->name('smallAreaSearch');
Route::get('/search/{middleArea}', 'SearchController@middleAreaSearch')->name('middleAreaSearch');
Route::get('/search/{largeArea}', 'SearchController@largeAreaSearch')->name('largeAreaSearch');

Route::get('/areas/{largeArea}', 'SearchController@getMiddleArea')->name('areas.middle');
Route::get('/areas/{middleArea}', 'SearchController@getSmallArea')->name('areas.small');
