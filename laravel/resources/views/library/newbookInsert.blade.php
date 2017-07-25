@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<!--오역수정 세부정보 페이지-->
<div>

<center>
    <table class="table">
        <thead>
            <h3> 책 등록 </h3>
        </thead>
        <tbody>
            <form action="{{ route('bRegister') }}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="num" value="{{$result[0]->v_num}}">
            <!-- 책이름 -->
            <tr>
                <th>책이름: </th>
                <td><input type="text" placeholder="제목을 입력하세요. " name="book_name" class="form-control" value="{{$result[0]->book_name}}"/></td>
            </tr>
            <tr>
                <th>저자 : </th>
                <td><input type="text" name="b_writer" class="form-control"/></td>
            </tr>
            <!-- 내용 -->
            <tr>
                <th>내용 : </th>
                <td><input type="text" name="content" class="form-control"/></td>
            </tr>
            <!-- 장르 -->
            <tr>
                <th>장르 : </th>
                <td><input type="text" name="genre" class="form-control"/></td>
            </tr>
            <tr>
            <!-- 버튼 -->
                <td colspan="2">
                    <button class="btn btn-default"  type="submit" >등록하기</button>
                    <a class="btn btn-default" href="{{ route('vList') }}" role="button">목록으로</a>
                </td>
            </tr>
            
        </form>
        </tbody>
    </table>
</center>


<a href="{{ route('vList') }}">목록으로</a>


</div><!--end div volunteerInfo-->


@endsection