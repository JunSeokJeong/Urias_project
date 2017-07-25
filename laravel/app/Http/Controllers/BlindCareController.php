<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class BlindCareController extends Controller{

    //블라인드케어 메인 페이지로 이동
    public function blindIndex () {
        
        return view('blindcare.blindIndex'); 
    }//end blindIndex
    
    //낙상사고 위치 조회페이지로 이동
    public function fallingLocation() {
        
        $result = DB::table('falling_location')->get();
        
        return view('blindcare.fallingLocation', ['result' => $result]);
    }
    
    //낙상사고 위치 등록
    public function fallingLocationInsert() {
        
        $result = array();
        
        $callback = $_GET['callback'];
        $lat = $_GET['lat'];
        $lng = $_GET['lng'];
        $falling_user = $_GET['falling_user'];
        $register_user = $_GET['register_user'];
        $l_title = $_GET['l_title'];
        
        
        DB::table('falling_location')->insert([
                
                'l_title' => $l_title, 
                'falling_user' => $falling_user, 
                'register_user' => $register_user, 
                'f_content' => '넘어졌넹 아코>^<', 
                'f_date' => date('Y-m-d (H:i:s)'), 
                'lat' => $lat,
                'lng' => $lng,
                'falling_img' => '/blindcare/falling_img/no_falling_img.png'
        ]);
        
        $result = array('lat' => $lat, 'lng' => $lng);
        
        echo $callback."(".json_encode($result).")";
    }//end fallingLocationInsert
    

    
    public function insertFallingInfo(Request $request) {
        
        //post 값 받아오기
        $f_num = $request->input('f_num');
        $f_title = $request->input('l_title');
        $f_content = $request->input('f_content');

        DB::table('falling_location')->where('f_num', $f_num)->update(array('l_title' => $f_title, 'f_content' => $f_content));
        
        $result = DB::table('falling_location')->where('f_num', $f_num)->get();
        return view('blindcare.fallingInfo', ['result' => $result]);
    }// end insertFallingInfo
    
    public function fallingInfo($num) {
        
        $result = DB::table('falling_location')->where('f_num', $num)->get();
        return view('blindcare.fallingInfo', ['result' => $result]);
    }// end fallingInfo
    
    public function insertFallingPage($num) {
        
        $result = DB::table('falling_location')->where('f_num', $num)->get();
        return view('blindcare.insertFallingPage', ['result' => $result]);
    }// end insertFallingPage
    
}//end class

?>
