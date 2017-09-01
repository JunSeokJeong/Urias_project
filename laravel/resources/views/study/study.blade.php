@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<script type="text/javascript" src="../js/socket.io.js"></script>
<script type="text/javascript">
   
   var studyNumber = {{$study->id}};
   console.log(studyNumber);
   
   var late;// 재생시간
   var text=new Array();//텍스트를 저장할 배열
   var engtext=new Array();//텍스트의 알파벳 저장하는 배열 
   var second=new Array();//시간을 저장하는 배열 
   
   pushAram(studyNumber);
   //페이지 들어왔을때 app에게 push 알람을 보내는 역활
   function pushAram(studyNum){
       var socket = io.connect('http://urias-heoyongjun.c9users.io:8082');
       //이벤트 발생
       
      socket.emit('study start event',{hello:studyNum});//강의 번호 전달
       //이벤트 대기
      socket.on('php event',function(data){
         console.log(data);
      });   
   }
   var id = '{{Auth::user()->email}}';
   
   function pushEvent(){
       //socket.io 서버 연결
       var socket = io.connect('http://urias-heoyongjun.c9users.io:8081');
       //이벤트 발생(수정 필요)
       socket.emit('study start web',{id:id});//auth로 수정
       //이벤트 대기
      socket.on('receive web',function(data){
         play();
      });
     }
   
   
   
    function timesend(sec){// 시간을 배열에 저장하는 메서드  
            second.push(sec);
   }
   
   function textsend(string){//텍스트를 배열에 저장하는 메서드
           text.push(string);
          
   }
   function engtextsend(string){//텍스트를 배열에 저장하는 메서드
           engtext.push(string);
          
   }
   var count=0;
   var one;
   function aduino(soundlate){//강의 재생이될때 계속 호출되는 메서드 
    　
    　
     for(var i=0;i<second.length;i++){
         if(soundlate==second[i]){// 강의시간과 시간배열에 있는 시간이 동일하다면 
             if(soundlate!=one){
                 
            document.getElementById('outText').innerHTML=text[i]; 
            document.getElementById('outText2').innerHTML="<img src='https://urias-heoyongjun.c9users.io/tenPic/"+engtext[i]+".gif' width='200px' height='200px'>";
        
            one=soundlate;
            count++;
             pushEvent();
             stop();
             } 
             
             
         }
     }
   }
   //정지메서드 재생 메서드 만들기 
   
  function stop(){ //정지만 하는 메서드 
       $("#soundbar").trigger('pause');
  }
  function play(){ // 재생하는 메서드 
       $("#soundbar").trigger('play');
  }
 
    
    
   function myFunction(event) { //재생중일때 계속 호출됨 
   
   
   late=Math.round(event.currentTime); // 현재 재생시간을 반올림함 
     
    aduino(late);//상위 참고바람 
    
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
 

 


<style>
       .white_btn{
              background-color:white;
              color:black;
              width:210px;
              height:70px;
              
       }
       .bigger{
              color:red;
       }
       .font_black{
              color:black;
       }
       .top{
              width:420px;
       }
       .move_btn{
              width:250px;
              float:left;
       }
       
       .page_left{
              width:500px;
              height:500px;
              float:left;
              /*padding:30px;*/
       }
       .page_right{
              width:500px;
              height:500px;
              float:left;
       }
       .page_btn{
              width:1200px;
              height:50px;
              padding:20px;
              /*float:left;*/
       }
</style>

<div class="row">
       <div class="page-header">
              <h1>{{$study->id}}.{{$study->title}}</h1>
       </div>
       
       <div class="content">
              <div class="quiz_page">
                     <audio id="soundbar" controls preload="none"  ontimeupdate="myFunction(this)"> 
                     <!--ontimeupdate 재생중일시 해당 함수를 계속 호출함 -->
                     <source src="{{$study->file_src}}" type="audio/mpeg">
                     Your browser does not support the audio element.
                     </audio>

                     <div class="page_left">
                     <center><h2>조절 버튼</h2></center>
                            <button class="top white_btn btn btn-lg" id="space" tabindex='1'><h4 class="font_black">일시정지스페이스바</h4></button><br>
                            <button class="white_btn btn btn-lg" id="forward" tabindex='2'><h4 class="font_black">전진 L</h4></button>
                            <button class="white_btn btn btn-lg" id="back" tabindex='3'><h4 class="font_black">후진 J</h4></button><br>
                            <button class="white_btn btn btn-lg" id="fast" tabindex='4'><h4 class="font_black">빠르게 I</h4></button>
                            <button class="white_btn btn btn-lg" id="general" tabindex='5'><h4 class="font_black">기본속도 K</h4></button>
                            <button class="white_btn btn btn-lg" id="slow" tabindex='6'><h4 class="font_black">느리게 콤마</h4></button>
                            <button class="white_btn btn btn-lg" id="up" tabindex='7'><h4 class="bigger">크게 Q</h4></button>
                            <button class="white_btn btn btn-lg" id="down" tabindex='8'><h4 class="font_black">작게 W</h4></button>
                         
                            @if($study->id==12)
                            <a href="/study/1"></a><button name="next" class="btn btn-lg" tabindex='9'><h4 class="font_black">처음단원이동 N</h4></button></a>
                              
                            @else
                            <a href="/study/{{$study->id +1}}"></a><button name="next" class="white_btn btn btn-lg" tabindex='9'><h4 class="font_black">다음단원이동 N</h4></button></a>
                            @endif  
                     </div>
                     <div class="page_right">
                            <center><h2>출력 되는 글자 </h2></center>
                            <br>
                             
                            <div class="panel-body" style="height:400px; width:480px; border:5px solid black;" >
                                   <div class="row">
                                          <div class="col-md-6">
                                                 <p style="font-size:80px" id="outText" ></p>
                                          </div>
                                          <div class="col-md-6">
                                                 <p id="outText2" style="width: 50%;"></p>
                                          </div>
                                   </div>
                            </div>
                     </div>
                     <div class="page_btn">
                            <a href="/quiz/{{$study->id}}" style="color:black;">
                            <button class="btn btn-orange move_btn" tabindex="10">퀴즈 풀기</button></a>
                            <button class="btn btn-dark-green move_btn" tabindex="11" onclick="back()">이전메뉴로</button>
                            <a href="{{ route('study') }}"><button  class="btn btn-dark-green move_btn" tabindex="12">초기메뉴로</button></a>
                            <button class="btn btn-dark-green move_btn" tabindex="13">화면맨위로</button>
                     </div>
              </div>
       </div>
</div>

  <script>
  
//컨트롤러에서 텍스트와 시간을 받아와서 자바스크립트 배열에 메서드로 입력함 
@foreach($kanji as $record)
       
textsend('{{$record}}'); 
@endforeach 

@foreach($second as $record)
       
timesend('{{$record}}');   
@endforeach 

@foreach($engkanji as $record)
       
engtextsend('{{$record}}');   
@endforeach 
    
 

 </script>
@endsection