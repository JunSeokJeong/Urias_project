<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;
use Auth;

//E-library 컨트롤러
class libraryController extends Controller{

    //도서관 메인페이지로 이동
    public function libIndex() {
        
        return view('library.library');
        
    }// end libIndex
    
    //도서목록 페이지 이동
    public function bookList(){
        return view('library.bookList');
    }//end bookList
    
    //나의 도서 목록 페이지 이동
    public function myBookList(){
        return view('library.myBookList');
    }//end myBookList
    
    //봉사목록 페이지로 이동
    public function volunteerList () {
        
        $result = DB::table('volunteer_lists')->get();
        foreach ($result as $book) {
            $submit_page = DB::table($book->book_name.'_submit')->count();
            $book->s_page = $submit_page;
        }
        
        return view('library.volunteerList', ['result' => $result]);
        
    }// end volunteerList
    
    //오역수정봉사세부페이지로 이동
    public function volunteerInfo ($num, $book_name) {
        
        $result = DB::table('volunteer_lists')->where('v_num', $num)->get();
        $submit_page = DB::table($book_name.'_submit')->count();
        
        return view('library.volunteerInfo', ['result' => $result, 'book_name' => $book_name, 's_page' => $submit_page]);
        
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
        
        return view('library.volunteerInputText', 
        
            [
            'result' => $result, 
            'v_num' => $num, 
            'book_name' => $book_name,
            'end_page' => $end_page,
            'is_submit' => $is_submit
            ]
        );
        
    }// end volunteerInputText

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
                'main_img_dir' => $main_img_dir
        ]);
        
        //폴더만들기
        system('mkdir volunteer_img/'.$book_name);
        system('mkdir volunteer_img/'.$book_name.'/'.$book_name.'_complete_text');
        system('mkdir volunteer_img/'.$book_name.'/'.$book_name.'_json');
        system('mkdir volunteer_img/'.$book_name.'/'.$book_name.'_pri_img');
        system('mkdir volunteer_img/'.$book_name.'/'.$book_name.'_submit_text');
        
        //DB테이블 생성
        Schema::create($book_name.'_pages', function($table) {
            $table->increments('p_num');
            $table->string('p_img_dir', 100);
            $table->text('p_pri_text');
            $table->integer('page_num');
        });
        
        Schema::create($book_name.'_submit', function($table) {
            $table->increments('s_num');
            $table->text('s_txt_dir');
            $table->integer('page_num');
            $table->string('submit_user', 50);
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

            
            system('node ./js/visionAPI.js '. ($i + 1) .' '.$path.$book_img_name.' '.$book_name);
            $img_text = json_decode(file_get_contents('./volunteer_img/'.$book_name.'/'.$book_name.'_json/'.($i + 1).'.json')); 
            
            //db에 값 저장
            DB::table($book_name.'_pages')->insert([
                
                    'p_img_dir' => $dir.$book_img_name, 
                    'p_pri_text' => $img_text->responses[0]->textAnnotations[0]->description, 
                    'page_num' => ($i + 1)
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
    public function newbookInsert ($num) {
        
        return view('library.newbookInsert');
        
    }// end newbookInsert

}//end class

?>
