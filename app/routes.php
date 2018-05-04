<?php

/**
 * Admin
 * ------------------------------------
 */
$app->router->group(['prefix' => 'admin'], function ($r) {
    $r->get('/login', 'App\Controllers\AdminController@login', [
        'name' => 'admin.login'
    ]);

    $r->post('/login', 'App\Controllers\AdminController@loginDo', [
        'name' => 'admin.login.do'
    ]);


    /**
     * Authenticated
     */
    $r->group(['before' => 'adminAuth'], function ($r) {
        $r->get('/', 'App\Controllers\AdminController@resources', [
            'name' => 'admin.home'
        ]);

        $r->get('/create', 'App\Controllers\AdminController@create', [
            'name' => 'admin.resources.create'
        ]);

        $r->get('/edit/(:any)', 'App\Controllers\AdminController@edit', [
            'name' => 'admin.resources.edit'
        ]);

        $r->post('/save', 'App\Controllers\AdminController@save', [
            'name' => 'admin.resources.save'
        ]);

        $r->post('/delete', 'App\Controllers\AdminController@delete', [
            'name' => 'admin.resources.delete'
        ]);
    });
});


/**
 * API
 * ------------------------------------
 */
$app->router->group(['prefix' => 'api'], function ($r) {
    $r->any('(:all)', 'App\Controllers\ApiController@getResource');
});
