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
Route::get('/index', 'PersonnelController@index')->name('index');
Route::get('/personnels', 'PersonnelController@personnels')->name('personnels');
Route::get('/nouveau', 'PersonnelController@create')->name('new_personnel');
Route::post('/registre', 'PersonnelController@store')->name('store');
Route::get('/edit/{id}', 'PersonnelController@edit')->name('edit_pers');
Route::get('/show/{id}', 'PersonnelController@show')->name('show');
Route::delete('personnel/delete/{id}', 'PersonnelController@destroy')->name('delete');
Route::put('personnel/edit/{id}', 'PersonnelController@update')->name('update');
Route::put('personnel/edit/profile/{id}', 'PersonnelController@updateImage')->name('updateImage');

//Auth route
Route::resource('user','UserController');
Route::post('/connexion', 'UserController@login')->name('login');
Route::get('/question_check', 'UserController@question_check')->name('question_check');
Route::get('/forget_password',function ()
{
	return view('auth.forget_password');
})->name('user.forget_password');
Route::get('/deconnexion', 'UserController@logout')->name('logout');
Route::get('/logged',function (){return view('auth.logged');})->name('logged');

// Pointages
Route::resource('pointage','PointageController');
// demandes
Route::resource('demande','DemandeController');
Route::get('/demade/simple','DemandeController@demande_create')->name('demande_create');

Route::get('/',function ()
{
	return view('auth.login');
})->name('outside_user');

Route::get('/type/create','DemandeController@type_create')->name('create_type');
Route::get('/type/edit','DemandeController@type_edit')->name('type_edit');
Route::get('/consulter/absent',function ()
{
	return view('pointages.abs_date');
})->name('btn_consulter');
Route::get('/absents','PointageController@absence')->name('absent_date');
Route::get('/conge','DemandeController@index2')->name('demande.accepted');
Route::get('/back','DemandeController@back')->name('back');
Route::get('/archive/pointage','PointageController@histo_store')->name('histo_pointage');
Route::get('/archive/point','PointageController@indexhisto')->name('histo_all');
Route::post('/create/type', 'DemandeController@typestore')->name('createType');

// Ajax
Route::get('/decision/demande/{id}','DemandeController@decison')->name('decision');
Route::get('/sanction/bilan','PointageController@bilan')->name('bilan_list');
Route::get('/sanctionner/{id}','PointageController@sanction')->name('sanctionner');
Route::get('/sanction/liste','PointageController@sanction_liste')->name('sanction_liste');
Route::get('/sanction/create','PointageController@createtypes')->name('sanction_type_create');
Route::post('/sanction/type','PointageController@sanction_type_store')->name('sanction_type_store');



Route::get('user/edit/password', 'UserController@edit_password')->name('edit_password');

Route::put('user/update/password', 'UserController@update_password')->name('update_password');

Route::put('user/update/type/sanction', 'PointageController@update_type_sanction')->name('update_type_sanction');

Route::get('user/edit/type/sanction/{id}', 'PointageController@edit_type_sanction')->name('edit_type_sanction');

Route::put('user/update/type/conge', 'PointageController@update_type_conge')->name('update_type_conge');

Route::get('user/edit/type/conge/{id}', 'PointageController@edit_type_conge')->name('edit_type_conge');
