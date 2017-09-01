@extends('layouts.master')
@section('title', 'Page Title')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.3.0/css/mdb.min.css" type="text/css" />

<style type="text/css">
       .img{ width:200px; height:100px; }       
       h3{ border:solid 1px red; width:300px; }
       .basketTh{ width:250px; }
       th{ text-align:center; }
       td{ text-align:center;height:150px; }
       #noInventory{ color:red; }
</style>
<script type="text/javascript">
       var product_id;
       function popupOpen(product_id){
product_id += 1000;
	var popUrl = "/shop/popup/"+product_id;	//팝업창에 출력될 페이지 URL

	var popOption = "width=370, height=360, resizable=no, scrollbars=no, status=no;";    //팝업창 옵션(optoin)

		window.open(popUrl,"",popOption);
       
	}
       
              

</script>
              <!-- page name -->
       <div class="page-header">
              <h1>장 바 구 니 목 록</h1>
       </div>
       <button class="btn btn-dark-green" onclick="location.href='/shop'">뒤로가기</button>
       
       <table class="bordered " border="1px">
              <tr>
                     <th class="basketTh">상품이미지</th>
                     <th class="basketTh">상품명</th>
                     <th class="basketTh">재고</th>
                     <th class="basketTh">가격</th>
                     <th class="basketTh">선택</th>
              </tr>
@foreach($product as $pro)
              <tr>
                     <td><img class="img" src="{{$pro->product_image}}" alt="...">
                     <th>{{$pro->product_name}}</th>
                     <td>{{number_format($pro->product_num)}} 개</td>
                     <td>{{number_format($pro->product_price)}} 원</td>
                     <td>
                            <form action="/shop/productBasketDelete/{{$pro->index_id}}" method="post" >
                                   <input type="hidden" name="_method" value="delete"><!-- delete 할때 필요 -->
                                   {{csrf_field()}}
                                   <button class="btn btn-danger" type="submit">삭제</button>
                            </form> 
       <button onclick="popupOpen({{$pro->index_id}});" class="btn btn-dark-green">구매</button>
                     </td>
              </tr>
@endforeach
       </table>
@endsection
