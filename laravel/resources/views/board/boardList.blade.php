@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<style type="text/css">
    .table{
        width:750px;
    }
    .thcolor{
           background-color:#0072B2;
           color:white;
    }
    .tdcolor{
           color:black;
    }
</style>

<div class="page-header">
   <h1 alt="온라인 도서관">도서관 소식</h1>
</div>
<center>
      <table class="table">
        <thead>
          <tr>
              <th class="thcolor">글 번호</th>
              <th class="thcolor">제목</th>
              <th class="thcolor">날짜</th>
          </tr>
        </thead>
        <tbody>
          <tr>
              @foreach ($boardPage as $value)
            <!--번호-->
            <td><a href="{{route('boardRead',$value->id)}}" style="color:black;">{{$value->id}}</a></td>
            <!--제목-->
            <td><a href="{{route('boardRead',$value->id)}}" style="color:black;">{{$value->title}}</a></td>
            <!--날짜-->
            <td><a href="{{route('boardRead',$value->id)}}" style="color:black;">{{$value->created_at}} </a></td>
            <!--조회수-->
            <!--<td></td>-->
          </tr>
           @endforeach
        </tbody>
      </table>
    
     {!! $boardPage->render() !!}
    <br>

    <br>
    <!--관리자일 경우 -->
    @if(Auth::check())
    @if(Auth::user()->type == '관리자')
    <a class="waves-effect waves-light btn-large" href="{{route('boardWrite')}}">글쓰기</a>
    <br>
    @else
    
    @endif
  
  @else
  로그인을 해주세요
  @endif
    <button class="btn btn-dark-green" alt="메인으로" onclick="location.href='http://urias-heoyongjun.c9users.io'">메인으로</button>
</center>
    

@endsection