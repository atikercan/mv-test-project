<?php

use App\Company;

Route::get('companies/{id}', function ($id) {
    $company = Company::with('investments')->where("id",$id)->first();
	if(!$company) {
		return response("company couldn't be found.", 404);
	}
	return $company;
});

