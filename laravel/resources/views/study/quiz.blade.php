@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<div class="row"> 
          <div class="col-md-3">  
          <br> 
        
          </div>
          
          <div class="col-md-6">
              <center> <h1>{{$id}}.{{$title}} </h1></center>
               <br><br>
               
           
            <audio id="soundbar" controls preload="none" style=""> 
  
              <source src="aaa.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
                <br><br>
              
               
            </div>
            

          
          <div class="col-md-3">
          </div>
                    
        </div> 
        
        <div class="row"> 
          <div class="col-md-3">  
          <br> 
        
          </div>
          
          <div class="col-md-6">
              
             <button type="button" class="btn btn-default btn-block">1번</button>
             <button type="button" class="btn btn-default btn-block">2번</button>
             <button type="button" class="btn btn-default btn-block">3번 </button> 
             <button type="button" class="btn btn-default btn-block">4번</button><br>
             <button type="button" class="btn btn-default btn-block">다시듣기</button> 
           
                  
                <center> <h1>출력 되는 글자 </h1></center>
               <br><br>
              <div class="panel-body" style="height: auto; width: 100%; border:5px solid black;"><center>
                <p style="font-size:130px">ア</p>
              </div></center>
            </div>
            
             <br><br>
                
          
          <div class="col-md-3">
             
          </div>
                    
        </div> 
        
        
        <div class="row"> 
          <div class="col-md-4">
           
          </div>
          <div class="col-md-4">
          <br>  
           <button type="button" class="btn btn-default " onclick="back()">이전메뉴로</button> &nbsp;
          <a href="{{route('study') }}"> <button type="button" class="btn btn-default ">초기메뉴로</button></a> &nbsp;
           <button type="button" class="btn btn-default" id="focusUp">화면맨위로</button>
           
          </div>
          <div class="col-md-4">
           
          </div>
                    
        </div> 
            
        
           <script >
              
  function back(){
       history.go(-1);
  }
  
  $( "#focusUp" ).click(function() { 
  alert('ss');
   
});

        </script>
          
@endsection