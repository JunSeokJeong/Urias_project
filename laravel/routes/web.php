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
Auth::routes();

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/study/st','StudyController@store');

Route::get('/study','StudyController@index')->name('study');            //점자교육메인페이지로 이동 
Route::get('/study/{id}','StudyController@show')->name('study/{id}');   //각각의 점자 교육 페이지로 이동
Route::get('/study/store/{id}','StudyController@store');
Route::get('/study/quiz/{id}','StudyController@quizShow');              //각각의 점자 퀴즈 페이지로 이동


//E-library 라우팅 목록
Route::get('/library','LibraryController@libIndex')->name('library');//E-library 메인페이지로 이동

//도서관 관런 라우팅 부분
Route::get('/library/bookList','LibraryController@bookList')->name('bList');    // 도서목록 페이지
Route::get('/library/myBookList','LibraryController@myBookList')->name('mybList');  // 나의 도서목록 페이지

//오역수정 봉사 라우팅 부분
Route::get('/library/volunteerList',                                'LibraryController@volunteerList')->name('vList');          //오역수정봉사목록으로 이동
Route::get('/library/volunteerInfo/{num}/{book_name}',              'LibraryController@volunteerInfo')->name('vInfo');          //오역수정봉사세부페이지로 이동
Route::get('/library/volunteerInputText/{num}/{book_name}/{page}',  'LibraryController@volunteerInputText')->name('vInputText');//오역수정페이지로 이동
Route::get('/library/volunteerCheck/{num}/{book_name}/{page}',      'LibraryController@volunteerCheck')->name('vCheck');        //오역수정검수 페이지로 이동
Route::get('/library/volunteerInsert',                              'LibraryController@volunteerInsert')->name('vInsert');      //오역수정봉사 등록 페이지로 이동
Route::get('/library/newbookInsert/{num}/{book_name}',              'LibraryController@newbookInsert')->name('bInsert');        //책등록 페이지로 이동
Route::get('/library/delVolunteerList/{num}/{book_name}',           'LibraryController@delVolunteerList')->name('delVolunteerList');        //책등록 페이지로 이동
Route::post('/library/newVolunteerList',                            'LibraryController@newVolunteerList')->name('newVolunteerList');        //오역수정 목록 등록

Route::get('/tttt',function(){
    return view('index2');
});