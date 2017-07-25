@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">
       .info1{
        width:200px;
        background-color:#006b96;
        color:white;
       }
       .sirase{
       color:black;
       }
       .menubtn{
              width:200px;
       }
       .info{
              width:700px;
       }
       
</style>
@if (Auth::check())

 @if(Auth::user()->type=="시각장애인")
<center>
       
       <div class="page-header">
              <h2>나의 교육 상태</h2>
       </div>
                     
       <!--<br><br>-->
                     
       <div class="progress">
              <div class="progress-bar btn-default" role="progressbar" aria-valuenow="{{$clearpercent}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$clearpercent}}%;">
              {{$clearpercent}}%
              </div>
       </div>

      
      <div class="col s8 m4 18">
              <button type="button" class="info btn btn-outline-primary waves-effect"><h4 class="sirase">총 {{$count}} 개의 교육중에서 {{$clearcount}}개의 교육을 완료 했습니다.</h4></button>
       <br><br>
              <button type="button" class="info btn btn-outline-primary waves-effect" ><h4 class="sirase">{{ Auth::user()->name }}님의 남은 교육은 {{$count-$clearcount}}개 입니다</h4> </button>
       <br><br>
       </div>
         <br>
                     
       <div class="col s12 m4 l8">
              <a class="menubtn btn btn-primary" href="{{route('select')}}" ><h4>점자 교육 수강 </h4></a>
              <a class="menubtn btn btn-primary"  href="{{route('quizselect')}}" ><h4>점자 퀴즈 풀기</h4></a>
       </div>
       <br><br><br>
              
       <div class="col s12 m4 l8">
              <a class="menubtn btn btn-dark-green"  href="{{route('index')}}" ><span></span><h4>메인으로</h4></a>
       </div>
       <br>
       @else
             <h1>시각장애인만 사용가능합니다</h1>
             @endif 
             
             @endif 
       
</center>
@endsection