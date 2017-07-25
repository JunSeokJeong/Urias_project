@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
       .info{
              background-color:white;
              width:300px;
       }
       .info2{
              background-color:green;
              color:white;
              width:200px;
       }
       h4{
              color:black;
       }
       .btn{
              width:300px;
       }
</style>

<div class="row"> 
<center>
       <div class="page-header">
            <h1 alt="퀴즈 목록">퀴즈 목록</h1>
       </div>
</center>

        
          
          <div class="col-md-2">  
          <br> 
        
        
          <!--<h4> 퀴즈 목록 </h4>-->
          </div>
          <div class="col-md-4" >
        
          <br><br> <br><br> 

          @for($i = 0; $i <6; $i++)
           
          
           <a class="info btn btn-lg " href="quiz/{{$i+1}}" id="focus_{{$i+1}}" style="color:black;"><h4>{{$i+1}}.{{$select[$i]->title}}퀴즈</h4>   
           
           </a>
          
        
          @endfor
          
       
         
          </div>
          <div class="col-md-4">
        
          <br><br> <br><br> 
           @for($i = 6; $i <12; $i++)
         
        <a class="info btn btn-lg " href="quiz/{{$i+1}}"  id="focus_{{$i+1}}" style="color:black;">  <h4>{{$i+1}}.{{$select[$i]->title}} 퀴즈</h4>
       
        </a>
         
          @endfor
          
           </div>
          <div class="col-md-2"></div>
                    
        </div> 
        <div class="row"> 
          <div class="col-md-3">
           
          </div>
          <div class="col-md-6">
          <br>
          <center>
              <button  class=" info2 btn btn-lg" onclick="upfocus()">화면맨위로</button><br><br>
              <button  class="info2 btn btn-lg" onclick='back()'>이전메뉴로</button><br><br>
              <a href="{{ route('index') }}" class=" info2 btn btn-lg">메인메뉴로</a>
           </center>
          </div>
          <div class="col-md-3">
           
          </div>
                    
        </div>
                <script >
              
  function back(){
       history.go(-1);
  }
    function upfocus(){
         document.getElementById('focus_1').focus();
  }
        </script>
@endsection