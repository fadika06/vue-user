<?php

Route::group(['prefix' => 'api/user', 'middleware' => ['web']], function() {
    $controllers = (object) [
        'index'     => 'Bantenprov\User\Http\Controllers\UserController@index',
        'create'    => 'Bantenprov\User\Http\Controllers\UserController@create',
        'show'      => 'Bantenprov\User\Http\Controllers\UserController@show',
        'store'     => 'Bantenprov\User\Http\Controllers\UserController@store',
        'edit'      => 'Bantenprov\User\Http\Controllers\UserController@edit',
        'update'    => 'Bantenprov\User\Http\Controllers\UserController@update',
        'destroy'   => 'Bantenprov\User\Http\Controllers\UserController@destroy',
    ];

    Route::get('/',             $controllers->index)->name('user.index');
    Route::get('/create',       $controllers->create)->name('user.create');
    Route::get('/{id}',         $controllers->show)->name('user.show');
    Route::post('/',            $controllers->store)->name('user.store');
    Route::get('/{id}/edit',    $controllers->edit)->name('user.edit');
    Route::put('/{id}',         $controllers->update)->name('user.update');
    Route::delete('/{id}',      $controllers->destroy)->name('user.destroy');
});
