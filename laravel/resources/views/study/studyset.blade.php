@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
              <audio id="soundbar" controls preload="none"  ontimeupdate="myFunction(this)"> 
             <!--ontimeupdate 재생중일시 해당 함수를 계속 호출함 -->
              
           
              <source src="{{$select->file_src}}" type="audio/mpeg">
                Your browser does not support the audio element.
                </audio>
                <br><br>
                <center>
                <h3>등록된 점자리스트</h3>
               
                <table class="bordered centered responsive-table" style="width:400px;">
                    <tr>
                        <td>sec</td>
                        <td>text</td>
                    </tr>
                    @for($i = 0; $i < count($second); $i++)
                    <tr>
                        <td>{{$second[$i]}}</td>
                        <td>{{$kanji[$i]}}</td>
                    </tr>
                    
                   @endfor
                    
                </table>
                </center>
            
                
                 <center>
                 <form method="post" action="{{route('studysend')}}">
               

                <div id="time"></div>
               <h3>등록 할 점자리스트</h3>
                <table class="bordered centered responsive-table" style="width:400px;" id="aa">
                    <tr>
                        
                        
                        <td>sec</td>
                        <td>text</td>
                        <td>action</td>
                        
                    </tr>
                   
                </table>
                <br><br><br><br>
                </center> 
                <input type="hidden" name="id" class="form-control" value="{{$select->id}}">
                
                <input type="text" class="form-control" id="input">
                {!! csrf_field() !!} 
               
                
                <a class="waves-effect waves-light btn-large" id="up">폼에입력</a>
                <a class="waves-effect waves-light btn-large" id="up2">확정</a>
                <button class="btn-large waves-effect waves-light" type="submit" name="action">전송</button>
                <a class="waves-effect waves-light btn-large" id="down">초기화</a>
                <a class="waves-effect waves-light btn-large" href="/adinput">메인으로</a>
                
                </form>
                
                <script>
                 var second;
                $(document).ready(function(){
                var a=new Array();
                var b=new Array();
                $("#up2").click(function(){
                     $('#time').append('<input type="hidden" name="second" class="form-control" value="'+a+'">');
                     $('#time').append('<input type="hidden" name="kanji" class="form-control" value="'+b+'">');
                     alert('전송준비완료');
                });
                
                $("#down").click(function(){
                    a=new Array();
                    b=new Array();
                    $('#aa').children().remove();
                    $('#aa').append(' <table class="bordered" id="aa"><tr><td>sec</td><td>text</td><td>action</td></tr></table>');
                    alert('초기화완료');
                    
                });
                
                 $("#up").click(function(){
                var kanji=$('#input').val();
                var isecond=second;
                $('#aa').append('<tr><td>'+isecond+"</td><td>"+kanji+"</td><td>action</td></tr>");
               
                 a.push(isecond);
                 b.push(kanji);
                 
                
                    });
                
                    
                    
                });
             
                
                
                    
                    function del(num){
                        document.getElementById(num).innerHTML='';
                    }
                    
                    function myFunction(event) { 
                       second=Math.round(event.currentTime);  
                    }
                    
                </script>
                
@endsection  