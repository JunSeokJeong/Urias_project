@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<center>
    <div class="page-header">
       <h1>낙상사고 정보 수정</h1>
    </div>
    <table class="table">
        <tbody>
            <form action="/blindcare/insertFallingInfo" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="f_num" value="{{$result[0]->f_num}}"/>
            <!-- 책이름 -->
            <tr>
                <th>낙상지 :  </th>
                <td><input type="text" placeholder="제목을 입력하세요. " name="l_title" class="form-control"/></td>
            </tr>
            <!-- 내용 -->
            <tr>
                <th>내용 : </th>
                <td><input type="text" name="f_content" class="form-control"/></td>
            </tr>
            <tr>
            <!-- 버튼 -->
                <td colspan="2">
                    <center>
                        <button class="btn btn-default"  type="submit" >수정하기</button>
                        <a class="btn btn-default" href="{{ route('fallingLocation') }}" role="button">목록으로</a>    
                    </center>
                </td>
            </tr>
        </form>
        </tbody>
    </table>
</center>
<button class="btn btn-primary" onclick="location.href='{{ route('fallingLocation') }}'"><h4>낙상사고 조회</h4></button>

@endsection