@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<style type="text/css">
       .img{ width:200px; height:100px; }
       h3{ border:solid 1px red; width:300px; }
       .adminTh{ width:250px; }
       th{ text-align:center; }
       td{ text-align:center;height:150px; }
       #noInventory{ color:red; }
</style>
<script type="text/javascript">
       var product_id;
              function delete(product_id){
                      if(confirm('정말 삭제하시겠습니까?')==true){
                            location.href='/shop/productDelete/'+product_id;
                     }else{
                            
                     }
              }      
              function modify(product_id){
                      if(confirm('수정하시겠습니까?')==true){
                            location.href='/shop/productModifyPage/'+product_id;
                     }else{
                            
                     }
              }
</script>
              <!-- page name -->
       <div class="page-header">
              <h1>상품 관리</h1>
       </div>
       <table border="1px">
              <tr>
                     <th class="adminTh">상품이미지</th>
                     <th class="adminTh">상품명</th>
                     <th class="adminTh">재고</th>
                     <th class="adminTh">가격</th>
                     <th class="adminTh">설명</th>
                     <th class="adminTh">선택</th>
              </tr>
@foreach($product as $pro)
              <div id="productAdmin">
                     <tr>
                            <td><img class="img" src="{{$pro->product_iamge}}" alt="..."></td>
                            <th>{{$pro->product_name}}</th><br>
                            @if(number_format($pro->product_num) == 0)
                            <td id="noInventory">재고 없음</td><br>
                            @else
                            <td>{{number_format($pro->product_num)}} 개</td><br>
                            @endif
                            <td>{{number_format($pro->product_price)}} 원</td><br>
                            <td>{{$pro->product_contents}}</td>
                            <td><button class="btn btn-dark-green" onclick="delete({{$pro->product_id}})";>삭제</button></td>
                            <td><button class="btn btn-dark-green" onclick="location.href='/shop/productModifyPage/{{$pro->product_id}})'";>수정</button></td>
                      </tr>   
              </div>
      
@endforeach
       </table>
@endsection
