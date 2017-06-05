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
               
           
            <audio id="soundbar" controls preload="none"  ontimeupdate="myFunction(this)"> 
             <!--ontimeupdate 재생중일시 해당 함수를 계속 호출함 -->
             
              <source src="https://html-test-csj01113.c9users.io/mp3/study_{{$id}}.mp3" type="audio/mpeg">
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
              
             <button type="button" class="btn btn-default" id="space" tabindex='1'>일시정지 스페이스바</button>
             <button type="button" class="btn btn-default" id="forward" tabindex='2'>전진 L</button>
             <button type="button" class="btn btn-default" id="back" tabindex='3'>후진 J</button> <br>
             <button type="button" class="btn btn-default" id="fast" tabindex='4'>빠르게 I</button>
             <button type="button" class="btn btn-default" id="general" tabindex='5'>기본속도 K</button>
             <button type="button" class="btn btn-default" id="slow" tabindex='6'>느리게 콤마</button> <br>
             <button type="button" class="btn btn-default" id="up"tabindex='7'>크게 Q</button>
             <button type="button" class="btn btn-default" id="down" tabindex='8'>작게 W</button>
           
           @if($id==12)
           <a href="/study/1"<button type="button" name="next" class="btn btn-default" tabindex='9'>처음단원이동 N</button></a>
                
            @else
             <a href="/study/{{$id+1}}"<button type="button" name="next" class="btn btn-default" tabindex='9'>다음단원이동 N</button></a>
                @endif            
             
            
                <center> <h1>출력 되는 글자 </h1></center>
               <br><br>
              <div class="panel-body" style="height: auto; width: 100%; border:5px solid black;"><center>
                <p style="font-size:130px" id="outText"></p>
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
           <button type="button" class="btn btn-default "tabindex="10" onclick="back()">이전메뉴로</button> &nbsp;
          <a href="{{ route('study') }}"> <button type="button" class="btn btn-default "tabindex="11">초기메뉴로</button></a> &nbsp;
           <button type="button" class="btn btn-default "tabindex="12">화면맨위로</button>
           
          </div>
          <div class="col-md-4">
           
          </div>
                    
        </div> 
        <span id="demo"></span>

  </div>
  
  <script type="text/javascript">
  var secondlate;//이벤트 중복호출을 방지
  document.getElementById("outText").innerHTML="無";

   function myFunction(event) { //재생중일때 계속 호출됨 
    var late=Math.ceil(event.currentTime); // 현재 재생시간을 반올림함 
   

    
    if(late ==3 && secondlate!=late){ //이전 재생초와 다음초가 같을시 작동 하지않도록 
    
        alert("あ");
        document.getElementById("outText").innerHTML="あ";
         secondlate=late;
     
    }
    else if(late ==5 && secondlate!=late)
    {
         
         alert("か");
        document.getElementById("outText").innerHTML="か";
        secondlate=late;
        
    }
     else if(late ==7 && secondlate!=late)
    {
         alert("し");
        document.getElementById("outText").innerHTML="し";
         secondlate=late;
     
    }
     else if(late ==10 && secondlate!=late)
    {
         alert("ゆ");
        document.getElementById("outText").innerHTML="ゆ";
         secondlate=late;
    }
}
 
  
  function back(){ //뒤로가기 함수 
       history.go(-1);
  }
  
  
  var spacecount=0;
  
  
  
  $("#space").click(function() {//스페이스 버튼 클릭 정지와 재생 반복
      if(spacecount %2==0){
    $("#soundbar").trigger('play');
          spacecount++;
     }
    
    else{
    $("#soundbar").trigger('pause');
        spacecount++;
    }
    
});

$( "#forward" ).click(function() { //전진 버튼 클릭 3초앞으로 이동 
 $("#soundbar").prop("currentTime",$("#soundbar").prop("currentTime")+3);
    
});

$( "#back" ).click(function() { //후진 버튼 클릭 3초 뒤으로 이동 
  $("#soundbar").prop("currentTime",$("#soundbar").prop("currentTime")-3);
    
});

$( "#fast" ).click(function() { //빠르게 버튼 
    speed= $('#soundbar').prop("playbackRate")+0.1;
    $("#soundbar").prop("playbackRate",speed);
    
});

$( "#slow" ).click(function() { //느리게 버튼 
    speed= $('#soundbar').prop("playbackRate")-0.1;
    $("#soundbar").prop("playbackRate",speed);
    
});

$( "#general" ).click(function() { //기본 속도 버튼 
     $("#soundbar").prop("playbackRate",1);
    
});

$( "#up" ).click(function() { //사운드크게
      var volume = $("#soundbar").prop("volume")+0.2;
     if(volume >1){
        volume = 1;
                  }
            $("#soundbar").prop("volume",volume);  
    
});

$( "#down" ).click(function() { //사운드작게
     var volume = $("#soundbar").prop("volume")-0.2;
     if(volume <0){
        volume = 0;
    }
            $("#soundbar").prop("volume",volume); 
    
});

$(document).keydown(function( event ) {
  if ( event.which == 32 ) {//스페이스 정지와 재생반복 
     if(spacecount %2==0){
    $("#soundbar").trigger('play');
          spacecount++;
      }
    
    else{
    $("#soundbar").trigger('pause');
        spacecount++;
    }
    
  }
 if ( event.which == 76 ) {//소문자 l 전진
      $("#soundbar").prop("currentTime",$("#soundbar").prop("currentTime")+3);
          
      }
 
if ( event.which == 74 ) {//소문자 j 키 후진 
      $("#soundbar").prop("currentTime",$("#soundbar").prop("currentTime")-3);
          
      }
      
      if ( event.which == 81 ) {//소문자 q 키 음성 크게
     var volume = $("#soundbar").prop("volume")+0.2;
     if(volume >1){
        volume = 1;
                  }
            $("#soundbar").prop("volume",volume);  
          
      }
      
      
       if ( event.which == 87 ) {//소문자 w 키 음성 작게
     var volume = $("#soundbar").prop("volume")-0.2;
     if(volume <0){
        volume = 0;
    }
            $("#soundbar").prop("volume",volume);  
          
      }
        if ( event.which == 73 ) {//소문자 i 키 음성 빠르게
            speed= $('#soundbar').prop("playbackRate")+0.1;
            $("#soundbar").prop("playbackRate",speed);
          
      }
      if ( event.which == 188 ) {// 콤마 키 음성 느리게
            speed= $('#soundbar').prop("playbackRate")-0.1;
            $("#soundbar").prop("playbackRate",speed);
          
      }
      
           if ( event.which == 75 ) {//소문자 k 키 스피드 보통
            $("#soundbar").prop("playbackRate",1);
          
      }
      
       
});
 </script>
@endsection