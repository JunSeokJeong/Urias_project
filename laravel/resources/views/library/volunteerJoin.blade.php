@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<style type="text/css">

.table {
    width: 580px;
    border: 0px;
}

</style>

<!--제목 타이틀-->
<h2>{{$book_name}}</h2><br>
<!--목록으로-->
<button alt="오역수정" onclick="location.href='{{ route('vList') }}'">
    오역수정목록
</button><br>
<!--이미지-->
<img src="{{$result[0]->main_img_dir}}" width="100"></img><br>
<!--제목-->
제목 : {{$book_name}}<br>
<!--저자-->
저자 : 저자<br>
<!--출판사-->
출판사 : 출판사<br>
<!--내용-->
내용 : {{$result[0]->v_content}}<br>
<!--총 페이지-->
총 페이지 : {{$result[0]->page}}<br>
<!--할당된 페이지-->
<br>
<!--할당할 페이지-->
할당 페이지 : <input type="text" name=""/><br>
<!--참여하기-->
<input type="button" name="" value="참여하기"/>
<br>
<textarea type=text style="writing-mode:tb-rl;height:100pt;width:170pt"></textarea>

<center>
    <div>
        <h2>{{$book_name}}</h2>
        <br><br>
        <table class="table">
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
            <!--<tr>-->
            <!--    <td> 현제 완료된 페이지 :</td>-->
            <!--    <td>{{$c_page}}</td>-->
            <!--</tr>-->
            <!--<tr>-->
            <!--    <td>총 페이지 : </td>-->
            <!--    <td>{{$result[0]->page}}</td>-->
            <!--</tr>-->
            <tr>
                <td colspan="2 ">
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{($c_page/$result[0]->page)*100}}" aria-valuemin="0" aria-valuemax="100" style="width: {{($c_page/$result[0]->page)*100}}%">
                           {{($c_page/$result[0]->page)*100}}%
                        </div>
                    </div>    
                </td>
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
            
            @if(Auth::user()->type == '관리자' && $c_page == $result[0]->page)
            <input type="button"  class="btn btn-default" value="등록하기" onclick="location.href = '/library/newbookInsert/{{$result[0]->v_num}}/{{$book_name}}' "/>
            @endif
        @else
        로그인을 해주세요
        @endif
        <button class="btn btn-lg " alt="오역수정" style="background-color:white;" onclick="location.href='{{ route('vList') }}'"><h4>오역수정목록</h4></button>
    </div>

@endsection