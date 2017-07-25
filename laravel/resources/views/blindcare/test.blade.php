@extends('layouts2.master2')
@section('title', 'Page Title')
@section('content')

@if( $test == "0"){
<p>1234</p>
}
@elseif($test=="1"){
<p>5555</p>
}
@endif
<p>{{$test}}</p>
<form method="post" action="/blindcare/obj3">
       <input type="submit" value="Submit"/>
</form>
@endsection