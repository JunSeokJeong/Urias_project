<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;
use Auth;

//E-library 컨트롤러
class VolunteerController extends Controller{

    //도서관 메인페이지로 이동
    public function libIndex() {
        return view('library.library');
        
    }// end libIndex
    
    //봉사목록 페이지로 이동
    public function volunteerList () {
        
        $result = DB::table('volunteer_lists')->orderBy('v_num', 'desc')->paginate(6);
        
        foreach ($result as $book) {
            $check_page = DB::table($book->book_name.'_check')->count();
            $book->c_page = $check_page;
        }
        
        return view('library.volunteerList', ['result' => $result]);
        
    }// end volunteerList
    
    //오역수정봉사세부페이지로 이동
    public function volunteerInfo ($num, $book_name) {
        
        $result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $check_page = DB::table($book_name.'_check')->count();
        $submit_page = DB::table($book_name.'_submit')->count();
        
        return view('library.volunteerInfo', 
        [
            'result' => $result, 
            'book_name' => $book_name, 
            'c_page' => $check_page, 
            's_page' => $submit_page
        ]);
        
    }// end volunteerInfo
    
    // 오역수정페이지로 이동
    public function volunteerInputText ($num, $book_name, $page) {
  
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //제출여부 확인
        $submit = DB::table($book_name.'_submit')->where('page_num', $page)->get();
        if($submit->isEmpty()) {
            $is_submit = false;
            $user = Auth::user()->email;    
            $input_text = Input::get('input_text');
            if ($input_text != null) {
                DB::table($book_name.'_submit')
                ->insert(['s_txt_dir' => $input_text, 'page_num' => $page, 'submit_user' => $user]);
                $is_submit = true;
            }
            
        } else {
            $is_submit = true;
        }
        
        $lsit_result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $end_page = $lsit_result[0]->page;
        $result = DB::table($book_name.'_pages')->where('page_num', $page)->get();
        
        $v_json = json_decode(file_get_contents('./volunteer_img/'.$book_name.'/'.$book_name.'_json/'.$page.'.json'));
                
        return view('library.volunteerInputText', 
        
            [
            'result' => $result, 
            'v_num' => $num, 
            'book_name' => $book_name,
            'end_page' => $end_page,
            'is_submit' => $is_submit,
            'v_json' => $v_json
            ]
        );
        
    }// end volunteerInputText

    // 오역수정페이지로 이동
    public function volunteerInputText2 ($num, $book_name, $page, $temp) {
  
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //제출여부 확인
        $submit = DB::table($book_name.'_submit')->where('page_num', $page)->get();
        if($submit->isEmpty()) {
            $is_submit = false;
            $user = Auth::user()->email;    
            $input_text = Input::get('input_text');
            if ($input_text != null) {
                DB::table($book_name.'_submit')
                ->insert(['s_txt_dir' => $input_text, 'page_num' => $page, 'submit_user' => $user]);
                $is_submit = true;
            }
            
        } else {
            $is_submit = true;
        }
        
        $lsit_result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $end_page = $lsit_result[0]->page;
        $result = DB::table($book_name.'_pages')->where('page_num', $page)->get();
        
        $v_json = json_decode(file_get_contents('./volunteer_img/'.$book_name.'/'.$book_name.'_json/'.$page.'.json'));
        
        $user = Auth::user()->email;
        $join = DB::table($book_name.'_pages')->where('p_user', $user)->orderBy('page_num')->get();
        $result = $join;
        return view('library.volunteerInputText2', 
        
            [
            'result' => $result, 
            'v_num' => $num, 
            'book_name' => $book_name,
            'end_page' => $end_page,
            'is_submit' => $is_submit,
            'v_json' => $v_json,
            'join' => $join,
            'temp' => $temp
            ]
        );
        
    }// end volunteerInputText

    //오역수정 제출 
    public function volunteerInputTextSubmit(Request $request) {
        
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //post 값 받아오기
        $num = $request->input('num');
        $book_name = $request->input('book_name');
        $page = $request->input('page_num');
        $input_text = $request->input('input_text');
        
        //제출여부 확인
        $submit = DB::table($book_name.'_submit')->where('page_num', $page)->get();
        if($submit->isEmpty()) {
            $is_submit = false;
            $user = Auth::user()->email;    
            if ($input_text != null) {
                DB::table($book_name.'_submit')
                ->insert(['s_txt_dir' => $input_text, 'page_num' => $page, 'submit_user' => $user]);
                $is_submit = true;
            }
            
        } else {
            $is_submit = true;
        }
        
        $lsit_result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $end_page = $lsit_result[0]->page;
        $result = DB::table($book_name.'_pages')->where('page_num', $page)->get();
        
        return view('library.volunteerInputText', 
        
            [
            'result' => $result, 
            'v_num' => $num, 
            'book_name' => $book_name,
            'end_page' => $end_page,
            'is_submit' => $is_submit
            ]
        );
    }// end volunteerInputTextSubmit
    
    //오역수정 제출 
    public function volunteerInputTextSubmit2(Request $request) {
        
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //post 값 받아오기
        $num = $request->input('num');
        $book_name = $request->input('book_name');
        $page = $request->input('page_num');
        $input_text = $request->input('input_text');
        $change_list = $request->input('change_list');
        $temp = $request->input('temp');
        
        //제출여부 확인
        $submit = DB::table($book_name.'_submit')->where('page_num', $page)->get();
        if($submit->isEmpty()) {
            $is_submit = false;
            $user = Auth::user()->email;    
            $input_text = Input::get('input_text');
            if ($change_list == "") {
                $change_list = "-1";
            }
            if ($input_text != null) {
                
                DB::table($book_name.'_submit')
                ->insert([
                    's_txt_dir' => $input_text, 
                    'page_num' => $page, 
                    'submit_user' => $user, 
                    'change_list' => $change_list
                ]);
                
                $is_submit = true;
            }
            
        } else {
            $is_submit = true;
        }
        
        $lsit_result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $end_page = $lsit_result[0]->page;
        $result = DB::table($book_name.'_pages')->where('page_num', $page)->get();
        
        $v_json = json_decode(file_get_contents('./volunteer_img/'.$book_name.'/'.$book_name.'_json/'.$page.'.json'));
        
        $user = Auth::user()->email;
        $join = DB::table($book_name.'_pages')->where('p_user', $user)->orderBy('page_num')->get();
        $result = $join;
        return view('library.volunteerInputText2', 
        
            [
            'result' => $result, 
            'v_num' => $num, 
            'book_name' => $book_name,
            'end_page' => $end_page,
            'is_submit' => $is_submit,
            'v_json' => $v_json,
            'join' => $join,
            'temp' => $temp
            ]
        );
        
    }// end volunteerInputTextSubmit
    
    //오역수정검수 페이지로 이동
    public function volunteerCheck ($num, $book_name, $page) {
        
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //현제 페이지 검수 완료 여부 확인
        $check = DB::table($book_name.'_check')->where('page_num', $page)->get();
        
        
        if($check->isEmpty()) {
            
            $is_check = false;
            
            //데이터 저장
            $input_text = Input::get('check_text');
            if ($input_text != null) {
                DB::table($book_name.'_check')
                ->insert(['c_txt_dir' => $input_text, 'page_num' => $page]);
                $is_check = true;
            }
        } else {
            $is_check = true;
        }
        
        //제출 여부 확인
        $submit = DB::table($book_name.'_submit')->where('page_num', $page)->get();
        
        if($submit->isEmpty()) {
            $is_submit = false;
            $submit_txt = "제출되지 않은 페이지 입니다.";    
        } else {
            $is_submit = true;
            $submit_txt = $submit[0]->s_txt_dir;
        }
        
        //총 페이지 수 확인
        $lsit_result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $end_page = $lsit_result[0]->page;
        $result = DB::table($book_name.'_pages')->where('page_num', $page)->get();
        
        
        return view('library.volunteerCheck', 
        
            [
            'result' => $result, 
            'v_num' => $num, 
            'book_name' => $book_name,
            'end_page' => $end_page,
            'is_check' => $is_check,
            'submit_txt' => $submit_txt,
            'is_submit' => $is_submit
            ]
        );
        
    }// end volunteerCheck
    
    //오역수정검수 페이지로 이동
    public function volunteerCheck2 ($num, $book_name, $page) {
        
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //현제 페이지 검수 완료 여부 확인
        $check = DB::table($book_name.'_check')->where('page_num', $page)->get();
        
        
        if($check->isEmpty()) {
            
            $is_check = false;
            
            //데이터 저장
            $input_text = Input::get('check_text');
            if ($input_text != null) {
                DB::table($book_name.'_check')
                ->insert(['c_txt_dir' => $input_text, 'page_num' => $page]);
                $is_check = true;
            }
        } else {
            $is_check = true;
        }
        
        //제출 여부 확인
        $submit = DB::table($book_name.'_submit')->where('page_num', $page)->get();
        
        if($submit->isEmpty()) {
            $is_submit = false;
            $submit_txt = "제출되지 않은 페이지 입니다.";    
            $change_list = "";
        } else {
            $is_submit = true;
            $submit_txt = $submit[0]->s_txt_dir;
            $change_list = $submit[0]->change_list;
        }
        
        //총 페이지 수 확인
        $lsit_result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $end_page = $lsit_result[0]->page;
        $result = DB::table($book_name.'_pages')->where('page_num', $page)->get();
        
        $v_json = json_decode(file_get_contents('./volunteer_img/'.$book_name.'/'.$book_name.'_json/'.$page.'.json'));
        
        return view('library.volunteerCheck2', 
        
            [
            'result' => $result, 
            'v_num' => $num, 
            'book_name' => $book_name,
            'end_page' => $end_page,
            'is_check' => $is_check,
            'submit_txt' => $submit_txt,
            'v_json' => $v_json,
            'is_submit' => $is_submit,
            'change_list' => $change_list
            ]
        );
        
    }// end volunteerCheck
    
    //오역수정 검수 등록
    public function volunteerCheckRegister (Request $request) {
        
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //post 값 받아오기
        $num = $request->input('num');
        $book_name = $request->input('book_name');
        $page = $request->input('page_num');
        $input_text = $request->input('check_text');
        
        //현제 페이지 검수 완료 여부 확인
        $check = DB::table($book_name.'_check')->where('page_num', $page)->get();
        
        
        if($check->isEmpty()) {
            
            $is_check = false;
            
            //데이터 저장
            if ($input_text != null) {
                DB::table($book_name.'_check')
                ->insert(['c_txt_dir' => $input_text, 'page_num' => $page]);
                $is_check = true;
            }
        } else {
            $is_check = true;
        }
        
        
        //제출 여부 확인
        $submit = DB::table($book_name.'_submit')->where('page_num', $page)->get();
        
        if($submit->isEmpty()) {
            $is_submit = false;
            $submit_txt = "제출되지 않은 페이지 입니다.";    
        } else {
            $is_submit = true;
            $submit_txt = $submit[0]->s_txt_dir;
        }
        
        
        //총 페이지 수 확인
        $lsit_result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $end_page = $lsit_result[0]->page;
        $result = DB::table($book_name.'_pages')->where('page_num', $page)->get();
        
        
        return view('library.volunteerCheck', 
        
            [
            'result' => $result, 
            'v_num' => $num, 
            'book_name' => $book_name,
            'end_page' => $end_page,
            'is_check' => $is_check,
            'submit_txt' => $submit_txt,
            'is_submit' => $is_submit
            ]
        );
        
    }// end volunteerCheck
    
    //오역수정 검수 등록
    public function volunteerCheckRegister2 (Request $request) {
        
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //post 값 받아오기
        $num = $request->input('num');
        $book_name = $request->input('book_name');
        $page = $request->input('page_num');
        $input_text = $request->input('check_text');
        
        //현제 페이지 검수 완료 여부 확인
        $check = DB::table($book_name.'_check')->where('page_num', $page)->get();
        
        
        if($check->isEmpty()) {
            
            $is_check = false;
            
            //데이터 저장
            if ($input_text != null) {
                DB::table($book_name.'_check')
                ->insert(['c_txt_dir' => $input_text, 'page_num' => $page]);
                $is_check = true;
            }
        } else {
            $is_check = true;
        }
        
        //제출 여부 확인
        $submit = DB::table($book_name.'_submit')->where('page_num', $page)->get();
        
        if($submit->isEmpty()) {
            $is_submit = false;
            $submit_txt = "제출되지 않은 페이지 입니다.";    
            $change_list = "";
        } else {
            $is_submit = true;
            $submit_txt = $submit[0]->s_txt_dir;
            $change_list = $submit[0]->change_list;
        }
        
        //총 페이지 수 확인
        $lsit_result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $end_page = $lsit_result[0]->page;
        $result = DB::table($book_name.'_pages')->where('page_num', $page)->get();
        
        $v_json = json_decode(file_get_contents('./volunteer_img/'.$book_name.'/'.$book_name.'_json/'.$page.'.json'));
        
        return view('library.volunteerCheck2', 
        
            [
            'result' => $result, 
            'v_num' => $num, 
            'book_name' => $book_name,
            'end_page' => $end_page,
            'is_check' => $is_check,
            'submit_txt' => $submit_txt,
            'v_json' => $v_json,
            'is_submit' => $is_submit,
            'change_list' => $change_list
            ]
        );
        
    }// end volunteerCheck
    
    // 봉사활동 목록 등록 페이지로 이동
    public function volunteerInsert () {
        
        return view('library.volunteerInsert');
        
    }// end volunteerInsert
    
    // 봉사활동 등록
    public function newVolunteerList (Request $request) {
        
        //로그인 확인
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //POST 값 받기
        $book_name = $request->input('book_name');
        $content = $request->input('content');
        $book_img = $request->file('img_file');
        $book_main_img = $request->file('main_img');
        
        //입력값 확인
        if(!$book_name) {
            
            echo "<script>
                window.alert('책 이름을 입력하세요');
                history.go(-1);
            </script>";
        
        } else if(!$content) {
            
            echo "<script>
                window.alert('내용을 입력하세요');
                history.go(-1);
            </script>";
        
        } else if(!$book_img) {
            
            echo "<script>
                window.alert('책 이미지를 등록하세요');
                history.go(-1);
            </script>";
        
        } else if(!$book_main_img) {
            
            echo "<script>
                window.alert('대표이미지를 등록하세요');
                history.go(-1);
            </script>";
        }
        
        //대표이미지 경로 설정
        $main_img_dir = '/volunteer_img/'.$book_name.'/';
        $main_img_Path = '.'.$main_img_dir;
        $main_book_img_name = $book_name.'_main_img.'.$book_main_img->getClientOriginalExtension();
        $main_img_dir = $main_img_dir.$main_book_img_name;
        
        //대표 이미지 저장
        $book_main_img->move($main_img_Path, $main_book_img_name );
         
        $user = Auth::user()->email;  
        
        //volunteerList table 저장
        DB::table('volunteer_lists')->insert([
                'book_name' => $book_name, 
                'page' => count($book_img), 
                'v_content' => $content,
                'writer' => $user,
                'write_date' => date('Y-m-d (H:i:s)'),
                'main_img_dir' => $main_img_dir,
                'page_remains' => 0
        ]);
        
        //폴더만들기
        system('mkdir volunteer_img/'.$book_name);
        system('mkdir volunteer_img/'.$book_name.'/'.$book_name.'_json');
        system('mkdir volunteer_img/'.$book_name.'/'.$book_name.'_pri_img');
        
        //DB테이블 생성
        Schema::create($book_name.'_pages', function($table) {
            $table->increments('p_num');
            $table->string('p_img_dir', 100);
            $table->text('p_pri_text');
            $table->integer('page_num');
            $table->string('p_user', 50);
        });
        
        Schema::create($book_name.'_submit', function($table) {
            $table->increments('s_num');
            $table->text('s_txt_dir');
            $table->integer('page_num');
            $table->string('submit_user', 50);
            $table->text('change_list');
        });
        
        Schema::create($book_name.'_check', function($table) {
            $table->increments('c_num');
            $table->text('c_txt_dir');
            $table->integer('page_num');
        });
        
        //이미지 경로 설정
        $dir = '/volunteer_img/'.$book_name.'/'.$book_name.'_pri_img/';
        $path = '.'.$dir;
        
        //폴더에 이미지 저장
        for ($i = 0; $i < count($book_img); $i++) {
            
            $book_img_name = $book_name.'_pri_'.($i + 1).'page.'.$book_img[$i]->getClientOriginalExtension();
            $book_img[$i]->move($path, $book_img_name );
            
            //비동기식 동작
            pclose(popen('php ./php/background.php -i='.$i.' --book_name='.$book_name.' --book_img_name='.$book_img_name.' --path='.$path.' &', 'w')); 
            
            // system('node ./js/visionAPI.js '. ($i + 1) .' '.$path.$book_img_name.' '.$book_name);
            // $img_text = json_decode(file_get_contents('./volunteer_img/'.$book_name.'/'.$book_name.'_json/'.($i + 1).'.json')); 
            
            
            // //db에 값 저장
            // DB::table($book_name.'_pages')->insert([
                
            //     'p_img_dir' => $dir.$book_img_name, 
            //     'p_pri_text' => $img_text->responses[0]->textAnnotations[0]->description, 
            //     'page_num' => ($i + 1)
            // ]);
        }    

        //봉사자 확인
        $user_table = DB::table('users')->where('type', '일반인')->get();
        
        //봉사자에게 등록 메시지 보내기
        foreach ($user_table as $volunteer) {
            
            DB::table('message')->insert([
                
                'm_title' => $book_name.'책이 등록되었습니다.', 
                'send_user' => $user, 
                'for_user' => $volunteer->email, 
                'm_content' => $book_name."책이 등록되었습니다. 시간이 되신다면 봉사활동 부탁드립니다.<a href='/library/volunteerList'>바로기기</a>", 
                'is_check' => false, 
                'send_date' => date('Y-m-d (H:i:s)')
            ]);    
        }
        
        
        
        return redirect()->route('vList');
    
        
    }// end newVolunteerList
    
    // 봉사활동 목록 삭제
    public function delVolunteerList($num, $book_name) {
        
        system('rm -rf volunteer_img/'.$book_name);
        DB::table('volunteer_lists')->where('v_num', $num)->delete();
        Schema::drop($book_name.'_submit');
        Schema::drop($book_name.'_check');
        Schema::drop($book_name.'_pages');
        
        return redirect()->route('vList');
    }//end delVolunteerList
    
    // 책등록 페이지로 이동
    public function newbookInsert ($num, $book_name) {
        
        $result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        return view('library.newbookInsert', ['result' => $result]);
        
    }// end newbookInsert

    // 새로운 책 등록
    public function newbookRegister(Request $request) {
        
        //로그인 확인
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //POST 값 받기
        $book_name = $request->input('book_name');
        $content = $request->input('content');
        $b_writer = $request->input('b_writer');
        $genre = $request->input('genre');
        $num = $request->input('num');
        
        //입력값 확인
        if(!$book_name) {
            
            echo "<script>
                window.alert('책 이름을 입력하세요');
                history.go(-1);
            </script>";
        
        } else if(!$b_writer) {
            
            echo "<script>
                window.alert('저자를 입력하세요');
                history.go(-1);
            </script>";
        
        } else if(!$content) {
            
            echo "<script>
                window.alert('내용을 입력하세요');
                history.go(-1);
            </script>";
        
        } else if(!$genre) {
            
            echo "<script>
                window.alert('장르를 입력하세요');
                history.go(-1);
            </script>";
        }
        
        //폴더만들기
        system('mkdir book_list/'.$book_name);
        system('mkdir book_list/'.$book_name.'/'.$book_name.'_sound');
        system('mkdir book_list/'.$book_name.'/'.$book_name.'_text');
        
        $user = Auth::user()->email;  
        $result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $book_img_dir = $result[0]->main_img_dir;
        $page = $result[0]->page;
        $check_table = DB::table($book_name.'_check')->get();
        $sound_txt = "";
        
        
        //텍스트 파일 저장
        foreach ($check_table as $c_page) {

            $sound_txt = "";
            $file_path = "book_list/".$book_name."/".$book_name."_text/".$book_name."_".$c_page->page_num.".txt";
            $txt = $c_page->c_txt_dir;
            $txt = trim($txt);
            $txt = nl2br($txt);
            $txt = explode('<br />' , $txt);
            
            foreach($txt as $text) {
                
                $text = trim($text);
                $text = strtr($text, "(", " ");
                echo $text."<br>";
                $text = strtr($text, ")", " ");
                echo $text."<br>";
                $sound_txt .= $text;
                system('echo '.$text.' | kakasi -JH -KH -s -i utf-8 -o utf-8 >> '.$file_path);
                
            }
            $this->createSoundBook($book_name,$c_page,$sound_txt);//음성파일생성
        }
        
        
        
        //book_list table 저장
        DB::table('book_lists')->insert([
                'book_name' => $book_name, 
                'book_writer' => $b_writer, 
                'book_registrater' => $user,
                'registration_date' => date('Y-m-d (H:i:s)'),
                'text_file_dir' => '/book_list/'.$book_name.'/'.$book_name.'_text',
                'sound_file_dir' => '/book_list/'.$book_name.'/'.$book_name.'_sound',
                'book_img_dir' => $book_img_dir,
                'book_page_num' => $page,
                'book_intro' => $content,
                'book_genre' => $genre
        ]);
        
        //시각장애인 확인
        $user_table = DB::table('users')->where('type', '시각장애인')->get();
        
        //봉사자에게 등록 메시지 보내기
        foreach ($user_table as $blind) {
            
            DB::table('message')->insert([
                
                'm_title' => $book_name.'책이 등록되었습니다.', 
                'send_user' => $user, 
                'for_user' => $blind->email, 
                'm_content' => $book_name."책이 등록되었습니다. 이후 이용이 가능합니다.<a href='/library/bookList'>바로기기</a>", 
                'is_check' => false, 
                'send_date' => date('Y-m-d (H:i:s)')
            ]);    
        }
        
        return redirect()->route('bList');
    }// end newbookRegister

    //봉사활동 참여 등록 
    public function joinVolunteer(Request $request) {
    
        //로그인 확인
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //유저 아이디
        $user = Auth::user()->email;  
        
        //POST 값 받기
        $page_vol = $request->input('page_vol');
        $num = $request->input('num');
        $book_name = $request->input('book_name');

        //DB쿼리
        $result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $p_page = DB::table($book_name.'_pages')->get();
        $check_page = DB::table($book_name.'_check')->count();
        $submit_page = DB::table($book_name.'_submit')->count();
        
        //할당페이지 숫자 받기
        $page = $result[0]->page_remains;
        $total_page = $result[0]->page;
        
        //할당페이지 가능여부
        if(($total_page - $page) < $page_vol) {
            
            //할당 불가 메세지 설정
            echo "<script>
                window.alert('페이지가 모자랍니다.');
            </script>";
            
        } else {
            //페이지 할당
            for($i = $page; $i <= $page_vol + $page; $i++) {
                DB::table($book_name.'_pages')->where('page_num', $i)->update(['p_user' => $user]);
            }
            DB::table('volunteer_lists')->where('v_num', $num)->update(['page_remains' => ($page_vol + $page)]);
        }
        
        $result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        
        //참여 확인
        $join = DB::table($book_name.'_pages')->where('p_user', $user)->orderBy('page_num')->get();
        if($join->isEmpty()) {
            $is_join = false;
        } else {
            $is_join = true;
        }

        return view('library.volunteerJoin', 
        [
            'result' => $result, 
            'book_name' => $book_name, 
            'c_page' => $check_page, 
            's_page' => $submit_page,
            'join' => $join,
            'is_join' => $is_join
        ]);
        
    } // end joinVolunteer
    
    //봉사활동 참여 등록 페이지 이동
    public function joinVolunteerPage($num, $book_name) {
        
        //로그인 확인
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        //유저 아이디
        $user = Auth::user()->email;  
        
        $result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $check_page = DB::table($book_name.'_check')->count();
        $submit_page = DB::table($book_name.'_submit')->count();
        $p_page = DB::table($book_name.'_pages')->get();
        
        //참여 확인
        $join = DB::table($book_name.'_pages')->where('p_user', $user)->orderBy('page_num')->get();
        if($join->isEmpty()) {
            $is_join = false;
        } else {
            $is_join = true;
        }
        
        return view('library.volunteerJoin', 
        [
            'result' => $result, 
            'book_name' => $book_name, 
            'c_page' => $check_page, 
            's_page' => $submit_page,
            'join' => $join,
            'is_join' => $is_join
        ]);
        
    } // end joinVolunteerPage

    //음성 도서 파일 생성
    public function createSoundBook($bName,$c_page,$txt){
        
        $book_name = $bName; //책이름
        $file_path = "book_list/".$book_name."/".$book_name."_sound/".$book_name."_".$c_page->page_num.".mp3"; //파일 경로
        exec('curl -d "speaker=shinji&speed=3&text='.$txt.'" "https://openapi.naver.com/v1/voice/tts.bin" -H "Content-Type: application/x-www-form-urlencoded" -H "X-Naver-Client-Id: vNHreBxbxgY2tuSPXJ1v" -H "X-Naver-Client-Secret: drf6m2K5jw" > '.$file_path);
        
    }

}//end class

?>
