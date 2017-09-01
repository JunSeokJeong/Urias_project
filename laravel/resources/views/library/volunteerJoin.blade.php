@extends('layouts.fall_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">

/*.table {*/
/*    width: 580px;*/
/*    border: 0px;*/
/*}*/

.left_area {
width: 400px;
height: 600px;
float:left;     
margin-left:100px;
}

.right_area{
position: absolute;
width: 100%;
height: 600px;
padding-left: 200px;
/*float:left;*/
}

.vol_img{
    width:350px;
    height:500px;
    float:left;
    /*padding:50px;*/
}

.vol_book_info{
    margin-left:300px;
    width:400px;
    float:left;
    padding-left:100px;
}
.white_btn{
    background-color:white;
    color:black;
}

.vol_page{
    width:300px;
}
.vol_btn_area{
    width:1000px;
    float:left;
}
.btn-dark-green{
    width:200px;
}
</style>
<div class="row">
    <center>
    <div class="page-header">
        <!--제목 타이틀 --> 
        <h1><a href="{{ route('vList') }}">{{$book_name}}</a></h1>
    </div>
    </center>
    
    <div class="thumb_cont">
        <div class="cont">
            <div class="left_area">
                <img class="vol_img" src="{{$result[0]->main_img_dir}}" />
            </div>
            <div class="right_area">
                <div class="vol_book_info">
                    <h4>제목 : {{$book_name}}</h4>
                    <h4>저자 : 저자</h4>
                    <h4>출판사 : 출판사</h4>
                    <h4>내용 : {{$result[0]->v_content}}</h4>
                    <h4>총 페이지 : {{$result[0]->page}}</h4>
                    <h4>남은 페이지 : {{$result[0]->page - $result[0]->page_remains}}</h4><br> 
                    
                    
                    @if($is_join)
                        <h3 style="color:green;">참여&nbsp;중&nbsp;&nbsp;&nbsp;&nbsp;
                            <button class="white_btn btn bnt-lg" onclick="location.href = '/library/volunteerInputText2/{{$result[0]->v_num}}/{{$book_name}}/{{$join[0]->page_num}}/1' "><h4 style="color:black;">오역수정하기</h4></button>
                        </h3>
                        <!--<input type="button"  class="btn btn-default" value="오역수정하기" onclick="location.href = '/library/volunteerInputText2/{{$result[0]->v_num}}/{{$book_name}}/{{$join[0]->p_num}}/1' "/>-->
                    
                        @else
                        <h3 style="color:green;">참여중 아님</h3><br>
                        @endif
                        <!--참여하기-->
                        <form action="/library/joinVolunteer" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <!--할당할 페이지-->
                            <h3>할당 페이지 :  <input type="text" name="page_vol" style="width:150px;"/></h3>
                            <input type="hidden" name="num" value="{{$result[0]->v_num}}">
                            <input type="hidden" name="book_name" value="{{$book_name}}">
                            <!--<input type="submit" name="" class="btn btn-lg " value="참여하기"/>-->
                            @if($result[0]->page - $result[0]->page_remains != 0)
                            <button type="submit" name="" class="btn btn-dark-green bnt-lg " ><h3 >참여하기</h3></button>
                            @else
                            남은 페이지가 없습니다.
                            @endif
                            
                        </form>
                </div>
            </div>
            <div class="vol_btn_area">
                <center>
                 @if(Auth::check())
                    <!-- 수정하기 버튼-->
                    <!--<input type="button"  class="btn btn-lg " value="오역수정하기" onclick="location.href = '/library/volunteerInputText/{{$result[0]->v_num}}/{{$book_name}}/1' "/>-->
                    <!--<button type="submit" name="" class="white_btn btn bnt-lg"  onclick="location.href = '/library/volunteerInputText/{{$result[0]->v_num}}/{{$book_name}}/1' "><h4 style="color:black;">오역수정하기</h4></button>-->
                    @if(Auth::user()->type == '관리자')
                        <!--검수하기버튼-->
                        <button type="button"  class="white_btn btn btn-lg"  onclick="location.href = '/library/volunteerCheck2/{{$result[0]->v_num}}/{{$book_name}}/1' "><h4 style="color:black;">오역검수하기</h4></button>
                        <!--<input type="button"  class="btn btn-lg " value="오역검수하기" onclick="location.href = '/library/volunteerCheck/{{$result[0]->v_num}}/{{$book_name}}/1' "/>-->
                    @endif
                    <!--삭제하기-->
                    @if(Auth::user()->email == $result[0]->writer)
                    <!--<input type="button"  class="btn btn-lg " value="삭제하기" onclick="location.href = '/library/delVolunteerList/{{$result[0]->v_num}}/{{$book_name}}' "/>-->
                    <button type="button"  class="white_btn btn btn-lg"  onclick="location.href = '/library/delVolunteerList/{{$result[0]->v_num}}/{{$book_name}}' "><h4 style="color:black;">삭제하기</h4></button>
                    @endif
                    
                    @if(Auth::user()->type == '관리자' && $c_page == $result[0]->page)
                    <!--<input type="button"  class="btn btn-lg " value="등록하기" onclick="location.href = '/library/newbookInsert/{{$result[0]->v_num}}/{{$book_name}}' "/>-->
                    <button type="button"  class="white_btn btn btn-lg"  onclick="location.href = '/library/newbookInsert/{{$result[0]->v_num}}/{{$book_name}}'"><h4 style="color:black;">등록하기</h4></button>
                    @endif
                @else
                로그인을 해주세요
                @endif
                <button class="white_btn btn btn-lg " alt="오역수정" onclick="location.href='{{ route('vList') }}'"><h4 style="color:black;">오역수정목록</h4></button>
                <button type="button"  class="white_btn btn btn-lg"  onclick="location.href = '/library/delVolunteerList/{{$result[0]->v_num}}/{{$book_name}}' "><h4 style="color:black;">삭제하기</h4></button>
            </div>
            
            
            
        </div>
        
    </div>
    </center>
</div>





<!--@if($is_join)-->
<!--참여중-->
<!--<input type="button"  class="btn btn-default" value="오역수정하기" onclick="location.href = '/library/volunteerInputText2/{{$result[0]->v_num}}/{{$book_name}}/{{$join[0]->p_num}}/1' "/>-->
<!--<button class="btn bnt-lg" onclick="location.href = '/library/volunteerInputText2/{{$result[0]->v_num}}/{{$book_name}}/{{$join[0]->p_num}}/1' " ><h4 style="color:black;">오역검수하기</h4></button>-->
<!--@else-->
<!--참여중 아님-->
<!--@endif-->
<!--참여하기-->
<!--<form action="/library/joinVolunteer" method="post" enctype="multipart/form-data">-->
<!--    {{csrf_field()}}-->
    <!--할당할 페이지-->
<!--    할당 페이지 : <input type="text" name="page_vol" style="width:100px;"/><br>-->
<!--    <input type="hidden" name="num" value="{{$result[0]->v_num}}">-->
<!--    <input type="hidden" name="book_name" value="{{$book_name}}">-->
    <!--<input type="submit" name="" class="btn btn-lg " value="참여하기"/>-->
<!--    <button type="submit" name="" class="btn bnt-lg" ><h4 style="color:black;">참여하기</h4></button>-->
<!--</form>-->
<!--<br>-->

    
    <div>
        <!--@if(Auth::check())-->
            
            <!-- 수정하기 버튼-->
            <!--<input type="button"  class="btn btn-lg " value="오역수정하기" onclick="location.href = '/library/volunteerInputText/{{$result[0]->v_num}}/{{$book_name}}/1' "/>-->
        <!--    <button type="submit" name="" class="btn bnt-lg"  onclick="location.href = '/library/volunteerInputText/{{$result[0]->v_num}}/{{$book_name}}/1' "><h4 style="color:black;">오역수정하기</h4></button>-->
        <!--    @if(Auth::user()->type == '관리자')-->
                <!--검수하기버튼-->
        <!--        <button type="button"  class="btn btn-lg"  onclick="location.href = '/library/volunteerCheck/{{$result[0]->v_num}}/{{$book_name}}/1' "><h4 style="color:black;">오역검수하기</h4></button>-->
                <!--<input type="button"  class="btn btn-lg " value="오역검수하기" onclick="location.href = '/library/volunteerCheck/{{$result[0]->v_num}}/{{$book_name}}/1' "/>-->
        <!--    @endif-->
            <!--삭제하기-->
        <!--    @if(Auth::user()->email == $result[0]->writer)-->
            <!--<input type="button"  class="btn btn-lg " value="삭제하기" onclick="location.href = '/library/delVolunteerList/{{$result[0]->v_num}}/{{$book_name}}' "/>-->
        <!--    <button type="button"  class="btn btn-lg"  onclick="location.href = '/library/delVolunteerList/{{$result[0]->v_num}}/{{$book_name}}' "><h4 style="color:black;">삭제하기</h4></button>-->
        <!--    @endif-->
            
        <!--    @if(Auth::user()->type == '관리자' && $c_page == $result[0]->page)-->
            <!--<input type="button"  class="btn btn-lg " value="등록하기" onclick="location.href = '/library/newbookInsert/{{$result[0]->v_num}}/{{$book_name}}' "/>-->
        <!--    <button type="button"  class="btn btn-lg"  onclick="location.href = '/library/newbookInsert/{{$result[0]->v_num}}/{{$book_name}}' ">등록하기</button>-->
        <!--    @endif-->
        <!--@else-->
        <!--로그인을 해주세요-->
        <!--@endif-->
        <!--<button class="btn btn-lg " alt="오역수정" onclick="location.href='{{ route('vList') }}'"><h4 style="color:black;">오역수정목록</h4></button>-->
    <!--</div>-->

@endsection