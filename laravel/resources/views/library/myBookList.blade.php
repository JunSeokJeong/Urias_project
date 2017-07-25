@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
.img{
    width: 150px;
    height: 200px;
}
.btn{
    width:250px;
}

.h{
    color:black;
}
.white_btn{
       background-color:white;
}

    </style>
    
    <center>
        <div class="page-header">
            <h2 alt="나의 도서 목록">나의 도서 목록</h2>
        </div>
    </center>
    
    @foreach($result as $key)
    <div class="row" id="div">
        <div class="divbox col-sm-6 col-md-4">
            <div class="thumbnail">
                <img class="img" src="{{$key->book_img_dir}}" alt="...">
                <div class="caption">
                    <?php $i=0; ?>
                    @if($i==0)
                    <button class="white_btn btn btn-lg " id="focus_1"><h4 class='h'>도서명 : {{$key->book_name}}</h4></button><br><br>
                    <?php  $i++; ?>
                    @else
                    <button class="white_btn btn btn-lg " id="firb"><h4 class='h'>도서명 : {{$key->book_name}}</h4></button><br><br>
                    @endif
                    <button class="white_btn btn btn-lg " ><h4 class='h'>저자 : {{$key->book_writer}}</h4></button>
                    <br><br>
                    <button type="button" class="btn btn-lime" ><h4>상세정보보기</h4></button>
                    <br>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <button type="button" class="btn btn-dark-green" onclick="upfocus()"><h4>메뉴 처음으로</h4></button>
            <button type="button" class="btn btn-dark-green" onclick="location.href='{{ route('index') }}'"><h4>메인으로</h4></button>
        </div>
    </div>
    
    <script type="text/javascript" src="../js/socket.io.js"></script>
    <script>
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
