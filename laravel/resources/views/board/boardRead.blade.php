@extends('layouts.master')
@section('title', 'Page Title')
@section('content')


<center>
    
        <div class="jumbotron">
            <!-- title -->
            <div class="content" alt="제목">
                <h1>{{$board->title}}</h1>    
            </div>
            <hr>
            <!-- content -->
            <div class="content" alt="내용">
                <h3>{{$board->content}}</h3>
            </div>
        </div>
        
    
           
         
        @if(Auth::check())
        @if(Auth::user()->type == '관리자')
        <form action="{{route('boardDelete',$board->id)}}" method="post" >
            <input type="hidden" name="_method" value="delete"><!-- delete 할때 필요 -->
            {{csrf_field()}}
            <a class="btn btn-success active" href="{{$board->id}}/boardEdit" role="button">글 수정</a>
            <button class="btn btn-danger" type="submit">삭제</button>
            <a class="btn btn-primary" href="{{route('boardList')}}" role="button">글 목록</a>
        </form>
        @else
        <a class="btn btn-primary" href="{{route('boardList')}}" role="button">글 목록</a>
        @endif
    
      @else
      로그인을 해주세요
      @endif
      
      
      
    </center>
@endsection