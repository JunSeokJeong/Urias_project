@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">
    .table{
        width:750px;
    }
    .thcolor{
           background-color:green;
           color:white;
    }
    .tdcolor{
           color:black;
    }
</style>

<div class="page-header">
   <h1 alt="점자교육 학교">테스트 결과</h1>
</div>

<center>
       @if(!isset($id[0]))
       
       <h1>수강한 단원이 없습니다.</h1>
       
       @else
       <h3 alt="최근 수강한 단원은 {{$id[0]->quiznum}}장">최근 수강한 단원은 {{$id[0]->quiznum}}장</h3>
       <h3>수강 시간은 {{$id[0]->created_at}} 입니다</h3>
       
              
       <table class="table table-striped">
       <tr>
              <th class="thcolor">문제</th>
              <th class="thcolor">답</th>
              <th class="thcolor">선택</th>
              <th class="thcolor">정답유무</th>
       </tr>
       
       @foreach($id as $record)
       <tr>
              
          <td class="tdcolor" alt="{{$record->example}}">{{$record->example}}</td>
          <td class="tdcolor" alt="{{$record->answer}}">{{$record->answer}}</td>
       
          <td class="tdcolor" alt="{{$record->choice}}">{{$record->choice}}</td>
          <?php
                 if($record->answer==$record->choice){
                        $result = "정답";
                     //    echo "정답";
                 }
                 else 
                 {
                        $result = "오답";
                     //    echo "오답";
                 }
          ?>
          <td class="tdcolor" alt="{{$result}}">
                 {{$result}}
          </td>
         
       </tr>
       @endforeach
       </table>
       @endif
       <button class="btn btn-dark-green" alt="이전메뉴로" onclick='back()'>이전메뉴로</button>
       <button class="btn btn-dark-green" alt="메인으로" onclick="location.href='http://urias-heoyongjun.c9users.io'">메인으로</button>
</center>

<script>
       function back(){
              history.go(-1);
       }
</script>

@endsection