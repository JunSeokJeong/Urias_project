@extends('layouts.fall_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">
.c1 {
  /*padding: 10px;*/
  width: 150%;
}

@media (min-width: 500px) {
  .c1 {
    /*padding: 20px;*/
    font-size: 1.5em;
  }
}

@media (min-width: 800px) {
  .c1 {
    /*padding: 40px;*/
    font-size: 2em;
  }
}       


h4{
       color:black;
}
h4.menubtn {
       color:white;
}

.id_detailli .thumb_cont .info_area {
       width:1500px;
       height:100px;
       /*padding:10px;*/
}
.check_area{
       width:80px;
       height:80px;
       float:left;
       padding:13px;
}

.check_btn{
       width:60px;
       height:60px;
       float:left;
}

.course_btn{
       width:600px;
       height:70px;
       float: left;
}

.learn_btn{
       background-color:white;
       width:200px;
       height:70px;
       color:black;
       float:left;
}
.quiz_btn{
       background-color:white;
       color:black;
       width:200px;
       float:left;
}
.btn-dark-green{
       color:white;
}
 </style>


@if (Auth::check())
   
<div class="row"> 
              <div class="page-header">
                   <h1 alt="점자 교육 목록">점자 교육</h1>
              </div>
              
              <div class="container">
                     <ul class="c1">
                            @for($i = 0; $i <12; $i++)
                            <li style class="id_detailli">
                                   <div class="thumb_cont" >
                                          <div class="info_area">
                                                 <div class="check_area">
                                                        <button type="button" class="check_btn">
                                                        @if(in_array($i+1,$new))
                                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                         @endif
                                                        </button>
                                                 </div>
                                                 <div class="course_list">
                                                        <span>
                                                               <a type="button" class="course_btn btn" id="focus_{{$i+1}}" alt="{{$select[$i]->title}}" href="study/{{$i+1}}">
                                                                      <h4>
                                                                             {{$i+1}}.{{$select[$i]->title}}
                                                                             @if(in_array($i+1,$new))
                                                                                    수강완료
                                                                             @endif
                                                                      </h4>
                                                               </a>
                                                        </span>
                                                 </div>
                                                 <div class="learn_btn_list" >
                                                        <span>
                                                               <a type="button" class="learn_btn btn" id="focus_{{$i+1}}" alt="{{$select[$i]->title}}"  href="study/{{$i+1}}">
                                                                      <h4 class="subject">
                                                                             점자 강의       
                                                                      </h4>
                                                               </a>
                                                        </span>
                                                 </div>
                                                 <div class="quiz_list">
                                                        <span>
                                                               <a type="button" class="quiz_btn btn " id="focus_{{$i+1}}" alt="{{$select[$i]->title}}" href="quiz/{{$i+1}}">
                                                                      <h4 class="subject">
                                                                             점자 퀴즈
                                                                      </h4>
                                                               </a>
                                                        </span>
                                                 </div>
                                                
                                          </div>
                                   </div>
                            </li>
                            @endfor
                     </ul>
              </div>

       
          
       <center>
              <div>
                     <button type="button" class="btn btn-dark-green" onclick="upfocus()"><h4 class="menubtn">화면맨위로</h4></button>
                     <button type="button" class="btn btn-dark-green" onclick='back()'><h4 class="menubtn">이전메뉴로</h4></button>
                     <a type="button" class="btn btn-dark-green" href="{{ route('index') }}"><h4 class="menubtn">메인메뉴로</h4></a>
              </div>
       </center>
</div>

     
        
    
       @endif
<script>
       function upfocus(){
              document.getElementById('focus_1').focus();
       }
       function back(){
              history.go(-1);
       }
</script>
@endsection