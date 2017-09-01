@extends('layouts.master')
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
.book_btn{
       float:right;
       width:200px;
       height:180px;
       
}

/*.btn{*/
/*       height:70px;*/
/*       width:250px;*/
/*}*/
</style>

<!--오역수정 목록 부분-->
<div class="row">
  <center>
    <div class="page-header">
      <h1>오역수정 목록</h1>
    </div>
  </center>

    <div class="container">
              <ul class="c1">
                     @foreach($result as $book)
                     <li style class="id_detailli">
                            <div class="thumb_cont" onclick="location.href = '/library/joinVolunteer/{{$book->v_num}}/{{$book->book_name}}'" >
                                   <div class="info_area">
                                          <div class="cover_wrap">
                                                  <img class="img" src="{{$book->main_img_dir}}" alt="..." >
                                          </div>
                                          <div class="detail">
                                                 <div class="jumbotron">
                                                        <div class="title">
                                                               <span>
                                                                      <h3>도서명 : {{$book->book_name}}</h3>
                                                               </span>
                                                        </div>
                                                        <div class="info">
                                                               <span>
                                                                      <h4>{{$book->v_content}}</h4>
                                                               </span>
                                                        </div>
                                                 </div>
                                          </div>
                                          <div class="modify">
                                                 <br /><br /><br />
                                                 
                                          </div>
                                          <div class="book_add" >
                                                 <span>
                                                        
                                                 </span>
                                          </div>
                                         
                                   </div>
                            </div>
                     </li>
                     <!--<input type="button" class="btn btn-primary" value="오역수정" onclick="location.href = '/library/joinVolunteer/{{$book->v_num}}/{{$book->book_name}}'"/>-->
                     
                     @endforeach
                     {!! $result->render() !!}
                     
              </ul>
       </div>
</div>
 
  <!--새로운 봉사등록하기-->
  <center>
  @if(Auth::check())
    @if(Auth::user()->type == '관리자')
    <a class="btn btn-primary" onclick="location.href = '{{ route('vInsert') }}' " role="button">봉사등록하기</a>
    @else
    관리자만 등록이 가능합니다.
    @endif
  
  @else
  로그인을 해주세요
  @endif
  </center>
  
  

</div><!--end div volunteerList-->


@endsection