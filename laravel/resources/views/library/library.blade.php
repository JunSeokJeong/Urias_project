@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
    .e_list{
        display:inline;
    }
    .btn{
        width:300px;
        background-color:#006b96;
        color:black;
    }
    h4{
        color:black;
    }
</style>

<div class="page-header">
   <h1 alt="온라인 도서관">E-Library</h1>
</div>

<center>
    <div class="col s12 m4 l8">
        <button class="btn btn-outline-primary waves-effect" alt="도서목록" style="background-color:white;" onclick="location.href='{{ route('bList') }}'"><h4>도서목록</h4></button>
    </div>
    <br>
    <div class="col s12 m4 l8">
        <button class="btn btn-outline-primary waves-effect" alt="나의 도서목록" style="background-color:white;" onclick="location.href='{{ route('mybList') }}'"><h4>나의 도서목록</h4></button>
    </div>
    <br>
    <div class="col s12 m4 l8">
        <button class="btn btn-outline-primary waves-effect" alt="도서신청" style="background-color:white;" onclick="location.href='{{ route('bookRequest') }}'"><h4>도서신청</h4></button>
    </div>
    <br>
    <div class="col s12 m4 l8">
        <button class="btn btn-outline-primary waves-effect" alt="오역수정" style="background-color:white;" onclick="location.href='{{ route('vList') }}'"><h4>오역수정</h4></button>
    </div>
    <br>
    <div class="col s12 m4 l8">
        <button class="btn btn-dark-green" alt="메인으로" onclick="location.href='{{ route('index') }}'">메인으로</button>
    </div>
</center>



@endsection