@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<!--오역수정 세부정보 페이지-->
<div>
<h2>제목</h2>

    <form action="/library/volunteerCheck/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num}}" method="get">

        <table border='1px'>
                
            <caption><h3>{{$book_name}}</h3></caption>
            <tr>
                <th>
                    원본이미지
                </th>
                <th>
                    오역수정 TXT
                </th>
            </tr>
            <tr>
                <td><img src='{{$result[0]->p_img_dir}}'></td>
                
                <td>
                    <textarea rows="10" cols="50" name="check_text">{{$submit_txt}}</textarea>
                    <!--<input type="textarea" name="check_text" value="{{$submit_txt}}"/>-->
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td>{{$result[0]->page_num}}/{{$end_page}}</td>
            </tr>
        
        </table>
    
    <!--이전페이지-->
    @if($result[0]->page_num != 1)
    <input type="button" value="이전페이지" 
    onclick="location.href = '/library/volunteerCheck/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num - 1}}' "/>
    @endif
    <!--다음페이지-->
    @if($result[0]->page_num != $end_page)
    <input type="button" value="다음페이지" 
    onclick="location.href = '/library/volunteerCheck/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num + 1}}' "/>
    @endif
    <!--제출하기-->
    @if($is_check)
        검수완료
    @else
        @if($is_submit)
            <br><input type="submit" value="등록하기"/><br>
        @else
            제출되지 않은 페이지 입니다.
        @endif
    @endif

    </form>
    

</div><!--end div volunteerInfo-->


@endsection
