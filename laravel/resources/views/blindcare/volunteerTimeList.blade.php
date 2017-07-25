@extends('layouts.video_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<style>
    #time_list {
        position: fixed;
        left: 30px;
        top: 30px;
        width: 70%;
        min-height: 300px;
        z-index:1;
        visibility:hidden;
        background-color: blue;
    }
    
    .one_regist {
        display: inline;
    }
</style>


<div class="time_calendar">
    <!-- 화면 제목 -->
    <div class="page-header">
       <h3>현재 봉사할 수 있는 봉사자</h3>
    </div>
    
    <!-- 내용 -->
    <div class="content">
        <div class="today_time_list">
            @foreach($to_time_list as $today_time)
            <div class="time">
                <p>{{$today_time['list_num']}}. 회원 {{$today_time['writer']}}</p>
                <p>{{$today_time['action_start_time']}} ~ {{$today_time['action_end_time']}}</p>
                <hr />
            </div>
            @endforeach
        </div>
    </div>
</div>



@endsection