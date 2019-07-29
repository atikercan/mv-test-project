<?php

Route::get('/', function () {
    return "Hello";
});

Route::get('companies', 'CompaniesController@index');
Route::get('companies/{id}', 'CompaniesController@show');


Route::get('companies/{id}/vue', 'CompaniesController@showVue');

Route::post('companies', 'CompaniesController@store');
Route::put('companies/{id}', 'CompaniesController@update');

Route::delete('companies/{id}', 'CompaniesController@destroy');

Route::get('companies_vue/{id}', function ($id) {
    return view('companies.show-vue', compact('id'));
});
