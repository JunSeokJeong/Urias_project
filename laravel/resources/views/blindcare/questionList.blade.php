@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<div class="question_list">
    <!-- 화면 제목 -->
    <div class="subject">
        <h3>생활봉사 질문리스트</h3>
    </div>  <!-- end div subject -->
    
    <!-- 내용 -->
    <div class="content">
        <table class="table">
            <tr>
                <th>No</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성일</th>
            </tr>
            
        
            <!-- 내용 -->
            <div class="list_sub">
            
            @foreach($question_list as $list)
            <tr>
                <td>{{$list['list_num']}}</td>
                <td> <a href="/blindcare/questionView/{{$list['num']}}">회원 {{$list['writer']}}님이 올리신 질문입니다.</a></td>
                <td>{{$list['writer']}}</td>
                <td>{{(substr($list['write_date'], 0, 10) == date('Y-m-d')) ? substr($list['write_date'], 11, 5) : substr($list['write_date'], 0, 10)}}</td>
              
            </tr>
            @endforeach
             </table>
        </div>  <!-- end div list_sub -->
        
        
       
        <div class="page">
            
        </div>  <!-- end div page -->
        
    </div>  <!-- end div content -->
    
</div>

@endsection