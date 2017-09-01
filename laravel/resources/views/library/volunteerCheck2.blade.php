@extends('layouts.fall_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">

.text {
    position: absolute;
    background-color: #007dff; 
    opacity:0.4; 
    color: #007dff;
    writing-mode: vertical-rl;
}

.img_zoom {
    zoom : 0.8;
}
.warp {
    position: relative;
}

.text_img {
    float:left; 
}
.b{
    margin-top:5px;
    width:1140px;
    /*height:20%;*/
    border-top:1px solid gray;
    border-bottom:1px solid gray;
   
}

</style>

<form action="/library/volunteerCheck2" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="num" value="{{$v_num}}">
    <input type="hidden" name="book_name" value="{{$book_name}}">
    <input type="hidden" name="page_num" value="{{$result[0]->page_num}}">
    
    <center>
        <div class="page-header">
            <h1 class="book_title"><a href="/library/joinVolunteer/{{$v_num}}/{{$book_name}}">{{$book_name}}</a></h1>
        </div>
        
    <!-- 페이지 표시 -->
    <div>
        <h2>{{$result[0]->page_num}}/{{$end_page}}</h2>
    </div>  
    
    
    </center>
    
    <div style="overflow:scroll; width:relative; height:500px;" class="warp" id="img_warp">
        <div class="img_zoom" id="img_id">
        <img style="" class="text_img" id="test_imgs" src="{{$result[0]->p_img_dir}}" alt="">
    
        @php ($count = 0)
        
        @foreach($v_json->responses[0]->fullTextAnnotation->pages[0]->blocks as $blocks)
        
            @foreach($blocks->paragraphs[0]->words as $words)
            
                @foreach($words->symbols as $symbols)
                    <div class='text' id='text_{{$count}}' 
                        style='
                            top:{{$symbols->boundingBox->vertices[3]->y}}px;
                            left:{{$symbols->boundingBox->vertices[3]->x}}px;'>
                        {{$symbols->text}}
                    </div>
                    @php ($count++)
                    
                @endforeach
                
            @endforeach
            
        @endforeach
        </div>
    </div>
<br>
<!-- 페이지 이동 버튼 -->

<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        @if($result[0]->page_num != 1)
        <!-- 이전 페이지 -->
        <button type="button" class="btn btn-default btn-lg"
         onclick="location.href = '/library/volunteerCheck2/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num - 1}}' ">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
        </button>
        @endif
    </div>
    <div class="col-md-2"></div>
    <div class="col-md-4">
       <!-- 다음 페이지 -->
        @if($result[0]->page_num != $end_page)
        <button type="button" class="btn btn-default btn-lg"
         onclick="location.href = '/library/volunteerCheck2/{{$v_num}}/{{$book_name}}/{{$result[0]->page_num + 1}}' "/>
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
        </button>
        </div>
        @endif
  </div>
  <div class="col-md-2"></div>
</div>

<center>
<div class="b" style="height:60%;overflow:scroll;">
    <h1>TEXT CHECK</h1>
    <hr>
    <div id="check_area" CONTENTEDITABLE='false'>
        
        <span style="font-size:25px;">{!!$submit_txt!!}</span>
    </div>
</div>
    </center>
<input type="hidden" name="check_text" id="check_save" value=""/>

<!--제출하기-->
    @if($is_check)
     <center>
        <br><br><font color="red"><h1>검수완료</h1></font>
        </center>
    @else
        @if($is_submit)
        <center>
            <br><button type="submit" class="btn btn-success btn-lg">등록하기</button>
        </center>
        @else
        <br><br>
            <h2 style="color:red;">제출되지 않은 페이지 입니다.</h2>
        @endif
      
    @endif

</form>


   

<!--오역수정 세부정보 페이지-->
<hr>
<div>

    <center>
        
   
  <a href="{{ route('vList') }}"><button class="btn btn-default btn-lg">목록으로</button></a>
   </center>
    <script>
    
        var img_id = document.getElementById("img_id");
        var img_warp = document.getElementById("img_warp");
        var zoom = 0.8;
        
        
        img_id.onmousewheel = function(e) {
            
            //alert(e.wheelDelta);
            e.preventDefault();
            
            if(e.wheelDelta > 0) {
                zoom += 0.02;
                img_id.style.zoom = zoom;
            } else {
                zoom -= 0.02;
                img_id.style.zoom = zoom;
            }
        };

    
        //태그 제거
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
        
        //변경내용 저장
    	function save() {
    	    var check_area = document.getElementById('check_area');
    	    var check_save = document.getElementById('check_save');
            check_save.value = strip_tags(check_area.innerHTML, "");
        };
        
        save();
        
        var change_arr = "{{$change_list}}";
        var count = {{$count}};
        
        if(change_arr != "-1") {
            
            change_arr = change_arr.split(',');    
            for(var i = 0; i < change_arr.length; i++) {
                document.getElementById("text_" + change_arr[i]).style.color = "red";
                document.getElementById("text_" + change_arr[i]).style.backgroundColor ="red";
            }
        }
        
        
        
    
        for(var i = 0; i < count; i++) {
            
            var div_tag = document.getElementById("text_out_" + i);
            
            div_tag.onkeydown = function() {
                document.execCommand('foreColor',true, 'ff0000');
            };
            
            div_tag.addEventListener("focus", function(e) {
                
                var target = e.target || e.srcElement;
                var num = target.id.split("_");
                document.getElementById("text_" + num[2]).style.color = "red";
                document.getElementById("text_" + num[2]).style.backgroundColor ="red";
            });
            
            div_tag.addEventListener("blur", function(e) {
                
                var target = e.target || e.srcElement;
                var num = target.id.split("_");
                var o_text = document.getElementById("text_" + num[2]).innerHTML;
                o_text = o_text.trim();
                var target_text = target.innerHTML;
                target_text = target_text.trim();
                
                if(o_text == target_text) {
                    document.getElementById("text_" + num[2]).style.color = "#007dff";
                    document.getElementById("text_" + num[2]).style.backgroundColor = "#007dff";
                    
                } else {
                    save();
                }
                
            });
        }
        
    </script>
</div><!--end div volunteerInfo-->


@endsection
