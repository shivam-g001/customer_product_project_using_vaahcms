<?php

Route::group(
    [
        'prefix' => 'backend/customerproject/customers',

        'middleware' => ['web', 'has.backend.access'],

        'namespace' => 'Backend',
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', 'CustomersController@getAssets')
        ->name('vh.backend.customerproject.customers.assets');
    /**
     * Get List
     */
    Route::get('/', 'CustomersController@getList')
        ->name('vh.backend.customerproject.customers.list');

    Route::post('/customer/notify', 'CustomersController@sendNotification')
        ->name('vh.backend.customerproject.customers.notify');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'CustomersController@updateList')
        ->name('vh.backend.customerproject.customers.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'CustomersController@deleteList')
        ->name('vh.backend.customerproject.customers.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', 'CustomersController@fillItem')
        ->name('vh.backend.customerproject.customers.fill');

    /**
     * Create Item
     */
    Route::post('/', 'CustomersController@createItem')
        ->name('vh.backend.customerproject.customers.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'CustomersController@getItem')
        ->name('vh.backend.customerproject.customers.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'CustomersController@updateItem')
        ->name('vh.backend.customerproject.customers.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'CustomersController@deleteItem')
        ->name('vh.backend.customerproject.customers.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'CustomersController@listAction')
        ->name('vh.backend.customerproject.customers.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'CustomersController@itemAction')
        ->name('vh.backend.customerproject.customers.item.action');

    //---------------------------------------------------------
    Route::match(['post','get'],'/upload-image', 'CustomersController@uploadImage')
        ->name('vh.backend.customerproject.customers.uploadImage');
});
