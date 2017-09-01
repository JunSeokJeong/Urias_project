@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<style>
    .question_view {
        width: 80%;
    }
    
    /*.image_file {*/
    /*    width: 50%;*/
    /*}*/
</style>



<div class="question_view">
    <!-- 화면 제목 -->
    <div class="subject">
        <h3>생활봉사 질문내용</h3>
    </div>  <!-- end div subject -->
    
    <!-- 내용 -->
    <table class="table">
        <tr>
            <th>
                질문자
            </th>
            <th>
                작성일자
            </th>
        </tr>
        <tr>
            <td>{{$question_view['writer']}}</td>
            <td>
                {{$question_view['write_date']}}
            </td>
        </tr>
    </table>
    
    <!-- 시각장애인의 질문 녹음파일 및 이미지 or 동영상 -->
    <div class="question_content">
        <div class="audio_file">
            <audio controls="controls" preload="preload">
                <source src="/blindcare/question/question_file/{{$question_view['question_file']}}" type="audio/mpeg">
            </audio>
        </div>
        
        <!--@if(substr($question_view['capture_file'], -4, 4) == '.jpg')-->
        <div class="image_file">
            <img width="40%" src="/blindcare/question/capture_file/{{$question_view['capture_file']}}" />
        </div>
        <!--@elseif(substr($question_view['capture_file'], -4, 4) == '.mp4')-->
        <!--<div class="video_file">-->
        <!--    <video width="80%" text-align="center" controls="controls">-->
        <!--        <source src="/blindcare/question/capture_file/{{$question_view['capture_file']}}" type="video/mp4">-->
        <!--    </video>-->
        <!--</div>-->
        <!--@endif-->
        
    </div>  <!-- end div question_content -->
    
    <!-- 봉사자의 답변(댓글) -->
    <div class="question_comment">
        <div class="comment_list">
            <center><h2>댓글창 </h2></center>
            <table class="table table-bordered">
                <tr>
                    <th>번호</th>
                    <th>내용</th>
                    <th>작성자</th>
                    <th>시간</th>
                </tr>
            @foreach($question_comment as $comment)
                <tr>
                    <td>
                    {{$comment['list_num']}}
                    </td>
                    <td>
                        {{$comment['comment']}}
                    </td>
                    <td>
                        {{$comment['writer']}}
                    </td>
                    <td>
                        {{$comment['write_date']}}
                    </td>
                </tr>
        
            @endforeach
            </table>
            
        </div>
        
        <!-- 댓글 작성란 -->
        <div class="comment_write">
            <form action="{{ route('qCRegist') }}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="question_num" value="{{$question_view['num']}}">
                
                <textarea name="comment" cols="30" rows="10"></textarea>
                
                <input type="submit" value="등록"/>
            </form>
            
        </div>
        
        
    </div>  <!-- end div question_comment -->
</div>

@endsection