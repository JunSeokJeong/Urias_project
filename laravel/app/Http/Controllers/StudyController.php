<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Study;

class StudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        return view('study.select');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
       $Study= new Study;
       
       $Study->title ="aaa";
       $Study->audiosrc ="aaa";
       $Study->quiz ="aaa";
       $Study->save();
             
    }

    /**
     * Display the specified resource.dq
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)//각각의 교육으로 이동 
    {
       $title=['점자의역사','점자의구성','아이우에오','첨음50음도','탁음반탁음','촉음과장음'
       ,'요음반탁음','특수소리','뛰어쓰기','수와수사','알파벳','표기부호'];
       return view('study.study', ['id' =>$id],['title'=>$title[$id-1]]);
    }
    
    public function quizShow($id)//각각의 퀴즈로 이동 
    {
        $title=['점자의역사','점자의구성','아이우에오','첨음50음도','탁음반탁음','촉음과장음'
       ,'요음반탁음','특수소리','뛰어쓰기','수와수사','알파벳','표기부호'];
        $quiz=" 퀴즈";
        return view('study.quiz', ['id' =>$id],['title'=>$title[$id-1].$quiz]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
