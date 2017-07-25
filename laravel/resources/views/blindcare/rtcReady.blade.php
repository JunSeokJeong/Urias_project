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
<script src="../js/rtcReady.js"></script>

<h1>실시간 영상</h1>

<div>
    <a href="{{ route('rtcChat') }}">
        <button>영상통화하러가기</button>
    </a>
</div>

<!-- 수신 시 통화 수락 여부 -->
<div class="modal fade" id="income_call" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Call from <strong class="j-ic_initiator"></strong></h4>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default j-decline">거절</button>
                <button type="button" class="btn btn-primary j-accept">수신</button>
            </div>
        </div>
    </div>
</div>

@endsection