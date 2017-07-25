@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
.btn_title{
       /*background-color:white;*/
       width:400px;
}
</style>
       <div class="page-header">
              <h1>My Page</h1>
       </div>
       
       <center>
              <button class="btn_title btn btn-outline-black waves-effect" alt="message" onclick="location.href='{{ route('message') }}'"><h2>message</h2></button>
              
       </center>
              
       
       

@endsection