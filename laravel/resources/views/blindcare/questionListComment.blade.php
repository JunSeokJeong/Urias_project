@extends('layouts.video_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
    .list_sup {
        width: 80%;
    }
    
    .list_sub {
        width: 80%;
    }
    
    .list_num {
        display:inline;
        width: 10%;
    }
    
    .list_subject {
        display:inline;
        width: 40%;
    }
    
    .list_writer {
        display:inline;
        width: 20%;
    }
    
    .list_write_date {
        display:inline;
        width: 20%;
    }
</style>

<div class="question_list">
    <!-- 화면 제목 -->
    <div class="subject">
        <h3>내 질문리스트</h3>
    </div>  <!-- end div subject -->
    
    <!-- 내용 -->
    <div class="content">
        
        @foreach($question_list as $question)
        <!-- 질문 리스트 -->
        <div class="question_list">
            <!-- 질문 -->
            <div class="question">
                <?php
                echo "질문 ".$question['list_num']." - ".$question['write_date']."에 등록한 질문입니다.";
                ?>
            </div>
            
            <!-- 답변 리스트-->
            <div class="comment_list">
                @foreach($comment_list[$question['list_num'] - 1] as $comment)
                <!-- 답변 -->
                <div class="comment">
                    <?php echo "답변 ".$comment['list_num'].") "." 회원 ".$question['writer']."님의 답변입니다. ".$question['write_date']; ?>
                    <br />
                    <?php echo $comment['comment']; ?>
                </div>
                @endforeach
            </div>
        </div>  <!-- end div question_list -->
        @endforeach
    
        <div class="page">
            
        </div>  <!-- end div page -->
        
    </div>  <!-- end div content -->
    
</div>

@endsection