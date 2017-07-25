@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<style type="text/css">
    .table{
      width: 880px;
      border: 0px;
    }
    .thcolor{
        background-color:#0072B2;
        color:white;
    }
</style>

<div class="page-header">
    <h1 alt="메세지 함">메세지 함</h1>
</div>

<center>

    
    <table class="table table-hover">
        <thead>
            <tr>
                <th class="thcolor">확인여부</th>
                <th class="thcolor">제목 </th>
                <!--<th class="center-align">내용</th>-->
                <th class="thcolor">보낸사람</th>
                <th class="thcolor">보낸날짜</th>
            </tr>
        </thead>
        @foreach($result as $message)
        <tr onclick="location.href='/mypage/messageinfo/{{$message->m_num}}' ">
            <?php
            $message_send_user=explode("@",$message->send_user);
            // $percent=round(($book->c_page/$book->page)*100);
            $message_content=substr($message->m_content,1,20);
            ?>
            <td>
                @if(!$message->is_check)
                new
                @endif
            </td>
            <td class="col s3">{{$message->m_title}}</td>
            <!--<td class="col s4">{{$message_content[0]}}...</td>-->
            
            <td class="center-align">{{$message_send_user[0]}}</td>
            <td class="col s4">{{$message->send_date}}</td>
            <!--<td></td>-->

        </tr>
        @endforeach
    </table>
    {!! $result->render() !!}
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <!--<button type="button" class="btn btn-dark-green" onclick="upfocus()"><h4>메뉴 처음으로</h4></button>-->
            <button type="button" class="btn btn-dark-green" onclick="location.href='{{ route('index') }}'"><h4>메인으로</h4></button>
        </div>
    </div>
</center>


@endsection