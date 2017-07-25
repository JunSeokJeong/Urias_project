<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Board;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        
        $result = DB::table('volunteer_lists')->get();
        
        foreach ($result as $book) {
            $check_page = DB::table($book->book_name.'_check')->count();
            $book->c_page = $check_page;
        }
        
        
        $question = DB::table('blind_questions')->orderBy('num', 'desc')->paginate(5);
        
        $count = 0;
        
        foreach($question as $data) {
            $comment_count[$count] = DB::table('volunteer_comments')->where('question_num', '=', $data->num)->count();
            
            $count++;
        }
      
        
        
        $message = 0;
        
        if(Auth::check()) {
            $user = Auth::user()->email;
            
            $message = DB::table('message')->where('for_user', $user)->where('is_check', false)->count();
            
            $request->session()->put('message', $message);
        }
        
     
        $board = board::orderBy('created_at','desc')->paginate(5);
       
        return view('index', [
            'result' => $result,
            'question' => $question,
            'comment_count' => $comment_count,
            'board' => $board
        ]);
    }
    
    //마이페이지 이동
    public function mypage() {
        
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        
        return view('mypage.mypage');
    }// end mypage
   
}
