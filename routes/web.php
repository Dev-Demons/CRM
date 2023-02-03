<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Scooters
    Route::delete('scooters/destroy', 'ScootersController@massDestroy')->name('scooters.massDestroy');
    Route::resource('scooters', 'ScootersController');
    Route::post('scooters-import', 'ScootersController@import')->name('scooters-import');
    Route::get('scooter-pdf/{id}', 'ScootersController@generatePDF')->name('scooter-pdf');
    Route::post('scooters/{id}', 'ScootersController@uploadSIGN')->name('scooter-sign');

    // Scooterstatuses
    Route::delete('scooter-statuses/destroy', 'ScooterStatusController@massDestroy')->name('scooter-statuses.massDestroy');
    Route::resource('scooter-statuses', 'ScooterStatusController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});

