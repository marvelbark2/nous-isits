<?php
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
| `0.5625 + 0.42 + 0.45 + 0.42 + 1.05 + 0.54 + 0.9`
*/

Route::get('/', 'MatiereController@index')->name('/');
Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {



    Route::group(['middleware' => ['SP']], function () {
        //api
    //Calc
        Route::get('/create', 'MatiereController@create');
        Route::post('/create', 'MatiereController@store')->name('m.store');
        Wizard::routes('wizard/matiere', 'MatiereWizardController', 'wizard.matiere');

        Route::get('/cal', 'CalculController@index');
        Route::post('/cal/result', 'CalculController@result');
        Route::get('/note', 'NoteController@index');
        Route::get('/note/update', 'NoteController@update');
        Route::get('/note/test', 'NoteController@s');
        Route::get('/note/student', 'NoteController@student');
        Route::get('/note/student/{id}', 'NoteController@notes');

        Route::get('/metro', 'NoteController@diag_metro');


        //test route
        Route::view('test', 'test');
        Route::view('vue', 'n.vue');

        Route::get('/rach', 'NoteController@racha')->name('voir tout les rachat');

        Wizard::routes('wizard/matiere', 'MatiereWizardController', 'wizard.matiere');
        Route::get('export', 'NoteController@export')->name('export');
        Route::get('importExportView', 'NoteController@importExportView');
        Route::post('note/import', 'NoteController@import')->name('n-import');
        Route::post('product/import', 'ProductController@import')->name('prod-import');
        Route::get('product/import', 'ProductController@importView');
        // prepationn :
        Route::resource('prepa', 'PrepaController');
        Route::get('/program/up', 'ProgramController@load');
        Route::get('/program/te', 'ProgramController@te');
        Route::get('/program/update', 'ProgramController@update');
        Route::get('/program/test', 'ProgramController@test');
        Route::get('/modules', 'MatiereController@modules');
        Route::get('/updatemid', 'MatiereController@updatemid');
        Route::get('/ass', 'MatiereController@ass');
        Route::get('/al', 'NoteController@call');
        Route::get('/mdl', 'NoteController@mdl');
        Route::get('/updsn', 'NoteController@updsn');
        Route::get('/isi2', 'NoteController@isi2');
        Route::get('/userss', 'NoteController@userss');
        Route::get('product', 'ProductController@index');
        Route::post('product', 'ProductController@index')->name('p-search');
        Route::get('/mno', 'NoteController@mno');
        Route::get('/insert', 'NoteController@insert');
        Route::get('/exs', 'NoteController@tst1');
        Route::group(['prefix' => 'delib'], function () {
            Route::get('/', 'DelibController@index');
            Route::get('/student/{id}', 'DelibController@bystudent');
            Route::post('/', 'DelibController@show')->name('affichage');
        });
        Route::get('/mnoa', 'NoteController@mnoa');
        Route::get('/abs', 'NoteController@abs');
        Route::get('/upda', 'NoteController@upda');
        Route::get('/updmnote', 'NoteController@updmnote');
        Route::group(['middleware' => ['RP']], function () {
            Route::get('survey/create', 'SurveyController@create');
            Route::post('/survey/create', 'SurveyController@store')->name('survey-store');
        });
    });
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::get('survey', 'SurveyController@index')->name('survey-index');
    Route::get('survey/{survey}', 'SurveyController@show')->name('survey-show');
    Route::get('/program', 'ProgramController@index')->name('plan');
    Route::post('survey/{survey}/answer', 'SurveyController@answers')->name('survey-answer');
    Route::get('/qe/', 'QeController@index');
    Route::get('/qe/list', 'QeController@list');
    Route::get('/qe/{m_id}', 'QeController@md');
    Route::post('/qe/{qe}/invite', 'QeController@invite');
    Route::get('/qe/{m_id}/print', 'QeController@print');

    Route::get('/qe/{m_id}/add', 'QeController@create');

    Route::post('/qe/{m_id}/add', 'QeController@store');
    Route::get('/qe/{id}/show', 'QeController@show');
    Route::get('/qe/{id}/edit', 'QeController@edit');
    Route::post('/qe/{id}/edit', 'QeController@update');
    Route::delete('/qe/delete/{id}', function ($id) {
        \App\QE::destroy($id);
        return back()->with('toast_success', 'The Qe is deleted');
    });
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', 'TasksController@index')->name('task-index');
        Route::post('/', 'TasksController@store')->name('task-store');
    });
});
// Route::get('/{any}', function () {
//     return view('layouts.master');
// })->where('any','.*');

