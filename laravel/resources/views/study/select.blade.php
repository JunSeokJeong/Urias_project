@extends('layouts.master')
@section('title', 'Page Title')



@section('content')

<div class="row"> 
          <div class="col-md-2">  
          <br> 
        
          <h4> 점자 교육 목록 </h4>
          </div>
          <div class="col-md-4" >
        
          <br><br> <br><br> 
          
         <a href="study/1"> <button type="button" class="btn btn-default btn-lg btn-block " >1.점자의 역사</button></a>
        
         <a href="study/2"> <button type="button" class="btn btn-default btn-lg btn-block">2.점자의 구성</button></a>
       
         <a href="study/3"> <button type="button" class="btn btn-default btn-lg btn-block">3.あ,い,う,え,お </button></a>
        
         <a href="study/4"> <button type="button" class="btn btn-default btn-lg btn-block">4.청음 50음도</button></a>
         
         <a href="study/5"> <button type="button" class="btn btn-default btn-lg btn-block">5.탁음 반 탁음 </button></a>
        
         <a href="study/6"> <button type="button" class="btn btn-default btn-lg btn-block">6.촉음 과 장음</button></a>
         
         
          </div>
          <div class="col-md-4">
        
          <br><br> <br><br> 
          <a href="study/7"> <button type="button" class="btn btn-default btn-lg btn-block">7.요음,반탁음</button> </a>
       
          <a href="study/8"><button type="button" class="btn btn-default btn-lg btn-block">8.특수소리</button></a>
          
          <a href="study/9"><button type="button" class="btn btn-default btn-lg btn-block">9.뛰어쓰기</button></a>
         
          <a href="study/10"><button type="button" class="btn btn-default btn-lg btn-block">10.수와수사</button></a>
          
          <a href="study/11"><button type="button" class="btn btn-default btn-lg btn-block">11.알파벳</button></a>
          
          <a href="study/12"><button type="button" class="btn btn-default btn-lg btn-block">12.표기부호</button></a>
          
           </div>
          <div class="col-md-2"></div>
                    
        </div> 
        <div class="row"> 
          <div class="col-md-3">
           
          </div>
          <div class="col-md-6">
          <br>  <center>
           <button type="button" class="btn btn-default" onclick='back()'>이전메뉴로</button> 
           <button type="button" class="btn btn-default ">초기메뉴로</button>
           <button type="button" class="btn btn-default ">화면맨위로</button>
           </center>
          </div>
          <div class="col-md-3">
           
          </div>
                    
        </div>
        <script >
              
  function back(){
       history.go(-1);
  }
        </script>
@endsection