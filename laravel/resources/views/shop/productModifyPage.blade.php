@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">
       
</style>



       <!-- page name -->
       <div class="page-header">
              <h1>상품 수정</h1>
       </div>

@foreach($product as $pro)

       <!-- 상품 수정란 -->
       <form action="{{route('productModify')}}" method="post" enctype="multipart/form-data">
       {{csrf_field()}}
              이름 <input type="text" name="product_name" value="{{$pro->product_name}}"/>
              설명 <input type="text" name="product_contents" value="{{$pro->product_contents}}"/>
              가격 <input type="number" name="product_price"  value="{{$pro->product_price}}" />
              재고 <input type="number" name="product_num"  value="{{$pro->product_num}}" />
              <input type="file" name="img" value="{{$pro->product_iamge}}"/>
              <input type="hidden" name="product_id" value="{{$pro->product_id}}"/>
              <input type="hidden" name="product_img" value="{{$pro->product_iamge}}"/><!-- 이미지수정 안할때 사용할 기본 값 -->
              <input class="btn btn-dark-green" type="submit" value="수 정"/>
       </form>
@endforeach

@endsection