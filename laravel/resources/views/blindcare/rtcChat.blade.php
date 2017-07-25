@extends('layouts2.master2')
@section('title', 'Page Title')
@section('content')

<link rel="stylesheet" href="../css/main.css" />

<script>
    if(document.location.protocol == 'http:') {
        document.location.href = document.location.href.replace('http:', 'https:');
    }
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://urias-heoyongjun.c9users.io:8082/socket.io/socket.io.js"></script>
<script src="../js/lib/adapter.js"></script>
<script src="../js/rtcChat.js"></script>

<h1>실시간 영상</h1>

<div id="videos">
    <!-- 내 화면 -->
    <video id="localVideo" autoplay muted></video>
  
    <!-- 상대 화면 -->
    <video id="remoteVideo" autoplay></video>
</div>



<div>
    <button id="callButton" onclick="call();">Call</button>
    <button id="hangupButton" onclick="hangup();">Hang Up</button>
</div>


<!-- 영상통화 매칭 실패 시 선택 여부 -->
<div class="modal fade" id="reject_call_rechoose" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4>상대방이 통화를 <strong class="j-ic_initiator">거절</strong> 하셨습니다.</h4>
            </div>

            <div class="modal-footer">
                <div class="row">
                    <button type="button" class="btn btn-primary btn-block j-actions">1. 다른사람과 통화</button>
                    <button type="button" class="btn btn-default btn-block j_question_regist_page_move">2. 질문 등록</button>
                    <button type="button" class="btn btn-default btn-block j_cancel">3. 종료</button>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection