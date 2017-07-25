@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<style>
    .btn{
        width:400px;
    }
</style>

<!-- page name -->
<div class="page-header">
       <h1>Blind care</h1>
</div>

<center>
       <div class="col s12 m4 l8">
        <!--<a class="waves-effect waves-light btn-large"  href="{{ route('fallingLocation') }}" ><span></span>낙상사고 조회</a>-->
        <button type="button" class="btn btn-primary" style="color:white;" onclick="location.href='{{ route('fallingLocation') }}'"><h4>낙상사고 조회</h4></button>
       </div>
       <br>
       
       <div class="col s12 m4 l8">
           <!--<a class="waves-effect waves-light btn-large" href="{{ route('vCIndex') }}" >실시간 영상통화</a>-->
           <button type="button" class="btn btn-primary" style="color:white;" onclick="location.href='{{ route('vCIndex') }}'"><h4>실시간 Q&A 봉사</h4></button>
       </div>
       <br>
       
       <button class="btn btn-dark-green" alt="메인으로" onclick="location.href='http://urias-heoyongjun.c9users.io'">메인으로</button>
</center>



@endsection