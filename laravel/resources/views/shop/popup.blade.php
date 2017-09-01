<!DOCTYPE html>
<html>
       <head>
              
       </head>
       <body>
              <form action="/shop/productBuy/{{$product_id}}">
                     
                     신용카드 <input type="radio" name="payBtn" value="card" class="pay"/>
                     실시간 계좌이체 <input type="radio" name="payBtn" value="real" class="pay"/>
                     무통장 입금 <input type="radio" name="payBtn" value="pay" class="pay"/>
                     휴대폰 <input type="radio" name="payBtn" value="cellphone" class="pay"/>
                     <input type="submit" value="결제"/>
       <input type="hidden" name="hiddens" value="{{$res}}"/>{{$res}}
              </form>
              
       </body>
</html>