@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<style type="text/css">

.table {
    width: 580px;
    border: 0px;
}
</style>


<center>
    <div>
        <h2>{{$book_name}}</h2>
        <br><br>
        <table class="table table-hover">
            <tr>
                <td>책 제목</td>
                <td>{{$book_name}}</td>
            </tr>
            <tr>
                <td>내용 :</td>
                <td>{{$result[0]->v_content}}</td>
            </tr>
            <tr>
                <td>등록 날짜 :</td>
                <td>{{$result[0]->write_date}}</td>
            </tr>
            <tr>
                <td> 현제 완료된 페이지 :</td>
                <td>{{$s_page}}</td>
            </tr>
            <tr>
                <td>총 페이지 : </td>
                <td>{{$result[0]->page}}</td>
            </tr>
        </table>
    </div>
</center>
    
    <div>
        @if(Auth::check())
            
            <!-- 수정하기 버튼-->
            <input type="button"  class="btn btn-default" value="오역수정하기" onclick="location.href = '/library/volunteerInputText/{{$result[0]->v_num}}/{{$book_name}}/1' "/>
            @if(Auth::user()->type == '관리자')
                <!--검수하기버튼-->
                <input type="button"  class="btn btn-default" value="오역검수하기" onclick="location.href = '/library/volunteerCheck/{{$result[0]->v_num}}/{{$book_name}}/1' "/>
            @endif
            <!--삭제하기-->
            @if(Auth::user()->email == $result[0]->writer)
            <input type="button"  class="btn btn-default" value="삭제하기" onclick="location.href = '/library/delVolunteerList/{{$result[0]->v_num}}/{{$book_name}}' "/>
            @endif
        @else
        로그인을 해주세요
        @endif
    </div>
        

    




@endsection