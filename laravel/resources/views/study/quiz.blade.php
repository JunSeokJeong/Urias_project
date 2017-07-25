@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
  
<script type="text/javascript" src="../js/socket.io.js"></script>

<style type="text/css">
       .btn{
              width:300px;
             
       }
       .move_btn{
              width:170px;
       }
       .quiz{
              width:650px;
       }
       
</style>

<script type="text/javascript">

   var examples;    
   var late;// 재생시간
   var text=new Array();//텍스트를 저장할 배열
   var second=new Array();//시간을 저장하는 배열 
   var answer=new Array();
   var quizsounds=new Array();
   var selectanswers=new Array();
   var quizplaycount=0;
  
   var quizNumber = {{$quiz->id}};
   var id = '{{Auth::user()->email}}';
   pushAramEvent(quizNumber)
   //사용자가 들어왔을때 push 알림
   function pushAramEvent(quizNum){
       
       var socket = io.connect('http://urias-heoyongjun.c9users.io:8082');
       //이벤트 발생
       
      socket.emit('quiz start event',{hello:quizNum});
       //이벤트 대기
      socket.on('quizReq',function(data){
      });
   }
   function pushEvent(){
       //socket.io 서버 연결
       var socket = io.connect('http://urias-heoyongjun.c9users.io:8081');
       //이벤트 발생
       
       socket.emit('quizSend',{id:id});
       //이벤트 대기
      socket.on('quizWeb',function(data){
          console.log(data);
         active();
      });
     }
   function back(){
          
   }
   
    function timesend(sec){// 시간을 배열에 저장하는 메서드 
            second.push(sec);
   }
   
   
   function getArray(number)
   {
       var number=number-1;
       alert(answer[number]);
   }
   
   function getExample(string){ //선택지의 히라가나를 배열에입력
       examples=string.split(',');
   }
   
   function getanswers(string){ //정답을 순서대로 배열에 입력
          answer=string.split(',');
   }
   function textsend(string){//텍스트를 배열에 저장하는 메서드
           text.push(string);
          
   }
    
 
    
    function answerInput(string){
        answer.push(string);
    }
    
 
   
   
    
    function selectanswer(number){
        var tbody=document.getElementById('frame');
        
      
        selectanswers.push(number);
        
        setTimeout(function() {
        if(selectanswers.length == answer.length ){
            while (tbody.hasChildNodes()) {
            tbody.removeChild(tbody.lastChild);
        }
       
         
          var percent=result()/result()*100;
          
      
        tbody.innerHTML+=" <button  class='btn btn-indigo'>시험 결과 </button> <br><br>";
        for(var i=0;i<answer.length;i++){
               if(answer[i]==selectanswers[i]){
                        tbody.innerHTML+=" <button class='quiz btn btn-blue-grey'>"+(i+1) + "번 선택은  "+selectanswers[i]+"번 답은 "+answer[i]+"번  정답입니다 </button> <br><br>";
               }
               if(answer[i]!=selectanswers[i]){
                         tbody.innerHTML+=" <button class='quiz btn btn-blue-grey'>"+(i+1) + "번 선택은 " +selectanswers[i]+ "번 답은 "+answer[i]+" 번 오답입니다 </button> <br><br>";
               }
        }
         tbody.innerHTML+=" <button class='quiz btn btn-brown'>총 "+answer.length+"개중에 "+result()+"개 맞추셨습니다 </button> <br><br>";
         tbody.innerHTML+=" <button class='btn btn-indigo' onclick=window.location.reload(true)> 다시 풀기 </button></a> <br><br>";

        }
        }, 6000); 


    }
    
   function inactive(){
       btn=document.getElementById('firb');
       btn.disabled = 'disabled';
       btn=document.getElementById('secb');
       btn.disabled = 'disabled';
       btn=document.getElementById('tirb');
       btn.disabled = 'disabled';
       btn=document.getElementById('fitb');
       btn.disabled = 'disabled';   
   }
   function active(){
       btn=document.getElementById('firb');
       btn.disabled = false;
       btn=document.getElementById('secb');
       btn.disabled = false;
       btn=document.getElementById('tirb');
       btn.disabled = false;
       btn=document.getElementById('fitb');
       btn.disabled = false;
      
   }
   
   
   function result(){
       var result=0;
       for(var i=0; i<answer.length;i++){
           if(answer[i]==selectanswers[i]){
               result++;
           }
       }
       return result;
   }
   
   function focusfirst(){
         document.getElementById('firb').focus();
   }
   


var fir= new Audio(' https://urias-heoyongjun.c9users.io/mp3/1b.mp3');
var sec= new Audio(' https://urias-heoyongjun.c9users.io/mp3/2b.mp3');
var tir= new Audio(' https://urias-heoyongjun.c9users.io/mp3/3b.mp3');
var fit= new Audio(' https://urias-heoyongjun.c9users.io/mp3/4b.mp3');

function firstsound() { 
    fir.currentTime = 0;
    fir.play();
    
    }
function secondsound() { 
    sec.currentTime = 0;
    sec.play();
   
    }
function thirdsound() { 
    tir.currentTime = 0;
    tir.play();
   
    }
function fitsound() { 
    fit.currentTime = 0;
    fit.play();
   
    
    }
    
function audioplay(src){
    var a= new Audio(src);
    a.currentTime=0;
    a.play();
}


var checkcount=0;
var okanswer= new Audio(' https://urias-heoyongjun.c9users.io/mp3/answer.MP3');
var noanswer= new Audio(' https://urias-heoyongjun.c9users.io/mp3/noanswer.MP3');
function answercheck(number){
       
       setTimeout(function() {
              
        if(answer[checkcount]==number){
                okanswer.currentTime = 0;
              　okanswer.play();
    
        }
        else{
              noanswer.currentTime = 0;
              noanswer.play();
        }
       
        }, 2000); 
        
        setTimeout(function() {
               play(); 
       }, 2000); 
      
       
      
}    


function firstbutton(){

    firstsound();
    answercheck(1);
    inactive();
    selectanswer(1);
    
}

function secondbutton(){

    secondsound();
    selectanswer(2);
    inactive();
　　answercheck(2);
}

function thirdbutton(){
  
    thirdsound();
    selectanswer(3);
    inactive();
   answercheck(3);
}

function fitbutton(){
   
    fitsound();
    selectanswer(4);
    inactive();
   answercheck(4);
}


 function myFunction(event) { //재생중일때 계속 호출됨 
   
   
   late=Math.round(event.currentTime); // 현재 재생시간을 반올림함 
     
    aduino(late);
    
}
  function stop(){ //정지만 하는 메서드 
       $("#soundbar").trigger('pause');
  }
  function play(){ // 재생하는 메서드 
       $("#soundbar").trigger('play');
  }
  function firstplay(){
         play();
         target=document.getElementById('starb');
          target.parentNode.removeChild(target);
        
  }

var count=0;
   var one;
 function aduino(soundlate){//강의 재생이될때 계속 호출되는 메서드 
    　
    　
     for(var i=0;i<second.length;i++){
         if(soundlate==second[i]){// 강의시간과 시간배열에 있는 시간이 동일하다면 
             if(soundlate!=one){
                 
                    
            one=soundlate;
            count++;
             pushEvent();
             stop();
             } 
             
             
         }
     }
   }
  </script>
   




<div class="row"> 
       <div class="col-md-3">  
       <br> 
       </div>

         
       <div class="col-md-6">
              <center> <h2>{{$quiz->id}}.{{$quiz->title}} 퀴즈 </h2></center>
              <br><br>
              
              <audio id="soundbar" controls preload="none" ontimeupdate="myFunction(this)" > 
              <!--ontimeupdate 재생중일시 해당 함수를 계속 호출함 -->
                
              <source src="{{$quiz->filesrc}}" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
                <br><br>
              
              <div class="col-md-3"></div>
                    
       </div> 
</div>
        
        
<div class="row"> 
        
       <div class="col-md-2"><br></div>
          
      
       <div class="col-md-8" id='frame'>
             <button type="button" id='starb' class="btn btn-indigo" onclick="firstplay()">시작</button><br>
             <button type="button" id='firb' disabled="disabled" class="btn btn-blue-grey" onclick="firstbutton()">1번</button><br>
             <button type="button" id='secb' disabled="disabled" class="btn btn-blue-grey" onclick="secondbutton()">2번</button><br>
             <button type="button" id='tirb' disabled="disabled" class="btn btn-blue-grey " onclick="thirdbutton()">3번</button> <br>
             <button type="button" id='fitb' disabled="disabled" class="btn btn-blue-grey" onclick="fitbutton()">4번</button><br>
             <button type="button" class="btn btn-indigo" onclick='focusfirst()' >다시듣기</button><br>
       </div>
      
                
          
       <div class="col-md-2"></div> 
</div>
       
<div class="row"> 
       <div class="col-md-3"></div>
          
       <div class="col-md-6">
       <br>
              <button class="btn btn-orange move_btn" onclick="location.href='/study/{{$quiz->id}}'">교육 듣기</button><br>
              <button type="button" class="btn btn-dark-green move_btn" onclick="active()">이전메뉴로</button>
              <a href="{{route('study') }}"> <button type="button" class="btn btn-dark-green move_btn">초기메뉴로</button></a>
             
       </div>
         
       <div class="col-md-3"></div>
                  
</div> 
          

<script>
//컨트롤러에서 텍스트와 시간을 받아와서 자바스크립트 배열에 메서드로 입력함 

       getExample('{{$examples[0]->examples}}');
       getanswers('{{$examples[0]->answers}}');
       
       @foreach($kanji as $record)
              
       textsend('{{$record}}'); 
       @endforeach 
       
       @foreach($second as $record)
              
       timesend('{{$record}}');   
       @endforeach 
       
       
       document.getElementById('firb').innerHTML+=' '+examples[0];
       document.getElementById('secb').innerHTML+=' '+examples[1];
       document.getElementById('tirb').innerHTML+=' '+examples[2];
       document.getElementById('fitb').innerHTML+=' '+examples[3];

</script>
        
@endsection