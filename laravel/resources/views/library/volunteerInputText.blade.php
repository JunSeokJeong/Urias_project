@extends('layouts.master')
@section('title', 'Page Title')
@section('content')


<meta name="viewport" content="width=device-width, initial-scale=1">

<style type="text/css">
.lib-panel {
    margin-bottom: 20px;
}
.lib-panel img {
    width: 80%;
    background-color: transparent;
}

.lib-panel .row,
.lib-panel .col-md-6 {
    padding: 0;
    background-color: #FFFFFF;
}


.lib-panel .lib-row {
    padding: 0 20px 0 20px;
}

.lib-panel .lib-row.lib-header {
    background-color: #FFFFFF;
    font-size: 20px;
    padding: 10px 20px 0 20px;
}

.lib-panel .lib-row.lib-header .lib-header-seperator {
    height: 2px;
    width: 300px;
    background-color: #d9d9d9;
    margin: 7px 10px 7px 0;
}

.lib-panel .lib-row.lib-desc {
    position: relative;
    height: 100%;
    display: block;
    font-size: 13px;
}
.lib-panel .lib-row.lib-desc a{
    position: absolute;
    width: 100%;
    bottom: 10px;
    left: 20px;
}

.row-margin-bottom {
    margin-bottom: 20px;
}

.box-shadow {
    /*box-shadow: 0 0 10px 0 rgba(0,0,0,.10);*/
    width:1000px;
    height:500px;
}

.no-padding {
    padding: 0;
}

.lib-img-show{
    max-width: 100%; /* 이미지의 최대사이즈 */
    width:auto;/* IE8 */
    height: auto;
    vertical-align: bottom;
}

    

</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script>
// $(function(){
//     var $setElem = $('.lib-img-show'),
//     pcName = '_pc',
//     spName = '_sp',
//     replaceWidth = 400;
 
//     $setElem.each(function(){
//         var $this = $(this);
//         function imgSize(){
//             if(window.innerWidth > replaceWidth) {
//                 $this.attr('src',$this.attr('src').replace(spName,pcName)).css({visibility:'visible'});
//             } else {
//                 $this.attr('src',$this.attr('src').replace(pcName,spName)).css({visibility:'visible'});
//             }
//         }
//         $(window).resize(function(){imgSize();});
//         imgSize();
//     });
// });

var img = document.getElementsByTagName("img");
vat i=0;
while (i < img.length) {
    img[i].setAttribute("style", "max-width: 100%; height: auto;");
    i++; 
    
}


</script>





<!--오역수정봉사 페이지-->
<div>

    <!--책제목-->
    <form action="/library/volunteerInputText/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num}}" method="get">

    <div class="container">
	<div class="row">
		<h2>제목</h2>
	</div>
    <hr>
        <div class="row row-margin-bottom col-xs-12 col-sm-6 col-md-8" >
            <div class="col-md-5 no-padding lib-item" >
                <div class="lib-panel">
                    <div class="row box-shadow">
                        <div class="col-xs-12">
                            <img class="lib-img-show" src='{{$result[0]->p_img_dir}}'>
                        </div>
                        <div class="col-xs-12">
                            <div class="lib-row lib-header">
                                1차 TEXT
                                <div class="lib-header-seperator"></div>
                            </div>
                            <div class="lib-row lib-desc">
                               <textarea class="form-control" rows="15" cols="20" name="input_text">{{$result[0]->p_pri_text}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <h2>{{$result[0]->page_num}}/{{$end_page}}</h2>
        </div>
    

    
    
    
    <div>
    <!--이전페이지-->
    @if($result[0]->page_num != 1)
    <!--<input type="button" value="이전페이지" -->
    <!--onclick="location.href = '/library/volunteerInputText/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num - 1}}' "/>-->
    <input class="btn btn-default" type="button" value="이전페이지"
    onclick="location.href = '/library/volunteerInputText/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num - 1}}' ">
    @endif
    <!--다음페이지-->
    @if($result[0]->page_num != $end_page)
    <!--<input type="button" value="다음페이지" -->
    <!--onclick="location.href = '/library/volunteerInputText/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num + 1}}' "/>-->
    <input class="btn btn-default" type="button" value="다음페이지"
    onclick="location.href = '/library/volunteerInputText/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num + 1}}' ">
    </div>
    
    @endif
    <!--제출하기-->
    @if($is_submit)
    제출완료
    @else
    <!--<br><input type="submit" value="제출하기"/><br>-->
    <br><button type="submit" class="btn btn-success">제출하기</button><br>
    @endif

    </form>
</div><!--end div volunteerInfo-->


@endsection