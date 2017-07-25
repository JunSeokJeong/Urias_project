@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
.green{
    background-color:green;
    color:white;
    width:250px;
}
#form5{
    width:700px;
    
}

</style>
    
    <center>
        <div class="page-header">
            <h2 alt="도서 목록">도서신청</h2>
        </div>
    <div class="row">
            <form method="POST" action="{{ route('bookRequestMessage') }}">
              <input type="hidden" name="_token" value="{{csrf_token()}}">
                <!--도서명 입력란-->
                <div class="md-form">
                    <input placeholder="도서명을 입력해주세요" type="text" id="form5" class="form-control" name="bookName" value="">
                    <label for="form5"></label>
                </div>
                <!--저자 입력란 -->
                <div class="md-form">
                    <input placeholder="저자를 입력해주세요" type="text" id="form5" class="form-control" name="bookWriter" value="">
                    <label for="form5"></label>
                </div>
                  
                <!--신청 버튼 -->
                <button type="submit" class="btn btn-orange" id="btn">신청</button>
                <button class="btn btn-dark-green" onclick="location.href='{{ route('index') }}'">메인으로</button>
           </form>
    </div>
 </center>  
    
    <script type="text/javascript" src="../js/socket.io.js"></script>
    <script>
        var btn = document.getElementById("btn");
        btn.addEventListener('click',function(){
              alert("등록이 완료 되었습니다");
        },false);
        //탭키 첫번째 부분으로 이동 
        function upfocus(){
            document.getElementById('focus_1').focus();
        }
    
    
        window.onload = function(){
            var socket = io.connect('http://urias-heoyongjun.c9users.io:8082');
            socket.emit('pushEvent',{a:'app을실행하세요'});
        }
        
 
    </script>
@endsection