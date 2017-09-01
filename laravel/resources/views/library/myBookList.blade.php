@extends('layouts.fall_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<style>
.c1 {
  /*padding: px;*/
  width: 100%;
}

@media (min-width: 500px) {
  .c1 {
    /*padding: 20px;*/
    font-size: 1.5em;
  }
}

@media (min-width: 800px) {
  .c1 {
    /*padding: 40px;*/
    font-size: 2em;
  }
}

.id_detailli .thumb_cont .info_area{
       width:1000px;
       height:220px;
       padding:30px;
}
.img{
       width:150px;
       height:190px;
       float:left;
}
.detail{
       width:600px;
       height:210px;
       float: left;
}
.book_add{
       float:right;
       width:150px;
       height:180px;
       
}

.btn{
       height:70px;
       width:200px;
}
.info{
    margin-right:10px;
}

.go_btn{
       background-color:white;
       color:black;
       width:200px;
}
/*h4{*/
/*       color:black;*/
/*}*/
</style>
<div class="row">
       <center>
              <div class="page-header">
                     <h1 alt="도서 목록">나의 도서 목록</h1>
              </div>
       </center>
       <div class="container">
              <ul class="c1">
                     @foreach($result as $key)
                     <li style class="id_detailli">
                            <div class="thumb_cont" >
                                   <div class="info_area">
                                          <div class="cover_wrap">
                                                  <img class="img" src="{{$key->book_img_dir}}" alt="..." >
                                          </div>
                                          <div class="detail">
                                                 <div class="title">
                                                        <span>
                                                               <h3>도서명 : {{$key->book_name}}</h3>
                                                        </span>
                                                 </div>
                                                 <div class="info">
                                                        <span>
                                                               <h4>인간관계를 구축하는 데 빼놓을 수 없는매우 중요한 역할을 하는, 말투. 모든 게 완벽한 사람이지만 사소한 말투 한 마디 때문에 힘들게 다져온 능력을 모두 물거품으로 만들어버리기도 한다. 이처럼 잘못된</h4>
                                                        </span>
                                                 </div>
                                                 
                                          </div>
                                           <div class="book_add" >
                                                 <span>
                                                        <button class="btn btn-dark-green"><h4>상세정보보기</h4></button>
                                                 </span>
                                          </div>
                                         
                                   </div>
                            </div>
                     </li>
                     @endforeach
              </ul>
       </div>
    
    <!--@foreach($result as $key)-->
    <!--<div class="row" id="div">-->
    <!--    <div class="divbox col-sm-6 col-md-4">-->
    <!--        <div class="thumbnail">-->
    <!--            <img class="img" src="{{$key->book_img_dir}}" alt="...">-->
    <!--            <div class="caption">-->
    <!--                <?php $i=0; ?>-->
    <!--                @if($i==0)-->
    <!--                <button class="white_btn btn btn-lg " id="focus_1"><h4 class='h'>도서명 : {{$key->book_name}}</h4></button><br><br>-->
    <!--                <?php  $i++; ?>-->
    <!--                @else-->
    <!--                <button class="white_btn btn btn-lg " id="firb"><h4 class='h'>도서명 : {{$key->book_name}}</h4></button><br><br>-->
    <!--                @endif-->
    <!--                <button class="white_btn btn btn-lg " ><h4 class='h'>저자 : {{$key->book_writer}}</h4></button>-->
    <!--                <br><br>-->
    <!--                <button type="button" class="btn btn-lime" ><h4>상세정보보기</h4></button>-->
    <!--                <br>-->
    <!--            </div>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--@endforeach-->
    <!--</div>-->
    
    
<center>
    <button type="button" class="go_btn btn btn-lg" onclick="upfocus()"><h4 style="color:black;">메뉴 처음으로</h4></button>
    <button type="button" class="go_btn btn btn-lg" onclick="location.href='{{ route('index') }}'"><h4 style="color:black;">메인으로</h4></button>
    
</center>
        
    
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
