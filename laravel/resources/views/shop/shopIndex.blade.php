@extends('layouts.fall_master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">
/*.img{*/
/*    width:250px;*/
/*    height:400px;*/
/*}*/

.h{
    color:black;
}
.white_btn{
    width:250px;
    background-color:white;
}
.btn-lime{
    width:250px;
}
.thumbnail{
    height:550px;
    width:300px;
}
.pd0{
    position:absolute;
    width:250px;
    height:200px;
    margin-left:10px;
}
</style>


<!-- page name -->
<div class="page-header">
       <h1>ショッピングモール</h1>
</div>
<!-- 상품 등록 버튼 --> 
<div>
       @if(Auth::user()->type == '관리자')
       <button class="btn btn-dark-green" onclick="location.href='{{route('write')}}'">商品登録</button>
       <button class="btn btn-dark-green" onclick="location.href='{{route('admin')}}'">商品管理</button>
       @elseif(Auth::user()->type == '시각장애인')
       <button class="btn btn-dark-green" onclick="location.href='/shop/productBasket/00'">ショッピングカート</button>
       @endif
</div>

<!-- 상품 이미지 -->
<!-- foreach 시작 -->
                     


<div class="row" id="div">
       @foreach($product as $test)
       <div class="divbox col-sm-6 col-md-4">
             <div class="thumbnail">
                    @if($test->product_num==0)
                    <div style="position: relative;">
                    <img class="pd0" src="{{$test->product_iamge}}" alt="..." >
                    <!--<img class="img" src="{{$test->product_iamge}}" alt="..."  >-->
                    <img class="pd0" src="inventory.png" alt="..."  >
                    <!--<img class="img" src="inventory.png" alt="..." >-->
                    </div>
                     <div class="caption"  style="margin:210px  0 0;">
                    @else
                     <img class="img" src="{{$test->product_iamge}}" alt="..." style="width:250px;height:200px;">
                     <div class="caption">      
                    @endif
                           <?php $i=0; ?>
                           @if($i==0)
                           <button class="white_btn btn" id="focus_1"><h4 class='h'>{{$test->product_name}}</h4></button><br><br>
                           <?php  $i++; ?>
                           @else
                           <button class="white_btn btn" id="firb"><h4 class='h'>{{$test->product_name}}</h4></button><br><br>
                           @endif
                           <button class="white_btn btn" ><h4 class='h'>{{number_format($test->product_price)}}円</h4></button>
                           <br><br>
                           <button type="button" class="btn btn-lime"  onclick="location.href='/shop/productDetails/{{$test->product_id}}'"><h4>商品詳しく見る</h4></button>
                           <br>
                     </div>
                     </div>
              </div>
       @endforeach
       </div>
<button class="btn btn-dark-green" alt="메인으로" onclick="location.href='http://urias-heoyongjun.c9users.io'">メインページへ</button>


@endsection