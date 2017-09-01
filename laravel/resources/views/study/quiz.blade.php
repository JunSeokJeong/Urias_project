@extends('layouts.fall_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
  
<script type="text/javascript" src="../js/socket.io.js"></script>
<script type="text/javascript">

   var examples;    
   var late;// 재생시간
   var text=new Array();//텍스트를 저장할 배열
   var second=new Array();//시간을 저장하는 배열 
   var answer=new Array();
   var quizsounds=new Array();
   var selectanswers=new Array();
   var quizplaycount=0;
   var dbAnswer=new Array();
   var dbChoice=new Array();
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
   
   function dbUrl(str,str2){
          dbAnswer.push(str);
          dbChoice.push(str2);
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
                        dbUrl(answer[i],selectanswers[i]);
               }
               if(answer[i]!=selectanswers[i]){
                         tbody.innerHTML+=" <button class='quiz btn btn-blue-grey'>"+(i+1) + "번 선택은 " +selectanswers[i]+ "번 답은 "+answer[i]+" 번 오답입니다 </button> <br><br>";
                         dbUrl(answer[i],selectanswers[i]);
               }
        }
         tbody.innerHTML+=" <button class='quiz btn btn-brown'>총 "+answer.length+"개중에 "+result()+"개 맞추셨습니다 </button> <br><br>";
          tbody.innerHTML+="<a href='/resultprocess/"+dbAnswer[0]+dbAnswer[1]+dbChoice[0]+dbChoice[1]+"'> <button class='btn btn-indigo' > 결과 저장 </button></a> <br><br>";
       //   <button class='btn btn-indigo' onclick=window.location.reload(true)> 다시 풀기 </button></a> <br><br>"
       
        }
        }, 6000); 


    }
    
   function inactive(){
       btn=document.getElementById('firb');
       
       btn.disabled = 'disabled';
       btn.setAttribute('class','btn');
       btn=document.getElementById('secb');
       btn.disabled = 'disabled';
       btn.setAttribute('class','btn');
       btn=document.getElementById('tirb');
       btn.disabled = 'disabled';
       btn.setAttribute('class','btn');
       btn=document.getElementById('fitb');
       btn.disabled = 'disabled';   
       btn.setAttribute('class','btn');
   }
   function active(){
       btn=document.getElementById('firb');
       btn.disabled = false;
       btn.setAttribute('class','btn success-color-dark');
       btn=document.getElementById('secb');
       btn.setAttribute('class','btn success-color-dark');
       btn.disabled = false;
       btn.setAttribute('class','btn success-color-dark');
       btn=document.getElementById('tirb');
       btn.disabled = false;
       btn.setAttribute('class','btn success-color-dark');
       btn=document.getElementById('fitb');
       btn.disabled = false;
       btn.setAttribute('class','btn success-color-dark');
      
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
              
              　
    
        }
        else{
             
        }
       
        }, 2000); 
        
        setTimeout(function() {
               play(); 
       }, 2000); 
      
       
      
}    


function firstbutton(){
    var target=document.getElementById('firb');
    target.focus();
    firstsound();
    answercheck(1);
    inactive();
    selectanswer(1);
    
}

function secondbutton(){
    var target=document.getElementById('secb');
    target.focus();
    secondsound();
    selectanswer(2);
    inactive();
　　answercheck(2);
}

function thirdbutton(){
    var target=document.getElementById('tirb');
    target.focus();
    thirdsound();
    selectanswer(3);
    inactive();
   answercheck(3);
}

function fitbutton(){
    var target=document.getElementById('fitb');
    target.focus();
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
<style type="text/css">
.btn{
       width:300px;
       height:70px;
       font-size:20px;
             
}
.move_btn{
       width:300px;
}
/*.contents{*/
/*       width:1200px;*/
/*       height:700px;*/
/*       padding:30px;*/
/*}*/
/*.audio_area{*/
/*       width:1000px;*/
/*       height:50px;*/
/*}*/
.quiz_btn{
       /*width:1000px;*/
       /*height:450px;*/
       padding:80px;
}
/*.btn_are{*/
/*       width:1100px;*/
/*       height:200px;*/
/*       padding:30px;*/
/*}*/
/*.quiz{*/
/*       width:650px;*/
/*}*/
</style>

<div class="row">
        <center>
       <div class="page-header">
              <h1 style="font-size:50;">{{$study->id}}.{{$study->title}}</h1>
       </div>
       
       <div class="contents">
              <div class="quiz_area">
                    
                     <div class="audio_area">
                            <audio id="soundbar" controls preload="none" ontimeupdate="myFunction(this)" > 
                                   <!--ontimeupdate 재생중일시 해당 함수를 계속 호출함 -->
                                   <source src="{{$quiz->filesrc}}" type="audio/mpeg">
                                   Your browser does not support the audio element.
                            </audio>       
                     </div>
                     
                     <div class="quiz_btn" id='frame'>
                           <button type="button" id='starb' class="btn btn-indigo" onclick="firstplay()">시작</button><br>
                           <button type="button" id='firb' disabled="disabled" class="btn" onclick="firstbutton()">1번</button><br>
                           <button type="button" id='secb' disabled="disabled" class="btn" onclick="secondbutton()">2번</button><br>
                           <button type="button" id='tirb' disabled="disabled" class="btn " onclick="thirdbutton()">3번</button> <br>
                           <button type="button" id='fitb' disabled="disabled" class="btn" onclick="fitbutton()">4번</button><br>
                           <button type="button" class="btn btn-indigo" onclick='focusfirst()' >다시듣기</button><br>
                     </div>
                     
              </div>
       </div>
       <div class="btn_are">
             
              <button class="btn btn-orange move_btn" onclick="location.href='/study/{{$quiz->id}}'">교육 듣기</button>
              <button type="button" class="btn btn-dark-green move_btn" onclick="active()">이전메뉴로</button>
              <a href="{{route('study') }}"> <button type="button" class="btn btn-dark-green move_btn">초기메뉴로</button></a>
       </div>
       </center>
       
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