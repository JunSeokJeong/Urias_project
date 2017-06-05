@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<style type="text/css">
   
   .divbox{
        display: inline-block;
        padding: 25px;
    }
    
    .img{
      width: 150px;
      height: 200px;
    }
    
</style>

<!--오역수정 목록 부분-->
<div><!--start div volunteerList-->

  <h2>오역수정 봉사 목록</h2>
  
  <!--봉사목록 출력-->
  @foreach($result as $book)

    <div class=divbox onclick="location.href = '/library/volunteerInfo/{{$book->v_num}}/{{$book->book_name}}'">
      
      <table class="table" border='1px'>
        
        <caption><h3>{{$book->book_name}}</h3></caption>
        
        <tr>
          <td><img class=img src='{{$book->main_img_dir}}'></td>
        </tr>
        <tr>
          <td>{{$book->book_name}}</td>
        </tr>
        <tr>
          <td>{{$book->s_page}}/{{$book->page}}</td>
        </tr>
        
      </table>
      
    </div>
  @endforeach
  <!--새로운 봉사등록하기-->
  <center>
  @if(Auth::check())
    @if(Auth::user()->type == '관리자')
    <a class="btn btn-default" onclick="location.href = '{{ route('vInsert') }}' " role="button">봉사등록하기</a>
    @else
    관리자만 등록이 가능합니다.
    @endif
  
  @else
  로그인을 해주세요
  @endif
  </center>
  
  

</div><!--end div volunteerList-->


@endsection