@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/js/mdb.min.js">

<style type="text/css">
    /* 테이블 전체 */
    .table{
      width: 580px;
      border: 0px;
    }
    
</style>

<center>
    <table class="table">
        <thead>
            <h3> 오역수정 봉사 등록 </h3>
        </thead>
        <tbody>
            <form action="{{ route('newVolunteerList') }}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <!-- 책이름 -->
            <tr>
                <th>책이름: </th>
                <td><input type="text" placeholder="제목을 입력하세요. " name="book_name" class="form-control"/></td>
            </tr>
            <!-- 내용 -->
            <tr>
                <th>내용 : </th>
                <td><input type="text" name="content" class="form-control"/></td>
            </tr>
            <tr>
            <!-- 책이미지 -->
                <th>책이미지 :  </th>
                <td><input multiple="multiple" type="file" name="img_file[]" /></textarea></td>
            </tr>
            <tr>
            <!-- 책메인 이미지 -->
                <th>책 메인 이미지 :  </th>
                <td><input type="file" name="main_img" /></textarea></td>
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


@endsection