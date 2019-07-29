<?php

use App\Company;

Route::get('companies/{id}', function ($id) {
    $company = Company::with('investments')->where("id",$id)->first();
	if(!$company) {
		return response("company couldn't be found.", 404);
	}
	return $company;
});


Route::post('companies', 'CompaniesController@store');
Route::put('companies/{id}', 'CompaniesController@update');

Route::delete('companies/{id}', 'CompaniesController@destroy');