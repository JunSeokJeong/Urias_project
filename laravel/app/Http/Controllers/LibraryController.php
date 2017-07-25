<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Collection;
use App\Book_list;
use App\Rental_list;
use Auth;

//E-library 컨트롤러
class libraryController extends Controller{
    

    //도서관 메인페이지로 이동
    public function libIndex() {

        return view('library.library');
        
    }// end libIndex
    
    //도서목록 페이지 이동
    public function bookList(){
        $result = Book_list::all(); 
        return view('library.bookList')->with('result',$result);
    }//end bookList
    
    //나의 도서 목록 페이지 이동
    public function myBookList(){
        // echo "dsfs";
        $result = DB::table('rental_lists')->get();
        // var_dump($result);
        return view('library.myBookList')->with('result',$result);
    }//end myBookList
    
    //나의 도서 목록 페이지 이동
    public function myBookListApp(){
        // $callback = $_GET['callback'];
        // $result = DB::table('aduinoPaths')->where('id',1)->get();
        // echo $callback . "(" . json_encode($result) . ")";
        $callback = $_GET['callback'];
        $email = $_GET['email'];
        $result = DB::table('rental_lists')->where('user_email',$email)->get();
        
        echo $callback . "(" . json_encode($result) . ")";
    
    }//end myBookListApp
    
    public function bookRequest(){
        return view('library.bookRequest');
    }
    public function bookRequestMessage(Request $req){
        $bName = $req->bookName;
        $bWriter = $req->bookWriter;
        $user = Auth::user()->email;
        $date = date("Y-m-d H:i:s");
        $m_content = $bWriter." 작가의 " .$bName. " 도서를 신청합니다.<a href='/library/volunteerList'>바로기기</a>";
        DB::table('message')->insert([
            "m_title"   => "도서신청",
            "is_check"  => false,
            "send_date" => $date,
            "send_user" => $user,
            "for_user"  => "manager1@naver.com",
            "m_content" => $m_content
        ]);
        
        return redirect()->route('library');
        
    }
    public function myBookListApp2(Request $req){
        $callback = $req->input('callback');
        $number = $req->input('number');
        // $callback = $_GET['callback'];
        // $number = $_GET['number'];
        // if($number == "1"){
        //     $num = "1";
        // }
        
        $result = DB::table('aduinoPaths')->where('id',$number)->get();
        echo $callback . "(" . json_encode($result) . ")";
        // $callback = $_GET['callback'];
        // $email = $_GET['email'];
        // $result = DB::table('rental_lists')->where('user_email',$email)->get();
        
        // echo $callback . "(" . json_encode($result) . ")";
    
    }//end myBookListApp
    public function quizList(Request $req){
        $callback = $req->input('callback');
        $number = $req->input('number');
        $result = DB::table('aduinoquizPaths')->where('id',$number)->get();
        echo $callback . "(" . json_encode($result) . ")";
        
    }
    //나의 도서 목록 등록
    public function myBookListAddition(Request $request){
        $user_email = Auth::user()->email;
        $book_number = $request->input('b_no');
        $book_name = $request->input('book_name');
        $book_writer = $request->input('book_writer');
        $result = DB::table('book_lists')->where('b_no',$book_number)->get();
        
        DB::table('rental_lists')->insert([
                'book_number' => $book_number, 
                'user_email'  => $user_email,
                'book_name'   => $book_name,
                'book_writer' => $book_writer,
                'book_img_dir'=> $result[0]->book_img_dir
        ]);
        
        return redirect()->route('bList');
        // $rentalLists = new RentalLists;
        // $rentalLists->book_number = $book_number;
        // $rentalLists->user_email = $user_email;
        // $rentalLists->book_name = $book_name;
        // $rentalLists->book_writer = $book_writer;
    }
    
    //봉사목록 페이지로 이동
    public function volunteerList () {
        
        $result = DB::table('volunteer_lists')->get();
        foreach ($result as $book) {
            $submit_page = DB::table($book->book_name.'_submit')->count();
            $book->s_page = $submit_page;
        }
        
        return view('library.volunteerList', ['result' => $result]);
        
    }// end volunteerList
    
}//end class

?>
