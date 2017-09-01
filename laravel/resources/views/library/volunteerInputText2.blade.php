@extends('layouts.fall_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<meta name="viewport" content="width=device-width, initial-scale=1">

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


h3{
    color:black;
}

.b{
    width:1140px;
    /*height:20%;*/
    border-top:1px solid gray;
    border-bottom:1px solid gray;
    /*border-radius:20px;*/
   
}
.move_btn{
    width:300px;
    
}

button{
    font-size:20px;
}

</style>


<!--오역수정봉사 페이지-->

    
    <!--책제목-->
    <form action="/library/volunteerInputText2" method="post" enctype="multipart/form-data">
              
              <!--넘겨줘야하는 정보 -->
              {{csrf_field()}}
              <input type="hidden" name="num" value="{{$v_num}}">
              <input type="hidden" name="book_name" value="{{$book_name}}">
              <input type="hidden" name="page_num" value="{{$join[$temp - 1]->page_num}}">
              <input type="hidden" name="temp" value="{{$temp}}">

              <div class="page-header">
                     <h1 class="book_title"><a href="/library/joinVolunteer/{{$v_num}}/{{$book_name}}">{{$book_name}}</a></h1>
              </div>
              
              
    <div style="overflow:scroll; width:relative; height:500px;" class="warp" id="img_warp">
        <div class="img_zoom" id="img_id">
        <img style="" class="text_img" id="test_imgs" src="{{$join[$temp - 1]->p_img_dir}}" alt="">
    
        @php ($count = 0)
        
        @foreach($v_json->responses[0]->fullTextAnnotation->pages[0]->blocks as $blocks)
        
            @foreach($blocks->paragraphs[0]->words as $words)
            
                @foreach($words->symbols as $symbols)
                    <div class='text' id='text_{{$count}}' 
                        style='
                            top:{{$symbols->boundingBox->vertices[3]->y}}px;
                            left:{{$symbols->boundingBox->vertices[3]->x}}px;
                            visibility: hidden; '>
                        {{$symbols->text}}
                    </div>
                    @php ($count++)
                    
                @endforeach
                
            @endforeach
            
        @endforeach
        </div>
    </div>
    <div class="row">
        <!-- 페이지 이동 버튼 -->
        <div class="col-md-2"></div>
        <div class="col-md-4">
            @if(isset($join[$temp - 2]))
        
            <button type="button" class="btn btn-default btn-lg"
             onclick="location.href = '/library/volunteerInputText2/{{$v_num}}/{{$book_name}}/{{$join[$temp - 2]->page_num}}/{{$temp - 1}}' ">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> 
            </button>
            @endif
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-4">
            @if(isset($join[$temp]))
            <button type="button" class="btn btn-default btn-lg"
             onclick="location.href = '/library/volunteerInputText2/{{$v_num}}/{{$book_name}}/{{$join[$temp]->page_num}}/{{$temp + 1}}' ">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
            </button>
            
            @endif
        </div>
            
        </div>
        <div class="col-md-2"></div>
    </div>
    
    <center>
    <input type="button" class="btn btn-lg btn-orange" onclick="back()" value="back">
    <input type="button" class="btn btn-lg btn-orange" onclick="next5()" value="next">
    
    <input type="hidden" id="input_save" class="form-control" name="input_text" value="">
    <input type="hidden" id="change_arr" class="form-control" name="change_list" value="">
    
    </center>
    
    <!--<div class="col-md-2"></div>-->
    <center>
    <div class="b" style="height:60%;overflow:scroll;">
    
            <h1 style="font-size:30px;">Text Input</h1>
            <hr>  
      
    <div name="text" id="text_area" style="font-size:20px;"></div>    
    </div>
    </center>
    <!-- 페이지 표시 -->
    <br>
    <center>
        <div>
            
            <div>
                <h2>{{$temp}}/{{$end_page}}</h2>
            </div>
        </div>
  
        
    <div>
        <!--제출하기-->
        @if($is_submit)
        <h2 style="color:red;">제출완료</h2>
        @else
        <br><button type="submit" class="btn btn-success btn-lg move_btn">제출하기</button><br>
        @endif
        <a href="{{ route('vList') }}" role="button" class="btn btn-lg btn-default" >목록으로</a>
          </center>
    </form>
    
</div><!--end div volunteerInfo-->

<script>

var count = 0;
var temp = "";
var text = "";
var change_arr = new Array();
var change_html = document.getElementById("change_arr");
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




//document.onkeydown = text_input;

// function keyDown(event) {
//     var key = event.which || event.keyCode;
    
    
//     if(key == 39) {
//         document.getElementById("text_" + count).style.visibility = 'visible';
//         text = document.getElementById("text_area").innerHTML;
//         text = text.trim();
//         temp = document.getElementById("text_" + count).innerHTML;
//         temp = temp.trim();
//         text += temp;
//         document.getElementById("text_area").innerHTML = text;
        
//         count++;
//     } else if(key == 37) {
//         count--;
//         document.getElementById("text_" + count).style.visibility = 'hidden';
//         temp = document.getElementById("text_area").innerHTML;
//         temp = temp.trim();
//         temp = temp.slice(0, -1);
//         document.getElementById("text_area").innerHTML = temp;
        
//     }
// }

function next() {
    
        document.getElementById("text_" + count).style.visibility = 'visible';
        text = document.getElementById("text_area").innerHTML;
        text = text.trim();
        temp = document.getElementById("text_" + count).innerHTML;
        temp = temp.trim();
        var div_tag = document.createElement("div");
        div_tag.id = "text_out_"+ count;
        div_tag.innerHTML = temp;
        div_tag.style.float = "left";
        div_tag.contentEditable = "true";
        
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
                change_arr.push(num[2]);
                change_html.value = change_arr;
                save();
            }
            
        });
        
        document.getElementById("text_area").appendChild(div_tag);
        
        count++;
        save();
  
}

function back() {
    
    count--;
    document.getElementById("text_" + count).style.visibility = 'hidden';
    var div_tag = document.getElementById("text_out_"+ count);
    document.getElementById("text_area").removeChild(div_tag);
    save();

}

function next5() {
    for(var i = 0; i < 5; i++) {
        next();    
    }
    
}

    //변경내용 저장
   function save() {
       var text_area = document.getElementById('text_area');
       var input_save = document.getElementById('input_save');
        input_save.value = text_area.innerHTML;
    };

    

</script>

@endsection