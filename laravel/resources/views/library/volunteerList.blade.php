@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">
   
   .divbox {
      display: inline-block;
      padding: 25px;
  }
  
  .img{
    width: 242px;
    height: 200px;
  }
    
</style>

<!--오역수정 목록 부분-->
<div><!--start div volunteerList-->

  <div class="page-header">
   <h2>오역수정 봉사 목록</h2>
  </div>
  
  <!--봉사목록 출력-->
  @foreach($result as $book)

  <div class="row" >
    <div class="divbox col-sm-6 col-md-4" onclick="location.href = '/library/volunteerInfo/{{$book->v_num}}/{{$book->book_name}}'">
      <div class="thumbnail" >
        <img class="img" src="{{$book->main_img_dir}}" alt="...">
        <div class="caption">
          <h3>{{$book->book_name}}</h3>
          <!--<h3>{{$book->c_page}}/{{$book->page}}</h3>-->
          <!--<h3>{{($book->c_page/$book->page)*100}}</h3>-->
          <!--진행바 -->
          <div class="progress">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{($book->c_page/$book->page)*100}}" aria-valuemin="0" aria-valuemax="100" style="width:{{($book->c_page/$book->page)*100}}%">
                <!--<span class="sr-only">40% Complete (success)</span>-->
                {{($book->c_page/$book->page)*100}}%
            </div>
          </div>
          <!-- end progress -->   
        </div>
      </div>
    </div>
    <input type="button" name="" value="{{$book->book_name}}" onclick="location.href = '/library/joinVolunteer/{{$book->v_num}}/{{$book->book_name}}'"/>
     @endforeach
     {!! $result->render() !!}
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