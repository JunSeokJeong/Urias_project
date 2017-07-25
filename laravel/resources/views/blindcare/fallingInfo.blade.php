@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
       .btn_title{
              width:350px;
       }
       h3{
        color:black;
    }
</style>
<div class="row">
    <div class="page-header">
        <h1>낙상 정보</h2>
    </div>
    <center>
        @foreach($result as $loca)
        <img class="img" src='{{$loca->falling_img}}'><br>
        <button class="btn_title btn btn-outline-black waves-effect">{{$loca->l_title}}</button><br>
        <button class="btn-sm btn-outline-white"><h3>{{$loca->f_content}}</h3></button>
        <button class="btn-sm btn-outline-white"><h3>낙상자:{{$loca->falling_user}}</h3></button><br>
        @endforeach
        <a class="btn btn-info btn-rounded " href="/blindcare/insertFallingPage/{{$loca->f_num}}">수정하기</a>
        <a class="btn btn-success btn-rounded " href="{{ route('fallingLocation') }}">낙상사고 조회</a>
    </center>
    
</div>


<!--@foreach($result as $loca)-->
<!--       <img class="img" src='{{$loca->falling_img}}'>-->
<!--       <span><a href="/blindcare/fallingInfo/{{$loca->f_num}}">{{$loca->l_title}}</a>-->
<!--       </span><br><span>{{$loca->f_content}}</span><br>-->
<!--       <span>등록자 :{{$loca->register_user}}</span>&nbsp;&nbsp;<span>낙상자:{{$loca->falling_user}}</span>-->
<!--       <a href="/blindcare/insertFallingPage/{{$loca->f_num}}">수정하기</a>-->
<!--@endforeach-->
<!--       <button class="waves-effect" style="color:white;" onclick="location.href='{{ route('fallingLocation') }}'"><h4>낙상사고 조회</h4></button>-->

       <center>
<!--@foreach($result as $loca)-->
<!--<img class="img" src='{{$loca->falling_img}}'>-->
<!--   {{$loca->l_title}}-->
<!--   {{$loca->f_content}}-->
<!--   등록자 :{{$loca->register_user}}-->
<!--   낙상자:{{$loca->falling_user}}-->
<!--<a class="btn btn-info btn-rounded " href="/blindcare/insertFallingPage/{{$loca->f_num}}">수정하기</a>-->
        
<!--@endforeach-->
<!--<a class="btn btn-success btn-rounded " href="{{ route('fallingLocation') }}">낙상사고 조회</a>-->


@endsection

