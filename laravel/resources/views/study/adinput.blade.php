@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
<center>
   <h1>점자교육 아두이노 입력 </h1>
   <br>
<table >
   <tr>
      <td>
      id
      </td>
      <td>
         title
      </td>
      <td>
         file_src
      </td>
      
      <td colspan='2'>
         Actions
      </td>
      <td>
         
      </td>
   </tr>
@foreach($studyselects as $record)
<tr>
   <td>{{$record->id}}</td>

   <td>{{$record->title}}</td>


   <td>{{$record->file_src}}</td>
   <td><a class="btn-large" href="/adinput/path/{{$record->id}}">경로수정</a></td>
   <td><a class="btn-large" href="/adinput/{{$record->id}}">아두이노</a></td>
  
</tr>
@endforeach

</table>

<h1>퀴즈  아두이노 입력 </h1>
<table >
   <tr>
      <td>
      id
      </td>
      <td>
         title
      </td>
      <td>
         file_src
      </td>
      
      <td colspan='3'>
         Actions
      </td>
      <td>
         
      </td>
   </tr>
@foreach($quizselects as $record)
<tr>
   <td>{{$record->id}}</td>

   <td>{{$record->title}}</td>


   <td>{{$record->filesrc}}</td>
   <td><a class="btn-large" href="/adinput/quiz/path/{{$record->id}}">경로수정</a></td>
   <td><a class="btn-large" href="/adinput/quiz/{{$record->id}}">아두이노</a></td>
   <td><a class="btn-large" href="/adinput/quiz/update/{{$record->id}}">문제수정 </a></td> 
</tr>
@endforeach

</table>

   

</table>
</center>
@endsection