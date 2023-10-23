<?php

Route::group(
    [
        'prefix' => 'backend/product/blogs',
        
        'middleware' => ['web', 'has.backend.access'],
        
        'namespace' => 'Backend',
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', 'BlogsController@getAssets')
        ->name('vh.backend.product.blogs.assets');
    /**
     * Get List
     */
    Route::get('/', 'BlogsController@getList')
        ->name('vh.backend.product.blogs.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'BlogsController@updateList')
        ->name('vh.backend.product.blogs.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'BlogsController@deleteList')
        ->name('vh.backend.product.blogs.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', 'BlogsController@fillItem')
        ->name('vh.backend.product.blogs.fill');

    /**
     * Create Item
     */
    Route::post('/', 'BlogsController@createItem')
        ->name('vh.backend.product.blogs.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'BlogsController@getItem')
        ->name('vh.backend.product.blogs.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'BlogsController@updateItem')
        ->name('vh.backend.product.blogs.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'BlogsController@deleteItem')
        ->name('vh.backend.product.blogs.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'BlogsController@listAction')
        ->name('vh.backend.product.blogs.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'BlogsController@itemAction')
        ->name('vh.backend.product.blogs.item.action');

    //---------------------------------------------------------

});
