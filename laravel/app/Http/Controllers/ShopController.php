<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shop;
use Illuminate\Support\Facades\DB;
use Auth;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function index()
    {
        $result = DB::table('shops')->get();
        return view('shop.shopIndex',[  
                    'product' => $result
                     ]); 
        //
    }
    
    public function popup(Request $res,$id){
        $ab = $id;
        if($id>=1000){ //1000넘으면 장바구니에서 넘어온 경로
            $ab = $id;
        }
        
               return view('shop.popup',[
                   'product_id' => $id,
                   'res' => $ab
                   ]);  
    }
    
    public function buy(Request $request){
               return view('shop.popup');  
    }
    public function Write()
    {
        return view('shop.shopWrite'); 
        //
    }
    
    //상품 등록
    public function productUp(Request $request)
    {
        $product_img = $request->file('img');
        if(!$product_img) {
            
            echo "<script>
                window.alert('이미지를 등록하세요');
                history.go(-1);
            </script>";
        }
        $product_name = $request->product_name;
        $product_contents = $request->product_contents;
        $product_price = $request->product_price;
        $product_num = $request->product_num;
        
        
        //이미지 경로 설정
        $img_dir = '/shop_img/'.$product_name.'/';
        $img_Path = '.'.$img_dir;
        $img_name = $product_name.'_img.'.$product_img->getClientOriginalExtension();
        $img_dir = $img_dir.$img_name;
        
        // 이미지 저장
        $product_img->move($img_Path, $img_name );
        
        
         DB::table('shops')->insert([
            "product_name"  => $product_name,
            "product_contents" => $product_contents,
            "product_num" => $product_num,
            "product_price"  => $product_price,
            "product_iamge" => $img_dir
        ]);
        
        
        
        $res =  DB::table('shops')->get();
        return view('shop.shopIndex',[  
                    'product' => $res
                     ]); 
        //
    }
    
    //상품 정보
    public function details($id)
    {
        $result = DB::table('shops')->where('product_id',$id)->get();
        return view('shop.productDetails',[  
                    'product' => $result
                     ]); 
        //
    }
    
    //상품 관리
    public function admin()
    {
        
        $result = DB::table('shops')->get();
        return view('shop.productAdmin',[  
                    'product' => $result
                     ]); 
        //
    }
    
    //상품 삭제
    public function productDelete($id)
    {
        DB::table('shops')->where('product_id',$id)->delete();    
        $result = DB::table('shops')->get();
        
        echo "<script>
                window.alert('상품이 삭제 되었습니다.');
        
            </script>";
        return view('shop.productAdmin',[  
                    'product' => $result
                     ]);
        //
    }
    
    //상품 수정페이지 이동
    public function productModifyPage($id) 
    {  
        $result = DB::table('shops')->where('product_id',$id)->get();
        return view('shop.productModifyPage',[  
                    'product' => $result
                     ]);
        //
    }
    
    //상품 수정
    public function productModify(Request $request)
    {  
        
         $product_img = $request->file('img');

        $product_name = $request->product_name;
        $product_contents = $request->product_contents;
        $product_price = $request->product_price;
        $product_num = $request->product_num;
        $product_id = $request->product_id;
        $img_dir = $request->product_img;
        
         if($product_img) {
            
            //이미지 경로 설정
            $img_dir = '/shop_img/'.$product_name.'/';
            $img_Path = '.'.$img_dir;
            $img_name = $product_name.'_img.'.$product_img->getClientOriginalExtension();
            $img_dir = $img_dir.$img_name;
            
            // 이미지 저장
            $product_img->move($img_Path, $img_name );
        } 

        
        
         DB::table('shops')->where('product_id',$product_id)->update([
            "product_name"  => $product_name,
            "product_contents" => $product_contents,
            "product_num" => $product_num,
            "product_price"  => $product_price,
            "product_iamge" => $img_dir
        ]);
        
        
        $res =  DB::table('shops')->get();
        
        return view('shop.productAdmin',[  
                    'product' => $res
                     ]); 
        //
    }
//상품구매_재고만 줄어들게함 + 결제수단
    public function productBuy(Request $res,$id)
    {
            $payBtn = $res->payBtn; 
            $wav;
            if($payBtn == "card"){
                $wav = 21; //카드
            }else if($payBtn == "real"){
                $wav = 22; //계좌이체
            }else if($payBtn == "pay"){
                $wav = 23; //무통장
            }else if($payBtn == "cellphone"){
                $wav = 24; //휴대폰
            }
            
            
        $val = $res->hiddens; //장바구니에서 넘어온경로 해결하기위한 shopProductStates DB의index_id값
        if($val>=1000){ //장바구니에서 구매하면 실행
            $val -= 1000;
            $ress = DB::table('shopProductStates')->where('index_id',$val)->get();
            $product_id = $ress[0]->product_id;
            $ress2 = DB::table('shops')->where('product_id',$product_id)->get();
            $num = $ress2[0]->product_num;
            if($num!=0){ //상품 재고 개수 확인
                $num -= 1;
                DB::table('shopProductStates')->where('index_id',$val)->update(['state' => $wav]);
                DB::table('shops')->where('product_id',$product_id)->update(['product_num' => $num]);
                echo "<script>
                   window.alert('구매 되었습니다.');
                    window.close();
                </script>";
            }else{
                echo "<script>
                window.alert('품절된 상품입니다.');
                window.alert('새로고침 시 상품이 자동으로 삭제됩니다.');
                window.close();
                </script>";
                
                DB::table('shopProductStates')->where('index_id',$val)->delete();   
            }
            
        }else{//상품정보에서 구매하면 실행
        $user_id = Auth::user()->id;
        $result = DB::table('shops')->where('product_id',$id)->get();
        $num=0;
        foreach ($result as $user){
            $num= $user->product_num;
        }
        if($num!=0){
            $num -= 1;
            DB::table('shops')->where('product_id',$id)->update(['product_num' => $num]);
            

            $result = DB::table('shops')->where('product_id',$id)->get();
        

        
            $product_id = $result[0]->product_id;
            $product_name = $result[0]->product_name;
            $product_num = $result[0]->product_num;
            $product_price = $result[0]->product_price;
            $product_image = $result[0]->product_iamge;
            $state = $wav;
            
            DB::table('shopProductStates')->insert([
                "product_id"  => $product_id,
                "product_name" => $product_name,
                "product_num" => $product_num,
                "product_price"  => $product_price,
                "product_image" => $product_image,
                "user_id" => $user_id,
                "state" => $state
            ]);
            echo "<script>
                window.alert('구매 되었습니다.');
                window.close();
            </script>";
            
        }else{
            echo "<script>
                window.alert('품절된 상품입니다.');
                window.close();
            </script>";
        }
        
        
        
        $result = DB::table('shops')->where('product_id',$id)->get();
        
        // return view('shop.productDetails',[  
        //             'product' => $result
        //              ]); 
        //
        }
    }

  public function Basketpopup(Request $res,$id)
    {   
        
        $user_id = Auth::user()->id;
        DB::table('shopProductStates')->where('index_id',$id)->delete();    
        $result = DB::table('shopProductStates')->where('user_id',$user_id)->get();
        
        echo "<script>
                window.alert('구매 되었습니다!');
                window.close();
        
            </script>";
    }
    //장바구니 페이지이동  state = 1 (장바구니), state = 2 (구매) 
    //state = 21 (카드로 구매) state = 22 (실시간 계좌이체로 구매)
    //state = 23 (무통장입금으로 구매) state = 24 (휴대폰으로 구매)
    //상품정보페이지, 상품index페이지 2곳에서 넘어오는 함수
    public function productBasket($id)
    {
    
        $user_id = Auth::user()->id;
        
        if($id != 00){
            
            $result = DB::table('shops')->where('product_id',$id)->get();
        

        
            $product_id = $result[0]->product_id;
            $product_name = $result[0]->product_name;
            $product_num = $result[0]->product_num;
            $product_price = $result[0]->product_price;
            $product_image = $result[0]->product_iamge;
            $state = 1;
            
            DB::table('shopProductStates')->insert([
                "product_id"  => $product_id,
                "product_name" => $product_name,
                "product_num" => $product_num,
                "product_price"  => $product_price,
                "product_image" => $product_image,
                "user_id" => $user_id,
                "state" => $state
            ]);
            
            echo "<script>
                window.alert('장바구니에 추가되었습니다!');
            </script>";
            
            return view('shop.productDetails',[  
            'product' => $result
            ]); 
             
        }else{
            
            $result = DB::table('shopProductStates')->where('user_id',$user_id)->where('state',1)->get(); //장바구니 상품만 조회
            return view('shop.productBasket',[  
                        'product' => $result
                         ]); 
        }
        

        
        
    }
    //장바구니 상품 삭제
    public function productBasketDelete($id)
    {
        // $board = Board::find($id);
        // $board->delete();
        
        // return redirect('/board/boardList');
        
        
        
        DB::table('shopProductStates')->where('index_id',$id)->delete();    
        $result = DB::table('shopProductStates')->get();
        
        echo "<script>
                window.alert('목록에서 삭제했습니다.');
        
            </script>";
        return view('shop.productBasket',[  
                 'product' => $result
                     ]);
        
        DB::table('shopProductStates')->where('index_id',$id)->delete();    
        // $result = DB::table('shopProductStates')->get();
        
        echo"<script>
                window.alert('목록에서 삭제했습니다.');
        
            </script>";
        
        return redirect('/shop/productBasket/{id}');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $path = $request->file('avatar')->store('avatars');

        // return $path;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
