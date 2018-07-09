<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('mainpage');
});
Route::get('/index', function () {
    return view('mainpage');
});
Route::get('/mainpage', function () {
    return view('mainpage');
});
Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/resume-docx/{id}', 'GenerDOCXController@generate_docx');


// REGISTER
Route::get('/register/company','RegisterController@regCompany');
Route::get('/register/sailor','RegisterController@regSailor');
Route::post('/register/sailor','RegisterController@addSailor');
Route::post('/register/company','RegisterController@addCompany');

//AUTHORIZATION
Route::get('/authorization', 'AuthorizController@show_view');
Route::post('/authorization', 'AuthorizController@authorization');
Route::get('/logout', 'AuthorizController@logout');

//LOCATION AJAX URLS
Route::post('/getRegions', 'ProfileController@get_regions');
Route::post('/getCities', 'ProfileController@get_cities');

//PROFILE VIEWS
Route::get('/profile', 'ProfileController@show_profile');
Route::get('/profile/addresume', 'ProfileController@show_sailor_addresume');
Route::get('/profile/addvacancy', 'ProfileController@show_company_addvacacy');
Route::get('/profile/addexperience', 'ProfileController@view_add_exp');
Route::get('/profile/addresume/{id}', 'ProfileController@show_sailor_addresume');
Route::get('/profile/addvacancy/{id}', 'ProfileController@show_company_addvacacy');
Route::get('/profile/user_request', 'ProfileController@show_formrequest');
Route::get('/profile/deletavacancies', 'ProfileController@del_vacancy');
Route::get('/profile/manageresume', 'ProfileController@edit_resume');


//PROFILE SAILOR FORMS
Route::post('/profile/upd_personal', [
	'as' => '/profile/upd_personal',
	'uses' => 'ProfileController@upd_personal'
]);
Route::post('/profile/crt_resume', [
	'as' => '/profile/crt_resume',
	'uses' => 'ProfileController@crt_resume'
]);
Route::post('/profile/crt_exp', [
	'as' => '/profile/crt_exp',
	'uses' => 'ProfileController@crt_exp'
]);
Route::post('/profile/manageresume', [
	'as' => '/profile/manageresume',
	'uses' => 'ProfileController@edit_resume'
]);


//PROFILE COMPANY FORMS
Route::post('/profile/upd_company', [
	'as' => '/profile/upd_company',
	'uses' => 'ProfileController@upd_company'
]);

Route::post('/profile/crt_vacancy', [
	'as' => '/profile/crt_vacancy',
	'uses' => 'ProfileController@crt_vacancy'
]);

Route::post('/profile/crt_experience', [
	'as' => '/profile/crt_experience',
	'uses' => 'ProfileController@crt_experience'
]);
Route::post('/profile/user_request', [
	'as' => '/profile/user_request',
	'uses' => 'ProfileController@crt_request'
]);
Route::post('/profile/deletavacancies', [
	'as' => '/profile/deletavacancies',
	'uses' => 'ProfileController@del_vacancy'
]);

Route::post('/resume-docx/offer', [
	'as' => '/resume-docx/offer',
	'uses' => 'GenerDOCXController@getOffer'
]);



// MANAGER
Route::get('/manager/search_resumes', 'ManagerController@show_sailors');
Route::get('/manager/search_vacancies', 'ManagerController@show_companies');
Route::get('/manager/user_requests', 'ManagerController@show_requests');


//SEARCH MANAGER FORMS
Route::post('/manager/search_resumes', [
	'as' => '/manager/search_resumes',
	'uses' =>'ManagerController@show_sailors'
]);
Route::post('/manager/search_vacancies', [
	'as' => '/manager/search_vacancies',
	'uses' =>'ManagerController@show_companies'
]);

//RESUME CATALOG
Route::get('/resume', 'CatalogViewController@show_resumes');
Route::post('/resume', [
	'as' => '/resume',
	'uses' => 'CatalogViewController@show_resumes'
]);
Route::get('/resume/{id}', 'CatalogViewController@show_resume');


//VACANCY CATALOG
Route::get('/vacancy', 'CatalogViewController@show_vacancies');
Route::post('/vacancy', [
	'as' => '/vacancy',
	'uses' => 'CatalogViewController@show_vacancies'
]);
Route::get('/vacancy/{id}', 'CatalogViewController@show_vacancy');
