<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class MypageController extends Controller
{
    
    
    //마이페이지 이동
    public function messageList(Request $request) {
        
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        $user = Auth::user()->email;
        
        // $result = DB::table('message')->where('for_user', $user)->get();
        $result = DB::table('message')->where('for_user', $user)->orderBy('send_date', 'desc')->paginate(10);

        
        return view('mypage.messageList', ['result' => $result]);
    }// end mypage
    
    
    //메세지 내용 보기
    public function messageInfo(Request $request, $num) {
        
        if(!Auth::check()) {
            echo "<script>
                window.alert('로그인이 만료되었습니다.');
            </script>";
            return redirect()->route('index');
        }
        $user = Auth::user()->email;
        DB::table('message')->where('m_num', $num)->update(['is_check' => true]);
        $result = DB::table('message')->where('m_num', $num)->get();
        $message = DB::table('message')->where('for_user', $user)->where('is_check', false)->count();
        $request->session()->put('message', $message);
            
        return view('mypage.messageInfo', ['result' => $result]);
    }//end messageInfo
   
}
