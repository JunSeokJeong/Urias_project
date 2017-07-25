@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<style type="text/css">
    .table{
        width:650px;
    }
    
</style>

<center>
      <form action="{{route('boardstore')}}" method="post" >
          <!-- table start -->
          <table class="table table-bordered">
              <thead>
                  <h3>도서관 소식 글 쓰기 </h3>
              </thead>
              <tbody>
                  {{csrf_field()}}
                  <tr>
                      <th>제목</th>
                        <td><input type="text" placeholder="제목을 입력하세요. " name="title" class="form-control"/></td>
                      </tr>
                  <tr>
                      <th>첨부파일</th>
                      <td><input type="file" name="photos[]" multiple /></td>
                  </tr>
                  <tr>
                      <th>내용</th>
                      <td><textarea cols="10" placeholder="내용을 입력하세요. " name="content" class="form-control"></textarea></td>
                  </tr>
                </tbody>
          </table> <!-- table end -->
          
          <!-- button form --> 
          <button class="btn btn-success" type="submit" >등록</button>
          <input class="btn btn-default" type="button" value="글 목록 " class="pull-right" onclick="history.go(-1)"/>
      
      </form> <!-- end form -->
  </center><!--end center -->
@endsection