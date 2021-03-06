@extends('layouts.index_master')
@section('title', '메인')
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style>
  .news{
    height:15%;
    width:100%;
    background-color:white;
    color:black;
  }
  .font{
    color:black;
  }
  .white_btn{
    background-color:white;
  }

</style>


  <!-- row -->
    <div class="row">
        
        <!-- library news -->
        <div class="col-md-4">
          <!--<button class="button waves-effect waves-light btn-large white" alt="도서관 소식" style="color:black;"><h4>도서관 소식</h4></button>-->
          <button type="button" class="news btn btn-default" alt="도서관 소식"><h2 class="font">도서관 소식</h2></button>
          <table class="table table-hover">
            <tr>
              <th class="col-lg-2">제목</th>
            </tr>
          
            @foreach ($board as $value)
            <tr>
              <td class="col-lg-2"><a href="{{route('boardRead',$value->id)}}" style="color:black;">{{$value->title}}</a></td>
            </tr>
            @endforeach
          
          </table>
          <p>
            <a class="btn white_btn" href="{{ route('boardList') }}" role="button">
              <font style="color:black;">도서관소식 세부 정보 보기</font>
            </a>
          </p>
        </div> <!-- /col-lg-4 -->
       
        
        
        <div class="col-md-4">
          <button type="button" class="news btn btn-default" alt="실시간 Q&A"><h2 class="font">실시간 Q&A</h2></button>
           <table class="table table-hover">
            <tr>
              <th class="col-lg-6">제목</th>
              <th class="col-lg-2">답변수</th>
              <th class="col-lg-4">작성일</th>
            </tr>
            <?php $count = 0; ?>
            @foreach($question as $value)
            <tr>
              <?php  
              //제목 - 작성자 
              $writer_cut = explode('@',$value->writer);
              //작성일
              $w_d = explode(' ',$value->write_date);
              ?>
              <td><a href="/blindcare/questionView/{{$value->num}}" style="color:black;">{{$writer_cut[0]}}님의 질문입니다.</a></td>
              <td>
              @if($comment_count[$count] != null)
                <p>{{$comment_count[$count++]}}</p>
              @else
                <p>0</p>
              @endif
              </td>
              <td>{{$w_d[0]}}</a></td>
            </tr>
            @endforeach
          </table>
          <p>
            <a class="btn btn-lg white_btn" href="{{ route('qList') }}" role="button">
              <font style="color:black;">실시간Q&A세부정보보기</font>
            </a>
          </p>
        </div>
       
        <div class="col-md-4">
          <button class="news btn btn-default" alt="제작 도서 목록" style="background-color:white;"><h2 class="font">제작 도서 목록</h2></button>
          <table class="table table-hover">
            <tr>
              <th class="col-lg-5" >책제목</th>
              <th class="col-lg-3">작성자</th>
              <th class="col-lg-4">진행률</th>
            </tr>
            
          @foreach($result as $book)
            <?php
            $text=explode("@",$book->writer);
            $percent=round(($book->c_page/$book->page)*100);
            $nameArray=str_split($book->book_name);
            // $bookname;
            // if(count($nameArray)<3){
            //   $bookname=$book->book_name;
            // }
            // else{
            //   for($i=0;$i<count($nameArray);$i++){
            //   $bookname=$nameArray[$i];
            // }
            
            
           
            ?>
            <tr onclick="location.href = '/library/volunteerInfo/{{$book->v_num}}/{{$book->book_name}}'">
            <td>{{$book->book_name}}</td>
          
            <td>{{$text[0]}}</td>
            
            <td>
              <!--진행바 -->
              <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{($book->c_page/$book->page)*100}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$percent}}%">
                  <!--<span class="sr-only">40% Complete (success)</span>-->
                  {{$percent}}%
                </div>
              </div>
            </td>
            </tr>
            
          @endforeach
          </table>
          <p>
            <a class="btn btn-lg white_btn" href="{{ route('vList') }}" role="button">
              <font style="color:black;">제작 도서 세부 정보 보기</font>
            </a>
          </p>
        </div> <!-- /col-lg-4 -->
         
      </div><!-- /row -->          
      

@endsection