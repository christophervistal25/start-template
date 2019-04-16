<?php

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();



Route::group(['middleware' => 'auth'] , function () {
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('user/activities', 'Account\ActivityLogController@index')->name('account.activities');
    Route::get('user/activities/{date}', 'Account\ActivityLogController@show')->name('show.activities');

    Route::get('account/settings' , 'Account\SettingsController@index')->name('account.settings');
    Route::post('account/settings' , 'Account\SettingsController@store')->name('store.account.settings');
    Route::put('account/settings' , 'Account\SettingsController@update')->name('update.account.settings');


});


/*
 * Vehicles Routes
 */
Route::resource('vehicles', 'VehicleController');
