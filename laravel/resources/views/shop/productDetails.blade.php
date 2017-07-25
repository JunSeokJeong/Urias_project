@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />
<style type="text/css">
.img{ width:500px; height:400px; }
       #noInventory{ color:red; }
</style>
<script type="text/javascript" >
       var product_id;
       function basket(product_id){
              
               if(confirm('장바구니에 담으시겠습니까?')==true){
                    location.href='/shop/productBasket/'+product_id;
              }else{
                     return;
              }
       }
       
       
</script>
@foreach($product as $pro)

<div>
       
       <h3><img class="img" src="{{$pro->product_iamge}}" alt="..."></h3><br>
       <h3>상품이름: {{$pro->product_name}}</h3><br>
       @if(number_format($pro->product_num) == 0)
       <h3 id="noInventory">재고 없음</h3><br>
       @else
       <h3>수량: {{number_format($pro->product_num)}} 개</h3><br>
       @endif
       <h3>가격: {{number_format($pro->product_price)}}원</h3><br>
       <h3>설명: {{$pro->product_contents}}</h3><br>
       
</div>
<div>

              @if(Auth::user()->type == '관리자')
       <button class="btn btn-dark-green" onclick="location.href='{{route('admin')}}'">관리</button>
       @elseif(Auth::user()->type == '시각장애인')       
       <button onclick="location.href='/shop/productBuy/{{$pro->product_id}}'" class="btn btn-dark-green">구매</button>
       <button onclick="basket({{$pro->product_id}});" class="btn btn-dark-green">담기</button>
       <button onclick="location.href='{{ route('shop') }}'" class="btn btn-primary">목록으로</button>
       @endif
</div>
@endforeach
@endsection