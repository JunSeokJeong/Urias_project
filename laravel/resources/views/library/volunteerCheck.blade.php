@extends('layouts.master')
@section('title', 'Page Title')
@section('content')

<style type="text/css">

.book_title
{
    font-size: 36px;
    text-align: center;
    font-weight: 500;
    margin-bottom: 70px;
}

.book_text
{
    margin-bottom: 30px;
    display:inline-block;
}

.form-control{
    font-size: 18px;
    width:auto;
    
}


#cropContainerPreload { 
    margin-top:60px;
	width:500px; 
	height:500px; 
	position: relative; 
}

#cropContainerPlaceHolder2 { 

	width:100%; 
	height:200px; 
	position: relative; 
	border:none;

}

#check_area {
    width:auto;
    height:500px;
    overflow:scroll;
    font-size: 18px;
}
</style>

<!-- 페이지 이동 버튼 -->

    <div>
        @if($result[0]->page_num != 1)
        <!-- 이전 페이지 -->
        <button type="button" class="btn btn-default btn-lg"
         onclick="location.href = '/library/volunteerCheck/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num - 1}}' ">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
        </button>
        @endif
    
        <!-- 다음 페이지 -->
        @if($result[0]->page_num != $end_page)
        <button type="button" class="btn btn-default btn-lg"
         onclick="location.href = '/library/volunteerCheck/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num + 1}}' "/>
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
        </button>
        </div>
        @endif
    </div>

<!--오역수정 세부정보 페이지-->
<div>
    <form action="/library/volunteerCheck" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="num" value="{{$v_num}}">
        <input type="hidden" name="book_name" value="{{$book_name}}">
        <input type="hidden" name="page_num" value="{{$result[0]->page_num}}">
         <div class="container">
        <div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <h1 class="book_title"><a href="/library/volunteerInfo/{{$v_num}}/{{$book_name}}">{{$book_name}}</a></h1>
        </div>

        <br/>
            <br><br>
            <div class="book_text col-md-6">
               <div id="cropContainerPreload"></div>
            </div>
            
            <div class="book_text col-md-6">
                <h3>오역수정 TEXT</h3>
                <hr>
                <div id="check_area" CONTENTEDITABLE='true'>
                    {!!$submit_txt!!}
                </div>
                <input type="hidden" name="check_text" id="check_save" value="{{$submit_txt}}"/>
            </div>

            
        </div>
    </div>
<center>
    <!-- 페이지 표시 -->
    <div>
        <h2>{{$result[0]->page_num}}/{{$end_page}}</h2>
    </div>  
    

    <!--제출하기-->
    @if($is_check)
        <h4>검수완료</h4>
    @else
        @if($is_submit)
            <br><button type="submit" class="btn btn-success">등록하기</button><br>
        @else
        <br><br>
            <h4>제출되지 않은 페이지 입니다.</h4>
        @endif
        <a href="{{ route('vList') }}">목록으로</a>
    @endif

    </form>
</center>

    	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	    <script src="/js/jquery.mousewheel.min.js"></script>
   	    <script src="/js/croppic.js"></script>
        <script>
        function strip_tags (input, allowed) {
	
        	input = input.replace('&lt;', '<');
        	input = input.replace('&gt;', '>');
        	input = input.replace('&nbsp;', '');
            allowed = (((allowed || "") + "").toLowerCase().match(/<[a-z][a-z0-9]*>/g) || []).join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
            var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
                commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
            return input.replace(commentsAndPhpTags, '').replace(tags, function ($0, $1) {        return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
            });
        }
        
		var croppicContainerPreloadOptions = {
				loadPicture:'{{$result[0]->p_img_dir}}',
				enableMousescroll:true,
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContainerPreload = new Croppic('cropContainerPreload', croppicContainerPreloadOptions);
		
		//텍스트 하이라이트
		var check_area = document.getElementById('check_area');
		var check_save = document.getElementById('check_save');
		check_save.value = strip_tags(check_area.innerHTML, "");
		
		check_area.onkeydown = function() {
            document.execCommand('foreColor',true, 'ff0000');
            
        };
        
        check_area.onkeyup = function() {
            check_save.value = strip_tags(check_area.innerHTML, "");
        };
        
        
	    </script>
</div><!--end div volunteerInfo-->


@endsection
