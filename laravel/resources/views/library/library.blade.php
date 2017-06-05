@extends('layouts2.master2')
@section('title', 'Page Title')
@section('content')
<style>
    .e_list{
        display:inline;
    }
</style>

<div class="e_list">
    <a class="btn btn-default" href="{{ route('bList') }}" role="button">도서목록</a>
    <a class="btn btn-default" href="{{ route('mybList') }}" role="button">나의 도서목록</a>
    <a class="btn btn-default" href="{{ route('vList') }}" role="button">오역수정</a>
</div>


@endsection