@extends('layouts2.master2')
@section('title', '메인')
@section('content')
  
  <!--image-->
  <div class="image">
      <img src="/dd.PNG" alt="" width="820px" height="500px">
  </div><!--image-->
  <button id="button">dd</button>
  <script src="https://code.jquery.com/jquery-1.11.3.min.js"> </script>
  <script src="js/socket.io.js"></script>
  <script type="text/javascript">
    var button = document.getElementById("button");
    button.addEventListener("click",function(){
      var socket = io.connect('https://urias-heoyongjun.c9users.io:8082',{path : "/socket"});
       //이벤트 발생
       socket.emit('req',{hello:'node'});
       //이벤트 대기
       socket.on('res',function(data){
         var data = JSON.stringify(data);
         console.log(data);
       });
    },false);
  </script>
@endsection