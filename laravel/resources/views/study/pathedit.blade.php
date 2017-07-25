@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">

<form method="POST" action="/change/{{$id}}">
{!! csrf_field() !!} 
<input type="hidden" name="_method" value="PUT"> 
  <label for="exampleInputEmail1">{{$select->title}}의기존 PATH</label>
 <input type="text" class="form-control" value="{{$select->file_src}}" readonly>
 <br><br>
 <!--<label for="exampleInputEmail1">교체할 PATH</label>-->
 <!--<input type="text" class="form-control" name="change">-->
 <div class="row">
    <form class="col s12">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="text" class="validate" name="change">
          <label for="email" data-error="wrong" data-success="right">교체할 PATH</label>
        </div>
      </div>
    </form>
  </div>
  
  <br><br>
  <button type="submit" class="btn btn-default">변경</button>
  <a href="/adinput"><button type="button" class="btn btn-default">목록</button></a>
  </form>
  
  <script type="text/javascript">

         
  </script>
@endsection