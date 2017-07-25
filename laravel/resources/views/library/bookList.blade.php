@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<style>

    
.img{
       width:150px;
       height:200px;
}
.btn{
       width:230px;
       color:black;
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
            <h1 alt="도서 목록">도서 목록</h1>
        </div>
    </center>
    
    
    <div class="row" >
       @foreach($result as $key)
       
        <div class="divbox col-sm-6 col-md-4">
            <div class="thumbnail">
                <img class="img" src="{{$key['book_img_dir']}}" alt="...">
                <div class="caption">
                    <center>
                    <?php $i=0; ?>
                      @if($i==0)
                      <!--<button class="btn-large button" id="focus_1" >도서명 : {{$key['book_name']}}</button>-->
                      <button class="btn white_btn" id="focus_1"><h4 class=h>도서명 : {{$key['book_name']}}</h4></button>
                     <?php  $i++; ?>
                      @else
                      <!--<button class="btn-large button">도서명 : {{$key['book_name']}}</button>-->
                      <button class="btn white_btn"><h4 class=h>도서명 : {{$key['book_name']}}</h4></button>
                      @endif
                      <br>
                      <!--<button class="btn-large button">저자: {{$key['book_writer']}}</button>-->
                      <button class="btn white_btn"><h4 class=h>저자: {{$key['book_writer']}}</h4></button>
                      <br>
                    <!--<a class="btn-large button" href="#" role="button">{{$key['book_name']}}상세정보보기</a>-->
                     <button type="button" class="btn btn-lime" ><h4>상세정보보기</h4></button>
                     <br>
                     <form action="{{route('mybListAdd')}}" method="post">
                        <input type="hidden" name="b_no" value="{{$key['b_no']}}"/>
                        <input type="hidden" name="book_name" value="{{$key['book_name']}}"/>
                        <input type="hidden" name="book_writer" value="{{$key['book_writer']}}"/>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                        <button type="submit" class="btn btn-orange"  type="submit"><h4>나의도서목록추가</h4></button>
                     </form>
                     </center>
                </div>
            </div>
        </div>
     @endforeach
    </div>
    <!-- 메인 이동 버튼 -->
    <center>
        <!--<button class="move waves-effect green darken-2 btn-large" onclick="upfocus()">메뉴 처음으로</button><br><br>-->
        <button type="button" class="btn btn-dark-green btn-lg"  type="submit" onclick="upfocus()"><h4>메뉴 처음으로</h4></button>
        <button type="button" class="btn btn-dark-green btn-lg"  onclick="location.href='{{ route('index') }}'"><h4>메인으로</h4></button>
    </center>
  
  <script>
    //탭키 첫번째 부분으로 이동 
    function upfocus(){
        document.getElementById('focus_1').focus();
    }
  </script>
@endsection
