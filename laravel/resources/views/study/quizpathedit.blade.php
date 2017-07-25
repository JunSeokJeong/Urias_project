@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<form method="POST" action="/quizchange/{{$id}}">
{!! csrf_field() !!} 
<input type="hidden" name="_method" value="PUT"> 
  <label for="exampleInputEmail1">{{$select->title}}의기존 PATH</label>
 <input type="text" class="form-control" value="{{$select->filesrc}}" readonly>
 <br><br>
 <label for="exampleInputEmail1">교체할 PATH</label>
 <input type="text" class="form-control" name="change">
  <br><br>
  <button type="submit" class="btn btn-default">변경</button>
  <a href="/adinput"><button type="button" class="btn btn-default">목록</button></a>
  </form>
@endsection