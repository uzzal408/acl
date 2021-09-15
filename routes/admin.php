<?php
Route::group(['prefix'=>'admin'],function (){
    Route::get('login','App\Http\Controllers\Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('login','App\Http\Controllers\Admin\LoginController@login')->name('admin.login.post');
    Route::get('logout','App\Http\Controllers\Admin\LoginController@logout')->name('admin.logout');
});

Route::group(['middleware'=> 'auth:admin'],function (){
    Route::get('/home',function (){
        return view('admin.dashboard.index');
    });

    Route::get('/admin',function (){
        return view('admin.dashboard.index');
    })->name('admin.dashboard');


    Route::group(['prefix'=> 'categories'],function (){

        Route::get('/','App\Http\Controllers\Admin\CategoryController@index')->name('admin.categories.index')->middleware('can:view-category');
        Route::get('/create','App\Http\Controllers\Admin\CategoryController@create')->name('admin.categories.create')->middleware('can:create-category');
        Route::post('/store','App\Http\Controllers\Admin\CategoryController@store')->name('admin.categories.store')->middleware('can:create-category');
        Route::get('/{id}/edit','App\Http\Controllers\Admin\CategoryController@edit')->name('admin.categories.edit')->middleware('can:update-category');
        Route::post('update','App\Http\Controllers\Admin\CategoryController@update')->name('admin.categories.update')->middleware('can:update-category');
        Route::get('/{id}/delete','App\Http\Controllers\Admin\CategoryController@delete')->name('admin.categories.delete')->middleware('can:delete-category');

    });

    Route::group(['prefix'=> 'roles'],function (){
        Route::get('/','App\Http\Controllers\Admin\RoleController@index')->name('admin.roles.index')->middleware('can:view-role');
        Route::get('/create','App\Http\Controllers\Admin\RoleController@create')->name('admin.roles.create')->middleware('can:create-role');
        Route::post('/store','App\Http\Controllers\Admin\RoleController@store')->name('admin.roles.store')->middleware('can:create-role');
        Route::get('/{id}/edit','App\Http\Controllers\Admin\RoleController@edit')->name('admin.roles.edit')->middleware('can:update-role');
        Route::post('update','App\Http\Controllers\Admin\RoleController@update')->name('admin.roles.update')->middleware('can:update-role');
    });

    Route::group(['prefix'=> 'user'],function (){
        Route::get('/','App\Http\Controllers\Admin\AdminUserController@index')->name('admin.user.index')->middleware('can:view-user');
        Route::get('/create','App\Http\Controllers\Admin\AdminUserController@create')->name('admin.user.create')->middleware('can:create-user');
        Route::post('/store','App\Http\Controllers\Admin\AdminUserController@store')->name('admin.user.store')->middleware('can:create-user');
        Route::get('/{id}/edit','App\Http\Controllers\Admin\AdminUserController@edit')->name('admin.user.edit')->middleware('can:update-user');
        Route::post('update','App\Http\Controllers\Admin\AdminUserController@update')->name('admin.user.update')->middleware('can:update-product');
        Route::get('/{id}/delete','App\Http\Controllers\Admin\AdminUserController@delete')->name('admin.user.delete')->middleware('can:delete-user');

    });

    Route::group(['prefix'=> 'users'],function () {
        Route::get('/admin/users', 'App\Http\Controllers\Admin\UserManagementController@user')->name('admin.users.detail');
        Route::get('/admin/users/change/password', 'App\Http\Controllers\Admin\UserManagementController@change_password')->name('admin.users.change.password');
        Route::post('/admin/users/change/password', 'App\Http\Controllers\Admin\UserManagementController@password_store')->name('admin.users.change.password.store');
    });

});
?>
