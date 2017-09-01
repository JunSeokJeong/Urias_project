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
       width:250px;
}
.btn-white {
       background-color: white;
}
.btn-yelgreen {
       background-color: #0BC904;
}

.go_btn{
       background-color:white;
       color:black;
       width:200px;
       /*float:left;*/
}
</style>
<div class="row">
       <center>
              <div class="page-header">
                     <h1 alt="도서 목록">도서 목록</h1>
              </div>
       </center>
       <div class="container">
              <ul class="c1">
                     @foreach($book as $key)
                     <li style class="id_detailli">
                            <div class="thumb_cont" >
                                   <div class="info_area">
                                          <div class="img_area">
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
                                                        <button class="btn btn-white"><h4 style="color:black;">{{$key['book_name']}}상세정보보기</h4></button>
                                                        <form action="{{route('mybListAdd')}}" method="post">
                                                               <input type="hidden" name="b_no" value="{{$key->b_no}}"/>
                                                               <input type="hidden" name="book_name" value="{{$key->book_name}}"/>
                                                               <input type="hidden" name="book_writer" value="{{$key->book_writer}}"/>
                                                               <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                               <?php
                                                               $rental = false;
                                                               
                                                               foreach($r_book as $key_r) {
                                                                      if($key_r->book_number == $key->b_no) {
                                                                             $rental = true;
                                                                      }
                                                               }
                                                               ?>
                                                               
                                                               @if($rental)
                                                               <button class="btn btn-yelgreen">
                                                                      <h4>추가된 도서</h4>
                                                               </button>
                                                               @else
                                                               <button type="submit" class="btn btn-orange">
                                                                      <h4>나의도서목록추가</h4>
                                                               </button>
                                                               @endif
                                                        </form>
                                                 </span>
                                          </div>
                                         
                                   </div>
                            </div>
                     </li>
                     @endforeach
                     
                     
              </ul>
       </div>
      
       <!-- 메인 이동 버튼 -->
       <center>
              <!--<button class="move waves-effect green darken-2 btn-large" onclick="upfocus()">메뉴 처음으로</button><br><br>-->
              <button type="button" class="go_btn btn btn-lg"  type="submit" onclick="upfocus()"><h4 style="color:black;">메뉴 처음으로</h4></button>
              <button type="button" class="go_btn btn btn-lg"  onclick="location.href='{{ route('index') }}'"><h4 style="color:black;">메인으로</h4></button>
       </center>
</div>
       
  
  <script>
    //탭키 첫번째 부분으로 이동 
    function upfocus(){
        document.getElementById('dLabel').focus();
      
    }
  </script>
@endsection
