@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<meta name="viewport" content="width=device-width, initial-scale=1">

<style type="text/css">

.book_title
{
    font-size: 36px;
    color: #42B32F;
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

#input_area{
    width:500px;
    height:500px;
    overflow:scroll;
    font-size: 18px;
    -webkit-writing-mode: vertical-rl;
	-moz-writing-mode: vertical-rl;
	-ms-writing-mode: tb-rl;
	-ms-writing-mode: vertical-rl;
	writing-mode: vertical-rl;
}

</style>


<!--오역수정봉사 페이지-->
<div>
    <!-- 페이지 이동 버튼 -->
    <div>
        @if($result[0]->page_num != 1)
    
        <button type="button" class="btn btn-default btn-lg"
         onclick="location.href = '/library/volunteerInputText/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num - 1}}' ">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
        </button>
        @endif
    
        @if($result[0]->page_num != $end_page)
        <button type="button" class="btn btn-default btn-lg"
         onclick="location.href = '/library/volunteerInputText/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num + 1}}' ">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
        </button>
        </div>
        @endif
    </div>
    

    <!--책제목-->
    <form action="/library/volunteerInputText" method="post" enctype="multipart/form-data">
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
                <div md-form>
                    <label for="form1"><h2>1차 TEXT</h2></label><br>
                    <hr>
                    <div id="input_area" CONTENTEDITABLE='true'>
                        {{$result[0]->p_pri_text}}
                    </div>
                    <input type="hidden" id="input_save" class="form-control" name="input_text" value="{{$result[0]->p_pri_text}}">
                </div>
            </div>

            
        </div>
    </div>
    
    <!-- 페이지 표시 -->
    <div>
        <h2>{{$result[0]->page_num}}/{{$end_page}}</h2>
    </div>
        
    <div>
        <!--제출하기-->
        @if($is_submit)
        <h5>제출완료</h5>
        @else
        <br><button type="submit" class="btn btn-success">제출하기</button><br>
        @endif
        <a href="{{ route('vList') }}">목록으로</a>
    </form>
    
</div><!--end div volunteerInfo-->

    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	    <script src="/js/jquery.mousewheel.min.js"></script>
   	    <script src="/js/croppic.js"></script>
        <script>
        //이미지 확대 스크립트
		var croppicContainerPreloadOptions = {
				loadPicture:'{{$result[0]->p_img_dir}}',
				enableMousescroll:true,
				onError:function(errormessage){ console.log('onError:'+errormessage) }
		}
		var cropContainerPreload = new Croppic('cropContainerPreload', croppicContainerPreloadOptions);
		
		
		//텍스트 하이라이트
		var input_area = document.getElementById('input_area');
		var input_save = document.getElementById('input_save');
		
		input_area.onkeydown = function() {
            document.execCommand('foreColor',true, 'ff0000');
            input_save.value = input_area.innerHTML;
        };
	</script>

@endsection