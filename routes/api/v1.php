<?php

Route::get('whoami', 'TestController@whoami')->name('api.v1.whoami');

Route::get('client/check', 'ClientController@check')->name('api.v1.client.check');
Route::get('client', 'ClientController@show')->name('api.v1.client.show');
Route::get('client/search', 'ClientController@search')->name('api.v1.client.search');
Route::post('client', 'ClientController@store')->name('api.v1.client.create');

Route::get('order/validate', 'OrderController@validateAmount')->name('api.v1.order.validate');
Route::post('order', 'OrderController@store')->name('api.v1.order.create');
