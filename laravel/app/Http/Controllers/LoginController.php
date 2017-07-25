<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function loginApp(){
        $callback = $_GET['callback'];
        $id = $_GET['id'];
        $pass = $_GET['pass'];
        
        $result = DB::table('users')->where('email',$id)->get();
        if(isset($result[0])){
               
               if(Hash::check($pass,$result[0]->password)){
                      $auth = [];
                      $auth['id']      = $id;
                      $auth['boolean'] = "true";
                      $auth['result']  = "true";
                      echo $callback . "(" . json_encode($auth) . ")";
               
              }else{
                      $auth = [];
                      $auth['boolean'] = "false";
                      $auth['result'] = "passwrod";
                      echo $callback . "(" . json_encode($auth) . ")";
              }
               
        }else{
               $auth = [];
               $auth['boolean'] = "false";
               $auth['result'] = "id";
               echo $callback . "(" . json_encode($auth) . ")";
        }
    }
}
