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
    return view('welcome');
});

Auth::routes();

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

   Route::resource('sections','SectionController');

   Route::resource('subsections','SubsectionController');

   Route::resource('questions','QuestionController');

   Route::resource('tests','TestController');

   Route::get('/home', [
        'uses' => 'HomeController@index',
        'as' => 'home'
    ]);

    Route::get('/questions/approve/{id}', [
        'uses' => 'QuestionController@approve',
        'as' => 'questions.approve'
    ]);
    
    Route::get('/user/create',[
        'uses' => 'UserController@create',
        'as' => 'user.create'
    ]);
    
    Route::get('/users',[
        'uses' => 'UserController@index',
        'as' => 'users'
    ]);
    
    Route::get('/user/delete/{id}',[
        'uses' => 'UserController@destroy',
        'as' => 'user.delete'
    ]);
    
    Route::get('user/grant/{id}{set}',[
        'uses' => 'UserController@grant',
        'as' => 'user.grant'
    ]);
    
    Route::get('user/ungrant/{id}',[
        'uses' => 'UserController@ungrant',
        'as' => 'user.ungrant'
    ]);

    Route::get('profile/edit',[
        'uses' => 'ProfileController@edit',
        'as' => 'profile.edit'
    ]);

    Route::get('/topic/create',[
        'uses' => 'TopicController@create',
        'as' => 'topic.create'
    ]);
    
    Route::get('/subject/create',[
        'uses' => 'SubjectController@create',
        'as' => 'subject.create'
    ]);
    
    Route::get('/subjects',[
        'uses' => 'SubjectController@index',
        'as' => 'subjects'
    ]);
    
    Route::get('/subject/edit/{id}',[
        'uses' => 'SubjectController@edit',
        'as' => 'subject.edit'
    ]);   
    
    Route::get('/subject/delete/{id}',[
        'uses' => 'SubjectController@destroy',
        'as' => 'subject.delete'
    ]);

    Route::get('/toApprove',[
        'uses' => 'QuestionController@toApprove',
        'as' => 'questions.toApprove'
    ]);

    Route::get('/questions/test/toOrganize',[
        'uses' => 'QuestionController@toOrganize',
        'as' => 'questions.toOrganize'
    ]);

    Route::get('/questions/organize/{id}',[
        'uses' => 'QuestionController@organize',
        'as' => 'questions.organize'
    ]);

    Route::get('/questions/organize/undo/{id}',[
        'uses' => 'QuestionController@undo',
        'as' => 'questions.organize.undo'
    ]);

    Route::post('/questions/filter',[
        'uses' => 'QuestionController@filter',
        'as' => 'questions.filter'
    ]);

    Route::post('/questions/organizeFilter',[
        'uses' => 'QuestionController@organizeFilter',
        'as' => 'questions.organizeFilter'
    ]);

    Route::get('/tests/view/{mode}',[
        'uses' => 'TestController@view',
        'as' => 'tests.view'
    ]);

    Route::get('/test/settings',[
        'uses' => 'TestController@settings',
        'as' => 'test.settings'
    ]);

    Route::post('/tests/mark',[
        'uses' => 'TestController@mark',
        'as' => 'tests.mark'
    ]);

    Route::post('/tests/index/{mode}',[
        'uses' => 'TestController@index',
        'as' => 'tests.index'
    ]);

    Route::get('/test/result',[
        'uses' => 'TestController@result',
        'as' => 'tests.result'
    ]);

    Route::get('/tests/{set}/end',[
        'uses' => 'TestController@end',
        'as' => 'tests.end'
    ]);

    Route::get('/tests/set/{id}',[
        'uses' => 'TestController@set',
        'as' => 'tests.set'
    ]);

    Route::get('/question/{qid}/option/{oid}',[
        'uses' => 'QuestionController@assignKey',
        'as' => 'question.assign.key'
    ]);

    Route::get('/test/{set}/generated',[
        'uses' => 'TestController@generated',
        'as' => 'tests.generated'
    ]);

    Route::post('/users/tokenize',[
        'uses' => 'UserController@tokenize',
        'as' => 'users.tokenize'
    ]);


    Route::post('/subject/update/{id}',[
        'uses' => 'SubjectController@update',
        'as' => 'subject.update'
    ]);
    
    Route::post('/subject/store',[
        'uses' => 'SubjectController@store',
        'as' => 'subject.store'
    ]);
    
    Route::post('/user/store',[
        'uses' => 'UserController@store',
        'as' => 'user.store'
    ]);

    Route::post('/profile/update',[
        'uses' => 'ProfileController@update',
        'as' => 'profile.update'
    ]);

    Route::get('/users/students',[
        'uses' => 'UserController@getStudents',
        'as' => 'users.students'
    ]);

    Route::get('/users/specialists',[
        'uses' => 'UserController@getSpecialists',
        'as' => 'users.specialists'
    ]);

    Route::get('/users/supervisors',[
        'uses' => 'UserController@getSupervisors',
        'as' => 'users.supervisors'
    ]);
});
