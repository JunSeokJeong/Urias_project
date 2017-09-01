<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Study_list;
use App\Study_check;
use App\Quiz_list;
use App\Example;
use App\Result;

use Auth;
use Session;


class StudyController extends Controller
{
    

    
    
       public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
        $count = Study_list::all()->count();//점자 교육의 모든 개수 
        $clearcount = Study_check::where('playerid', '=',Auth::user()->id )->count();// 사용자가 수강한 점자교육 개수 
        $clearpercent= round(($clearcount/$count)*100);
         
         
         return view('study.index',[  
        'count' =>$count,
        'clearcount'=>$clearcount,
        'clearpercent'=>$clearpercent,
         ]  );
    }
   
    public function quizselect(){
         $selects =Study_list::all();
         
        if(Auth::check()){
        $playerid=Study_check::where('playerid','=',Auth::user()->id )->get();
        }
        $new=array();
       
        for($i=0;$i<12;$i++){
            
            if(empty($playerid[$i])){
                array_push($new,0);
            }
            else
            {
                for($a=0;$a<12;$a++){
                    if($a==$playerid[$i]->studyid-1)
                    {
                         array_push($new,$playerid[$i]->studyid);
                    }
                    
                    
                }
               
            }
               
                
            }
           
            
            
        
       
        return view('study.quizselect',[  
        'select' =>$selects,
        'new'=>$new,
         ]  );
    }
    public function studyselect(){
        
        $selects =Study_list::all();
        if(Auth::check()){
        $playerid=Study_check::where('playerid','=',Auth::user()->id )->get();
        }
        $complete= Study_check::all();
        $new=array();
       
        for($i=0;$i<12;$i++){
            
            if(empty($playerid[$i])){
                array_push($new,0);
            }
            else
            {
                for($a=0;$a<12;$a++){
                    if($a==$playerid[$i]->studyid-1)
                    {
                         array_push($new,$playerid[$i]->studyid);
                    }
                    
                    
                }
               
            }
               
                
            }
           
            
            
        
       
        return view('study.select',[  
        'select' =>$selects,
        'complete'=>$complete,
        'new'=>$new,
         ]  );
    }

    public function studysend(Request $request)
    {
        $id=$request->input('id');
        $second=$request->input('second');
        $kanji=$request->input('kanji');
     
       
       system('mkdir ./brail_study/chapter'.$id);
       system('echo '.$second. ' > ./brail_study/chapter'.$id.'/setsecond.txt ');
       system('echo '.$kanji. ' > ./brail_study/chapter'.$id.'/setkanji.txt ');
      
        return redirect('adinput/'.$id);
             
    }
       public function quizResultProcess($id){
       $text_array = array();
       $count=DB::table('results')->max('count');
       if(!isset($count)){
           $count=0;   
       }
       $answer=array();
       $choice=array();
        for ($i = 0; $i < mb_strlen($id,"UTF-8"); $i++) {
           $char = mb_substr ($id, $i, 1, 'UTF-8');
           array_push ($text_array, $char);
         }
         
      for($i=0;$i<count($text_array);$i++){
             if($i>1){
                   array_push($answer,$text_array[$i]);
             }
             else{
                    array_push($choice,$text_array[$i]);
             }
                    
      }
     $count++;
     for($a=0;$a<2;$a++){
            $results= new Result;
            $results->count=$count;
            $results->userid=Auth::user()->id;
            $results->quiznum=Session::get('quiznum');
            $results->example=$a+1;
            $results->answer=$answer[$a];
            $results->choice=$choice[$a];
            $results->save();
     }
         
        return redirect('/result/'.Session::get('quiznum'));  
       
     
    }
     public function quizsend(Request $request)
    {
        $id=$request->input('id');
        $second=$request->input('second');
        $kanji=$request->input('kanji');
     
       
       system('mkdir ./brail_study/chapter'.$id);
       system('mkdir ./brail_study/chapter'.$id.'/quiz');
       system('echo '.$second. ' > ./brail_study/chapter'.$id.'/quiz/setsecond.txt ');
       system('echo '.$kanji. ' > ./brail_study/chapter'.$id.'/quiz/setkanji.txt ');
      
        return redirect('adinput/quiz/'.$id);
             
    }
    
  



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
       public function studyset($id)
    {
       
    $a=system('cat ./brail_study/chapter'.$id.'/setsecond.txt');
    $b=system('cat ./brail_study/chapter'.$id.'/setkanji.txt');
    
        $second =explode(',',$a);
        $kanji= explode(',',$b);
        
        $select=Study_list::find($id);
        return view('study.studyset',
        [
            'select'=>$select,
            'second'=>$second,
            'kanji'=>$kanji,
            ]);
    }
    
     public function  quizset($id)
    {
       
    $a=system('cat ./brail_study/chapter'.$id.'/quiz/setsecond.txt');
    $b=system('cat ./brail_study/chapter'.$id.'/quiz/setkanji.txt');
    
        $second =explode(',',$a);
        $kanji= explode(',',$b);
        
        $select=Quiz_list::find($id);
        return view('study.quizset',
        [
            'select'=>$select,
            'second'=>$second,
            'kanji'=>$kanji,
            ]);
    }
   
     
    public function adinput()
    {
       $studyselects =Study_list::all();
       $quizselects = Quiz_list::all();
       return view('study.adinput',[  
        'studyselects' =>$studyselects,
        'quizselects' =>$quizselects,
         ]   );
    }

    
  
     
    public function studyshow($id)//각각의 교육으로 이동 
    {
   
   $engkanji=system('cat ./brail_study/chapter'.$id.'/setkanji.txt | kakasi -ja -Ha -Ka -i utf-8 -o utf-8' );
   
   $fp= fopen("brail_study/chapter".$id."/setkanji.txt","r"); 
   $kanji = fgets($fp, filesize("brail_study/chapter".$id."/setkanji.txt"));
   fclose($fp);
   
   $fp= fopen("brail_study/chapter".$id."/setsecond.txt","r"); 
   $second = fgets($fp, filesize("brail_study/chapter".$id."/setsecond.txt"));
   fclose($fp);
   
   $kanjiArray=explode(',',$kanji);
   $engkanjiArray=explode(',',$engkanji);
   $secondArray=explode(',',$second);
   
      $study= Study_list::find($id);
     
        
      $check=Study_check::where('studyid','=',$id)
                          ->where('playerid','=',Auth::user()->id)
                          ->count();
     
   
          if ($check ==0 ){ // 중복안되도록 처리할것 
              
              $studylist= new Study_check;
              $studylist->studyid=$study->id;
              $studylist->playerid=Auth::user()->id;
              $studylist->check=true;
              $studylist->save();
           
             return view('study.study', ['study' =>$study,
                                        'second'=>$secondArray,
                                        'kanji'=>$kanjiArray,
                                        'engkanji'=>$engkanjiArray,
                                        ]);
          }
           
            else {
            return view('study.study', ['study' =>$study,
                                        'second'=>$secondArray,
                                        'kanji'=>$kanjiArray,
                                        'engkanji'=>$engkanjiArray,
                                        ]);
            }   
           

    
    }
    
    public function pathedit($id){ //path를 변경하는 form을 제공 
        $select=Study_list::find($id);
        return view('study.pathedit',
        [
            'select'=>$select,
            'id'=>$id,
            ]
        );
        
    }
    
     public function quizpathedit($id){
        $select=Quiz_list::find($id);
        return view('study.quizpathedit',
        [
            'select'=>$select,
            'id'=>$id,
            ]
        );
   }
   
    
    public function pathchange(Request $request,$id){
    $study = Study_list::find($id);

    $study->file_src= $request->input('change');

    $study->save();
    
     return redirect('adinput/path/'.$id);
     
    }
    
    public function quizResult($id){
         $max=DB::table('results')->where('userid','=',$id)->max('count');
         if(!isset($max)){
                $max=1;
         }
         $results = DB::table('results')->where('count', '=',$max)->get();
         return view('study.result',
              [
                     'id'=>$results,
              ]
         );  
    }
    
    
     public function quizpathcchange(Request $request,$id){
    $study = Quiz_list::find($id);

    $study->filesrc= $request->input('change');

    $study->save();
    
     return redirect('adinput/quiz/path/'.$id);
     
    }
    
    public function quizupdate($id){
            $example=Example::where('id','=',$id)->get();
           return view('study.quizupdate',[
                  'example'=>$example[0],
                  ]);
    }
    
    
    public function quizShow($id)//각각의 퀴즈로 이동 
    {  
    Session::put('quiznum', $id);
    $fp= fopen("brail_study/chapter".$id."/quiz/setkanji.txt","r"); 
    $kanji = fgets($fp, filesize("brail_study/chapter".$id."/quiz/setkanji.txt"));
    fclose($fp);
   
    $fp= fopen("brail_study/chapter".$id."/quiz/setsecond.txt","r"); 
    $second = fgets($fp, filesize("brail_study/chapter".$id."/quiz/setsecond.txt"));
    fclose($fp);
   
    $kanjiArray=explode(',',$kanji);
    $secondArray=explode(',',$second);
        
    Study_check::where('playerid', '=',Auth::user()->id )->count();
    $study= Study_list::find($id);
    $quiz= Quiz_list::find($id);
    $example=Example::where('id','=',$id)->get();
       
      
         
            return view('study.quiz',[
         'study' =>$study,
         'quiz'=> $quiz,
         'second'=>$secondArray,
         'kanji'=>$kanjiArray,
         'examples'=>$example,
         ]
    
        );
    }
}
