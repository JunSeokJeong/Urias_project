@extends('layouts.video_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
    .volunteer_choose_list {
        display:inline;
    }
    
    .blind_choose_list {
        display:inline;
    }
    .btn-primary{
        width:400px;
    }
</style>

<div class="page-header">
   <h1>실시간 Q&A 봉사</h1>
</div>

<div class="menu_list">
    <!-- 봉사자일 때 -->
    @if(Auth::user()->type == '일반인')
    <div class="volunteer_choose_list">
        <!--<button class="btn-large" onclick="location.href='/blindcare/volunteerTimeList/{{date('Y')}}/{{date('m')}}'" >내 봉사시간 등록</button>-->
        <button class="btn btn-primary" onclick="location.href='/blindcare/volunteerTimeCalendar'" >내 봉사시간 등록</button>
        <br><br>
        <button class="btn btn-primary" onclick="location.href='{{ route('qList') }}'" >질문 게시판</button>
    </div>
    
    @elseif(Auth::user()->type == '시각장애인')
    <!-- 시각장애인일 때 -->
    <div class="blind_choose_list">
        <a class="btn btn-primary" href="{{ route('vTPresent') }}" role="button">봉사자 등록 시간 조회</a>
        <br><br>
        <a class="btn btn-primary" href="{{ route('qLComment') }}" role="button">내 질문 목록</a>
    </div>
    @endif
</div>

@endsection