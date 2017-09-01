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

.profile{
       width:1200px;
       height:600px;
}
.picture{
       width:300px;
       height:350px;
       padding:30px;
       float:left;
}
.picture_img{
       width:280px;
       height:280px;
       /*border:5px solid black;*/
}
.info{
       margin-left:300px;
       width:800px;
       height:400px;
       padding:30px;
}
.progress{
       width:700px;
}
.btn_info{
       width:680px;
       background-color:white;
       color:black;
}
</style>
@if (Auth::check())


<center>
       
       <div class="page-header">
              <h2>나의 교육 상태</h2>
       </div>

</center>
       <br>
       
       <div class="contents">
              <div class="profile">
                     <div class="picture">
                            <div class="picture_img">
                                   <img class="picture_img" src="./man.png"></img>
                            </div>
                            <!--<h3>가입일: </h3>-->
                            <!--<h3>{{Auth::user()->created_at}}</h3>-->
                     </div>
                     
                     <div class="info">
                            <center>
                                   <div class="progress">
                                          <div class="progress-bar btn-default" role="progressbar" aria-valuenow="{{$clearpercent}}" aria-valuemin="0" aria-valuemax="100" style="width:{{$clearpercent}}%;">
                                          {{$clearpercent}}%
                                          </div>
                                   </div>       
                            </center>
                          
                            <button type="button" class="btn btn-lg btn_info"><h4 class="sirase">총 {{$count}} 개의 교육중에서 {{$clearcount}}개의 교육을 완료 했습니다.</h4></button>
                            <button type="button" class="btn btn-lg btn_info" ><h4 class="sirase">{{ Auth::user()->name }}님의 남은 교육은 {{$count-$clearcount}}개 입니다</h4> </button><BR></BR>
                            <a class="menubtn btn btn-primary" href="{{route('select')}}" ><h4>점자 교육</h4></a>
                            <a class="menubtn btn btn-dark-green"  href="{{route('index')}}" ><span></span><h4>메인으로</h4></a>
                            <a class="menubtn btn btn-dark-green"  href="/result/{{Auth::user()->id}}" ><span></span><h4>테스트 결과</h4></a>
                     </div>
              </div>
              <!--<div class="move_btn">-->
                     
              <!--</div>-->
       </div>
       
       <br>
   
@endif 
       

@stop 
