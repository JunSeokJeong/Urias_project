<?php


Auth::routes();

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/mypage', 'HomeController@mypage')->name('mypage');

//마이페이지 라우터
Route::get('/mypage/message', 'MypageController@messageList')->name('message');
Route::get('/mypage/messageinfo/{num}', 'MypageController@messageInfo')->name('messageInfo');

// 온라인점자학교 목록 
Route::get('/studyindex','StudyController@index')->name('study'); //점자교육메인페이지로 이동 
Route::get('/study','StudyController@studyselect')->name('select'); //점자교육 선택 페이지          
Route::get('/study/{id}','StudyController@studyshow')->name('study/{id}');   //각각의 점자 교육 페이지로 이동
Route::get('/quiz','StudyController@quizselect')->name('quizselect');
Route::get('/quiz/{id}','StudyController@quizShow');              //각각의 점자 퀴즈 페이지로 이동

//온라인점자학교에서 사용될 아두이노의 텍스트파일 생성 
Route::get('/adinput','StudyController@adinput');//아두이노 출력 챕터 선택페이지 
Route::get('/adinput/{id}','StudyController@studyset');//각각 챕터에대한 텍스트입력 페이지
Route::get('/adinput/path/{id}','StudyController@pathedit');//단원별 음성강의 src path를 수정하는 페이지
Route::get('/adinput/quiz/path/{id}','StudyController@quizpathedit');//단원별 퀴즈음성 src path를 수정하는 페이지 
Route::get('/adinput/quiz/update/{id}','StudyController@quizupdate');//단원별 퀴즈선택지와 정답을 수정하는 페이지 
Route::get('/adinput/quiz/{id}','StudyController@quizset');//각각 챕터퀴즈에대한 텍스트입력 페이지
Route::get('/myBookListApp2','LibraryController@myBookListApp2'); //app 에서 데이터요청
Route::get('/myQuizList','LibraryController@quizList');//app 에서 quizList정보 조회
Route::put('/change/{id}','StudyController@pathchange');//컨트롤러에 path 수정요청 
Route::put('/quizchange/{id}','StudyController@quizpathcchange');//컨트롤러에  quiz path 수정요청 

Route::post('/studysend','StudyController@studysend')->name('studysend');//교육텍스트를 서버에 생성하는 컨트롤러 
Route::post('/quizsend','StudyController@quizsend')->name('quizsend');//퀴즈텍스트를 서버에 생성하는 컨트롤러

//app에서 로그인 판단.
Route::get('/loginApp','LoginController@loginApp');

//E-library 라우팅 목록
Route::get('/library','LibraryController@libIndex')->name('library');//E-library 메인페이지로 이동

//도서관 관런 라우팅 부분
Route::get('/library/bookList','LibraryController@bookList')->name('bList');    // 도서목록 페이지
Route::get('/library/myBookList','LibraryController@myBookList')->name('mybList');  // 나의 도서목록 페이지
Route::get('/library/myBookListApp','LibraryController@myBookListApp'); //app 에서 데이터요청 
Route::post('/library/myBookListAdd','LibraryController@myBookListAddition')->name('mybListAdd'); //나의 도서목록 추가
Route::get('/library/bookRequest','LibraryController@bookRequest')->name('bookRequest'); //도서 신청 페이지
Route::post('/library/bookRequestMessage','LibraryController@bookRequestMessage')->name('bookRequestMessage');         //도서 신청 message

//오역수정 봉사 라우팅 부분
Route::get('/library/volunteerList',                                'VolunteerController@volunteerList')->name('vList');          //오역수정봉사목록으로 이동
Route::get('/library/volunteerInfo/{num}/{book_name}',              'VolunteerController@volunteerInfo')->name('vInfo');          //오역수정봉사세부페이지로 이동
Route::get('/library/joinVolunteer/{num}/{book_name}',              'VolunteerController@joinVolunteerPage')->name('vJoin');          //오역수정봉사세부페이지로 이동
Route::post('/library/joinVolunteer',                               'VolunteerController@joinVolunteer')->name('vJoinIn');        //새로운 책 등록
Route::get('/library/volunteerInputText/{num}/{book_name}/{page}',  'VolunteerController@volunteerInputText')->name('vInputText');//오역수정페이지로 이동
Route::post('/library/volunteerInputText',                          'VolunteerController@volunteerInputTextSubmit');              //오역수정페이지로 이동
Route::get('/library/volunteerCheck/{num}/{book_name}/{page}',      'VolunteerController@volunteerCheck')->name('vCheck');        //오역수정검수 페이지로 이동
Route::post('/library/volunteerCheck',                              'VolunteerController@volunteerCheckRegister');        //
Route::get('/library/volunteerInsert',                              'VolunteerController@volunteerInsert')->name('vInsert');      //오역수정봉사 등록 페이지로 이동
Route::get('/library/newbookInsert/{num}/{book_name}',              'VolunteerController@newbookInsert')->name('bInsert');        //책등록 페이지로 이동
Route::get('/library/delVolunteerList/{num}/{book_name}',           'VolunteerController@delVolunteerList')->name('delVolunteerList');        //책등록 페이지로 이동
Route::post('/library/newVolunteerList',                            'VolunteerController@newVolunteerList')->name('newVolunteerList');        //오역수정 목록 등록
Route::post('/library/newbookInsert',                               'VolunteerController@newbookRegister')->name('bRegister');        //새로운 책 등록

Route::get('/tttt',function(){
    return view('index2');
});

//도서관 알림 게시판 부분
Route::get('/board/boardList','BoardController@index')->name('boardList'); //게시판 목록으로 이동
Route::get('/board/boardWrite','BoardController@create')->name('boardWrite'); //게시글 작성 페이지 이동
Route::post('/board/store','BoardController@store')->name('boardstore');    //게시글 저장 
Route::get('/board/boardRead/{id}' ,'BoardController@show')->name('boardRead'); //게시글 상세 페이지 이동 
Route::delete('/board/boardRead/{id}', 'BoardController@destroy')->name('boardDelete'); // 게시글 삭제

Route::get('/board/boardRead/{id}/boardEdit', 'BoardController@edit')->name('boardEdit');//게시글 수정 페이지 이동
Route::put('/board/boardRead/{id}', 'BoardController@update')->name('boardUpdate'); //게시글 수정


//블라인드케어
Route::get('/blindcare/blindIndex','BlindCareController@blindIndex')->name('blindIndex'); //낙상사고 메인 페이지 이동
Route::get('/blindcare/fallingLocation','BlindCareController@fallingLocation')->name('fallingLocation'); //낙상사고 메인 페이지 이동
Route::get('/blindcare/fallingLocationInsert','BlindCareController@fallingLocationInsert');//낙상사고 메인 페이지 이동
Route::get('/blindcare/insertFallingPage/{num}','BlindCareController@insertFallingPage'); //정보입력 페이지로 이동
Route::get('/blindcare/fallingInfo/{num}','BlindCareController@fallingInfo'); //낙상사고 상세정보
Route::post('/blindcare/insertFallingInfo','BlindCareController@insertFallingInfo'); //낙상사고 정보 입력

// 실시간 영상통화 서비스
Route::get('/blindcare/videoCallIndex',                         'VideoCallController@videoCallIndex')->name('vCIndex');                 // 영상통화 서비스 메인페이지로 이동
Route::get('/blindcare/volunteerTimeList/{year}/{month}',       'VideoCallController@volunteerTimeList')->name('vTList');               // 봉사자 봉사시간 조회 페이지로 이동(봉사자)
Route::get('/blindcare/volunteerTimeCalendar',                  'VideoCallController@volunteerTimeCalendar')->name('vTCalendar');   // 봉사자 봉사시간 조회 페이지로 이동(봉사자)
Route::post('/blindcare/volunteerTimeRegist',                   'VideoCallController@volunteerTimeRegist')->name('vTRegist');           // 봉사자 봉사시간 등록 후 조회페이지로 재이동(봉사자)
Route::get('/blindcare/questionList',                           'VideoCallController@questionList')->name('qList');                     // 질문게시판 리스트 페이지로 이동(봉사자)
Route::get('/blindcare/questionView/{num}',                     'VideoCallController@questionView')->name('qView');                     // 질문게시판 뷰 페이지로 이동(봉사자)
Route::get('/blindcare/questionRegist',                         'VideoCallController@questionRegist')->name('qRegist');                 // 질문글 작성 후 질문게시판 뷰 페이지로 재이동(시각장애인)
Route::post('/blindcare/questionCommentRegist',                 'VideoCallController@questionCommentRegist')->name('qCRegist');         // 질문게시판 댓글 작성 후 질문게시판 뷰 페이지로 재이동(봉사자)
Route::get('/blindcare/questionListComment',                    'VideoCallController@questionListComment')->name('qLComment');          // 내 질문리스트 및 봉사자 답변 페이지로 이동(시각장애인)
Route::get('/blindcare/volunteerTimePresent',                   'VideoCallController@volunteerTimePresent')->name('vTPresent');         // 현재 매칭 가능한 봉사자 조회(시각장애인)

Route::get('/blindcare/volunteerTimePresentApp',                'VideoCallController@volunteerTimePresentApp')->name('vTPresentApp');   // 현재 매칭 가능한 봉사자 조회(앱, 시각장애인)
Route::post('/blindcare/fileUploadApp',                         'VideoCallController@fileUploadApp')->name('fUploadApp');               // 질문 등록 파일업로드(앱, 시각장애인)
Route::get('/blindcare/myQuestionCommentApp',                   'VideoCallController@myQuestionCommentApp')->name('mQCommentApp');      // 내 질문리스트 및 봉사자 답변 페이지로 이동(앱, 시각장애인)
Route::get('/blindcare/questionListApp',                        'VideoCallController@questionListApp')->name('qListApp');               // 시각장애인이 등록한 질문 리스트 화면으로 이동(앱, 봉사자)
Route::get('/blindcare/questionViewApp',                        'VideoCallController@questionViewApp')->name('qViewApp');               // 시각장애인이 등록한 질문 뷰 화면 로드(앱, 봉사자)
Route::get('/blindcare/questionCommentRegistApp',               'VideoCallController@questionCommentRegistApp')->name('qCRegistApp');   // 질문게시판 댓글 작성 후 질문게시판 뷰 페이지로 재이동(앱, 봉사자)
Route::get('/blindcare/volunteerTimeListApp',                   'VideoCallController@volunteerTimeListApp')->name('vTListApp');         // 봉사자 봉사시간 조회 페이지로 이동(앱, 봉사자)
Route::get('/blindcare/volunteerTimeRegistApp',                 'VideoCallController@volunteerTimeRegistApp')->name('vTRegistApp');     // 봉사자 봉사시간 등록 후 조회 페이지로 이동(앱, 봉사자)

// 웹rtc를 이용하기 위해 id값 전달
Route::get('/blindcare/idRegistApp',                           'VideoCallController@idRegistApp')->name('iRegistApp');                      // 봉사자의 웹rtc id 저장(앱, 봉사자)
Route::get('/blindcare/idRegist/{id}',                         'VideoCallController@idRegist')->name('iRegist');                            // 봉사자의 웹rtc id 저장(웹, 봉사자)
Route::get('/blindcare/idLoadApp',                             'VideoCallController@idLoadApp')->name('iLoadApp');                         // 봉사자의 웹rtc id 로드(웹, 시각장애인)

//쇼핑몰                          // 봉사자의 웹rtc id 저장(웹, 봉사자)
Route::get('/shop',                                            'ShopController@index')->name('shop');
Route::get('/shop/shopWrite',                                  'ShopController@Write')->name('write'); // 상품등록페이지 이동
Route::post('/shop/productUp',                                 'ShopController@productUp')->name('productUp'); //관리자의 상품 등록
Route::get('/shop/productDetails/{id}',                        'ShopController@details')->name('details/{id}'); // 상품 정보 
Route::get('/shop/admin',                                      'ShopController@admin')->name('admin');   //관리자의 상품 관리
Route::get('/shop/productDelete/{id}',                      'ShopController@productDelete')->name('productDelete/{id}'); //관리자의 상품 삭제
Route::get('/shop/productBuy/{id}',                            'ShopController@productBuy')->name('productBuy/{id}'); //상품 구매
Route::get('/shop/productModifyPage/{id}',                     'ShopController@productModifyPage')->name('productModifyPage/{id}'); //관리자의 상품 삭제
Route::post('/shop/productModify',                             'ShopController@productModify')->name('productModify'); //관리자의 상품 등록
Route::get('/shop/productBasket/{id}',                         'ShopController@productBasket')->name('productBasket/{id}'); //장바구니페이지 이동
Route::delete('/shop/productBasketDelete{id}',                'ShopController@productBasketDelete')->name('productBasketDelete/{id}'); //장바구니 상품 삭제

