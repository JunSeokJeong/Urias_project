@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">
       
</style>



<!-- page name -->
<div class="page-header">
       <h1>상품 입력</h1>
</div>

<!-- 상품 입력란 -->
<form action="{{route('productUp')}}" method="post" enctype="multipart/form-data">
       <!--enctype="multipart/form-data"-->
       <!--상품이름, 설명,가격,수량,       상품번호->A_I-->
       {{csrf_field()}}
       <input type="text" name="product_name" placeholder="이름"/>
       <input type="text" name="product_contents" placeholder="설명"/>
       <input type="number" name="product_price"  placeholder="가격" />
       <input type="number" name="product_num"  placeholder="수량" />
       <input type="file" name="img" />
       <input class="btn btn-dark-green" type="submit" value="등록"/>
</form>

@endsection