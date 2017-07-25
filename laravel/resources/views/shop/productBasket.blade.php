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
       var index_id;
              function delete(index_id){
                      if(confirm('정말 삭제하시겠습니까?')==true){
                            location.href='/shop/productBasketDelete/'+index_id;
                     }else{
                            
                     }
              }
              
              function aa(){
                  alert('눌림');
              }
</script>
              <!-- page name -->
       <div class="page-header">
              <h1>장 바 구 니 목 록</h1>
       </div>
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
                            <form action="{{route('productBasketDelete',$pro->index_id)}}" method="post" >
                                   <input type="hidden" name="_method" value="delete"><!-- delete 할때 필요 -->
                                   {{csrf_field()}}
                                   <button class="btn btn-danger" type="submit">삭제</button>
                            </form>  
                     </td>
              </tr>
@endforeach
       </table>
@endsection
