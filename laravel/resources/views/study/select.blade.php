@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">
       .info{
              background-color:white;
              width:300px;
              color:black;
       }
       
       h4{
              color:black;
       }
       .menubtn{
              width:200px;
       }
 </style>


@if (Auth::check())
    @if(Auth::user()->type=="시각장애인")
<div class="row"> 

<center>
       <div class="page-header">
            <h1 alt="점자 교육 목록">점자 교육 목록</h1>
       </div>
</center>

        
          
          <div class="col-md-2">  
          <br> 
        

          </div>
          <div class="col-md-4" >
        
          <br><br> <br><br> 
          
          @for($i = 0; $i <6; $i++)
          
           <a type="button" class="info btn"  alt="{{$select[$i]->title}}" id="focus_{{$i+1}}" href="study/{{$i+1}}" >
            <h4>
            {{$i+1}}.{{$select[$i]->title}}
            @if(in_array($i+1,$new))
           
           수강완료
           @endif
           </h4>
           </a>
           
          
                   
          @endfor
       
         
          </div>
          <div class="col-md-4">
        
          <br><br> <br><br> 
           @for($i = 6; $i <12; $i++)
       <a class="info btn" href="study/{{$i+1}}" style="color:black;">
       <h4>
       {{$i+1}}.{{$select[$i]->title}}
        @if(in_array($i+1,$new))
           
           수강완료
           @endif
       </h4>
        </a>
       
         
          @endfor
          
           </div>
          <div class="col-md-2"></div>
                    
        </div> 
        <div class="row"> 
          <div class="col-md-3">
           
          </div>
          <div class="col-md-6">
          <br>  <center>
           <button  type="button" class="menubtn btn btn-dark-green" onclick="upfocus()">화면맨위로</button><br><br>
           <button type="button" class="menubtn btn btn-dark-green" onclick='back()'>이전메뉴로</button><br><br>
           <a href="{{ route('index') }}" ><button type="button" class="menubtn btn btn-dark-green">메인메뉴로</button></a>
           </center>
          </div>
          <div class="col-md-3">
           
          </div>
                    
        </div>
        @else 
        <h1>시각장애인만 이용가능합니다</h1>
        @endif
        
        @else
        
    <h1>시각장애인만 이용가능합니다</h1>
    @endif
        <script >
  function upfocus(){
         document.getElementById('focus_1').focus();
  }
  function back(){
       history.go(-1);
  }
        </script>
@endsection