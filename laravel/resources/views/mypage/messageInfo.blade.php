@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<style type="text/css">
    .table{
      width: 680px;
      border: 0px;
    }
    .title_box{
        display: inline;
        padding:30px;
    }
    .btn_title{
        width:850px;
    }
    h3{
        color:black;
    }
</style>

<center>
    <div class="row">
        <br>
    @foreach($result as $message)
    
    <div class="page-header">
        <!--<h2 alt="메세지 함">h1{{$message->m_title}}</h2>-->
        <?php  
        $m_title_cut = explode('책', $message->m_title);
        $send_user_cut = explode('@', $message->send_user);
        ?>
        <button class="btn_title btn btn-outline-black waves-effect">
            <h1>{{$m_title_cut[0]}}</h1>
        </button>
        <br>
        <button class="btn-sm btn-primary">{{$message->is_check}}</button>
        <button class="btn-sm btn-outline-white"><h3>보낸사람:{{$send_user_cut[0]}}</h3></button>
        <button class="btn-sm btn-outline-white"><h3>{{$message->send_date}}</h3></button>
    </div>
    
            <!-- content -->
            <div alt="메세지 내용">
                <button type="button" class="btn_title btn btn-outline-primary waves-effect">{!!$message->m_content!!}</button>
            </div>
    
    @endforeach
    </div>
</center>    


@endsection