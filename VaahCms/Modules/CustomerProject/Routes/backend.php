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
include('backend/routes-customers.php');
include('backend/routes-products.php');
include ("backend/routes-users.php");

Route::group(
    [
        'prefix'     => 'backend/customerproject',
        'middleware' => ['web', 'has.backend.access'],
        'namespace' => 'Backend',
    ],
    function () {
        //------------------------------------------------
        Route::get( '/', 'BackendController@index' )
            ->name( 'vh.backend.customerproject' );
        //------------------------------------------------
        //------------------------------------------------
        Route::get( '/assets', 'BackendController@getAssets' )
            ->name( 'vh.backend.customerproject.assets' );
        //------------------------------------------------
//        Route::get( '/notification/{code}', 'BackendController@notifyUser' )
//            ->name( 'vh.notify' );

    });


/*
 * Include CRUD Routes
 */
//include("backend/routes-example.php");
